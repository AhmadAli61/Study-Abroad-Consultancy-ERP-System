<?php

namespace App\Livewire\Admin\InquiriesDetail;

use Livewire\Component;
use App\Models\User;
use App\Models\RegisteredInquiry;
use Illuminate\Support\Facades\DB;

class RegisteredDetail extends Component
{
    public $counsellors = [];
    public $overallStats = [];
    public $currentMonth;
    public $currentYear;

    // Define all status categories based on your dropdown
    private $activeStatuses = [
        'underassessment',  // Under Assessment
        'processed',        // Processed
        'conditional',      // Conditional Offer
        'unconditional',    // Unconditional Offer
        'undercas',         // Under CAS
        'casreceived',      // CAS Received
    ];
    
    private $closedStatuses = ['caseclosed', 'rejection', 'withdrawn'];
    private $specialStatuses = ['visaprocess', 'enrollment'];

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        
        $this->loadCounsellorStats();
        $this->loadOverallStats();
    }

    protected function loadCounsellorStats()
    {
        // Fetch all active counsellors (status = 1) EXCEPT specific usernames
        $counsellors = User::where('role', 'counsellor')
            ->where('status', 1)
            ->whereNotIn('username', ['counsellor1', 'Old Inquiries'])
            ->get();

        foreach ($counsellors as $counsellor) {
            $this->enhanceCounsellorStats($counsellor);
        }

        // Sort by total registrations (descending)
        $this->counsellors = $counsellors->sortByDesc('total_registered')->values();
    }

    protected function enhanceCounsellorStats($counsellor)
    {
        // Get all inquiries for this counsellor (excluding parent records)
        $allInquiries = RegisteredInquiry::where('users_id', $counsellor->id)
            ->whereNull('parent_id')
            ->get(['id', 'inquiry_status', 'intake_id']);

        // 1. Total registered students (excluding parent records)
        $counsellor->total_registered = $allInquiries->count();

        // Initialize counters for ALL status categories
        $caseclosedCount = 0;
        $withdrawnCount = 0;
        $rejectedCount = 0;
        $visaprocessCount = 0;
        $enrolledCount = 0;
        $activeStdCount = 0;
        $otherCount = 0; // For any status not in our defined categories

        // Process each inquiry with parent-child logic
        foreach ($allInquiries as $inquiry) {
            $status = $inquiry->inquiry_status;
            $hasActiveChildren = $this->hasActiveChildren($inquiry->id);
            
            // Check if inquiry is in closed status AND has active children
            if (in_array($status, $this->closedStatuses) && $hasActiveChildren) {
                // This closed inquiry has active children, so use child's status
                $childData = $this->getMostRecentActiveChildData($inquiry->id);
                
                if ($childData) {
                    $childStatus = $childData['inquiry_status'];
                    $childIntakeId = $childData['intake_id'];
                    
                    // Categorize based on child status
                    $this->categorizeInquiry($childStatus, $childIntakeId,
                        $caseclosedCount, $withdrawnCount, $rejectedCount,
                        $visaprocessCount, $enrolledCount, $activeStdCount, $otherCount);
                } else {
                    // No active children found, count parent's original status
                    $this->categorizeInquiry($status, $inquiry->intake_id,
                        $caseclosedCount, $withdrawnCount, $rejectedCount,
                        $visaprocessCount, $enrolledCount, $activeStdCount, $otherCount);
                }
            } else {
                // Normal counting (not closed or no active children)
                $this->categorizeInquiry($status, $inquiry->intake_id,
                    $caseclosedCount, $withdrawnCount, $rejectedCount,
                    $visaprocessCount, $enrolledCount, $activeStdCount, $otherCount);
            }
        }

        // Assign the calculated counts
        $counsellor->caseclosed_count = $caseclosedCount;
        $counsellor->withdrawn_count = $withdrawnCount;
        $counsellor->rejected_count = $rejectedCount;
        $counsellor->visaprocess_count = $visaprocessCount;
        $counsellor->enrolled_count = $enrolledCount;
        $counsellor->active_std_count = $activeStdCount;

        // Verify totals match (for debugging)
        $calculatedTotal = $caseclosedCount + $withdrawnCount + $rejectedCount + 
                          $visaprocessCount + $enrolledCount + $activeStdCount + $otherCount;
        
        if ($calculatedTotal != $counsellor->total_registered) {
            \Log::info("Counselor ID {$counsellor->id} total mismatch: Calculated {$calculatedTotal} vs Actual {$counsellor->total_registered}. Other count: {$otherCount}");
        }

        // 7. Monthly registered students
        $counsellor->monthly_registered = RegisteredInquiry::where('users_id', $counsellor->id)
            ->whereNull('parent_id')
            ->whereYear('created_at', $this->currentYear)
            ->whereMonth('created_at', $this->currentMonth)
            ->count();

        // 8. Active applications count (exclude completed statuses)
        $counsellor->active_count = RegisteredInquiry::where('users_id', $counsellor->id)
            ->whereNull('parent_id')
            ->whereNotIn('inquiry_status', ['caseclosed', 'withdrawn', 'rejection', 'enrollment'])
            ->whereNull('intake_id')
            ->count();
    }

    /**
     * Check if an inquiry has any active children
     */
    protected function hasActiveChildren($parentId)
    {
        return RegisteredInquiry::where('parent_id', $parentId)
            ->whereNotIn('inquiry_status', $this->closedStatuses)
            ->exists();
    }

    /**
     * Get the data of the most recent active child
     */
    protected function getMostRecentActiveChildData($parentId)
    {
        return RegisteredInquiry::where('parent_id', $parentId)
            ->whereNotIn('inquiry_status', $this->closedStatuses)
            ->orderBy('created_at', 'desc')
            ->first(['inquiry_status', 'intake_id']);
    }

    /**
     * Categorize an inquiry based on its status
     */
    protected function categorizeInquiry($status, $intakeId, 
        &$caseclosed, &$withdrawn, &$rejected,
        &$visaprocess, &$enrolled, &$activeStd, &$other)
    {
        if ($status === 'caseclosed') {
            $caseclosed++;
        } elseif ($status === 'withdrawn') {
            $withdrawn++;
        } elseif ($status === 'rejection') {
            $rejected++;
        } elseif ($status === 'visaprocess') {
            $visaprocess++;
        } elseif ($status === 'enrollment' || $intakeId !== null) {
            $enrolled++;
        } elseif (in_array($status, $this->activeStatuses)) {
            $activeStd++;
        } else {
            // Any other status that might exist
            $other++;
        }
    }

    protected function loadOverallStats()
    {
        // Get all active counsellor IDs EXCEPT specific usernames
        $counsellorIds = User::where('role', 'counsellor')
            ->where('status', 1)
            ->whereNotIn('username', ['counsellor1', 'Old Inquiries'])
            ->pluck('id');

        // Get all inquiries for these counsellors
        $allInquiries = RegisteredInquiry::whereIn('users_id', $counsellorIds)
            ->whereNull('parent_id')
            ->get(['id', 'inquiry_status', 'intake_id', 'users_id']);

        // Initialize overall counters
        $overallCounts = [
            'total_counsellors' => $counsellorIds->count(),
            'total_registered' => $allInquiries->count(),
            'total_caseclosed' => 0,
            'total_withdrawn' => 0,
            'total_visaprocess' => 0,
            'total_enrolled' => 0,
            'total_rejected' => 0,
            'total_active_std' => 0,
            'total_other' => 0, // Hidden but ensures total adds up
        ];

        // Process each inquiry with parent-child logic
        foreach ($allInquiries as $inquiry) {
            $status = $inquiry->inquiry_status;
            $hasActiveChildren = $this->hasActiveChildren($inquiry->id);
            
            // Check if inquiry is in closed status AND has active children
            if (in_array($status, $this->closedStatuses) && $hasActiveChildren) {
                // This closed inquiry has active children, so use child's status
                $childData = $this->getMostRecentActiveChildData($inquiry->id);
                
                if ($childData) {
                    $childStatus = $childData['inquiry_status'];
                    $childIntakeId = $childData['intake_id'];
                    
                    // Categorize based on child status
                    $this->categorizeOverallInquiry($childStatus, $childIntakeId, $overallCounts);
                } else {
                    // No active children found, count parent's original status
                    $this->categorizeOverallInquiry($status, $inquiry->intake_id, $overallCounts);
                }
            } else {
                // Normal counting
                $this->categorizeOverallInquiry($status, $inquiry->intake_id, $overallCounts);
            }
        }

        // Calculate active applications total
        $overallCounts['total_active'] = RegisteredInquiry::whereIn('users_id', $counsellorIds)
            ->whereNull('parent_id')
            ->whereNotIn('inquiry_status', ['caseclosed', 'withdrawn', 'rejection', 'enrollment'])
            ->whereNull('intake_id')
            ->count();

        // Monthly registered
        $overallCounts['monthly_registered'] = RegisteredInquiry::whereIn('users_id', $counsellorIds)
            ->whereNull('parent_id')
            ->whereYear('created_at', $this->currentYear)
            ->whereMonth('created_at', $this->currentMonth)
            ->count();

        // Remove the "other" count from display (not needed in UI)
        unset($overallCounts['total_other']);

        $this->overallStats = $overallCounts;
    }

    /**
     * Categorize inquiry for overall stats
     */
    protected function categorizeOverallInquiry($status, $intakeId, &$counts)
    {
        if ($status === 'caseclosed') {
            $counts['total_caseclosed']++;
        } elseif ($status === 'withdrawn') {
            $counts['total_withdrawn']++;
        } elseif ($status === 'rejection') {
            $counts['total_rejected']++;
        } elseif ($status === 'visaprocess') {
            $counts['total_visaprocess']++;
        } elseif ($status === 'enrollment' || $intakeId !== null) {
            $counts['total_enrolled']++;
        } elseif (in_array($status, $this->activeStatuses)) {
            $counts['total_active_std']++;
        } else {
            // Any other status
            $counts['total_other']++;
        }
    }

    public function render()
    {
        return view('livewire.admin.inquiries-detail.registered-detail', [
            'counsellors' => $this->counsellors,
            'overallStats' => $this->overallStats,
            'currentMonth' => now()->format('F')
        ])->layout('layouts.admindashboard');
    }
}