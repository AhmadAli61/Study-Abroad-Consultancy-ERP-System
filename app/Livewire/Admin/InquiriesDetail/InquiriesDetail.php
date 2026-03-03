<?php

namespace App\Livewire\Admin\InquiriesDetail;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inquiiry;
use App\Models\RegisteredInquiry;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InquiriesDetail extends Component
{
    use WithPagination;

    public $user;
    public $statusOrder = ['cold', 'hot', 'dead', 'pending', null];
    public $currentStatusIndex = 0;

    // Statistics properties
    public $totalInquiries;
    public $totalRegistered;
    public $conversionRate;
    public $monthlyInquiries;
    public $monthlyRegistered;
    public $monthlyConversionRate;
    public $statusDistribution;
    public $monthlyPerformance;

    public function mount($user)
    {
        $this->user = User::findOrFail($user);
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        // Total inquiries count
        $this->totalInquiries = Inquiiry::where('assigned_to', $this->user->id)->count();

        // Total registered inquiries count
        $this->totalRegistered = RegisteredInquiry::where('users_id', $this->user->id)
            ->whereNull('parent_id')
            ->count();

        // Overall conversion rate
        $this->conversionRate = $this->totalInquiries > 0 
            ? round(($this->totalRegistered / $this->totalInquiries) * 100, 1)
            : 0;

        // Current month statistics
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $this->monthlyInquiries = Inquiiry::where('assigned_to', $this->user->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $this->monthlyRegistered = RegisteredInquiry::where('users_id', $this->user->id)
            ->whereNull('parent_id')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $this->monthlyConversionRate = $this->monthlyInquiries > 0 
            ? round(($this->monthlyRegistered / $this->monthlyInquiries) * 100, 1)
            : 0;

        // Status distribution
        $this->loadStatusDistribution();

        // Monthly performance (last 6 months)
        $this->loadMonthlyPerformance();
    }

    protected function loadStatusDistribution()
    {
        $statuses = ['hot', 'cold', 'dead', 'pending', 'registered'];
        $distribution = [];

        foreach ($statuses as $status) {
            $count = Inquiiry::where('assigned_to', $this->user->id)
                ->where('inquiry_status', $status)
                ->count();

            $percentage = $this->totalInquiries > 0 ? ($count / $this->totalInquiries) * 100 : 0;

            $distribution[] = [
                'status' => $status,
                'count' => $count,
                'percentage' => $percentage,
                'label' => ucfirst($status),
                'icon' => $this->getStatusIcon($status),
                'color_class' => $this->getStatusColorClass($status),
                'text_class' => $this->getStatusTextClass($status)
            ];
        }

        $this->statusDistribution = $distribution;
    }

   protected function loadMonthlyPerformance()
{
    $months = [];
    for ($i = 5; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $monthStart = $date->copy()->startOfMonth();
        $monthEnd = $date->copy()->endOfMonth();

        $monthInquiries = Inquiiry::where('assigned_to', $this->user->id)
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $monthRegistered = RegisteredInquiry::where('users_id', $this->user->id)
            ->whereNull('parent_id')
            ->whereBetween('created_at', [$monthStart, $monthEnd])
            ->count();

        $conversionRate = $monthInquiries > 0 
            ? round(($monthRegistered / $monthInquiries) * 100, 1)
            : 0;

        $months[] = [
            'month' => $date->format('M Y'),
            'inquiries' => $monthInquiries,
            'registered' => $monthRegistered,
            'conversion_rate' => $conversionRate,
            'full_month' => $date->format('F Y')
        ];
    }

    // Reverse the array to show latest first
    $this->monthlyPerformance = array_reverse($months);
}

   protected function getStatusIcon($status)
{
    $icons = [
        'hot' => 'fas fa-fire',
        'cold' => 'fas fa-snowflake',
        'dead' => 'fas fa-times-circle',
        'pending' => 'fas fa-hourglass-half',
        'registered' => 'fas fa-user-check'
    ];

    return $icons[$status] ?? 'fas fa-question-circle';
}

protected function getStatusColorClass($status)
{
    $colors = [
        'hot' => 'bg-danger',
        'cold' => 'bg-info',
        'dead' => 'bg-dark',
        'pending' => 'bg-warning',
        'registered' => 'bg-success'
    ];

    return $colors[$status] ?? 'bg-secondary';
}

protected function getStatusTextClass($status)
{
    // Remove text classes since we're using colored backgrounds with white text
    return 'text-white';
}

    public function filterByStatus()
    {
        $this->currentStatusIndex = ($this->currentStatusIndex + 1) % count($this->statusOrder);
        $this->resetPage(); // Reset to first page when filtering
    }

public function getInquiriesProperty()
{
    return Inquiiry::where('assigned_to', $this->user->id)
        ->orderByDesc('assigned_at')
        ->orderByDesc('created_at')
        ->paginate(50);
}


    public function viewInquiry($inquiryId)
    {
        // You can implement a modal or redirect to inquiry details
        $this->dispatch('show-inquiry-details', inquiryId: $inquiryId);
    }

    // Add this method to match the sample code
    public function getDateStatus($inquiry)
    {
        $now = now();
        $sevenDaysAgo = $now->subDays(7);
        
        $status = [
            'updated_at_old' => false,
            'assigned_at_pending' => false
        ];
        
        if ($inquiry->updated_at && $inquiry->updated_at->lt($sevenDaysAgo)) {
            $status['updated_at_old'] = true;
        }
        
        if ($inquiry->assigned_at && empty($inquiry->response)) {
            $status['assigned_at_pending'] = true;
        }
        
        return $status;
    }

    public function render()
    {
        return view('livewire.admin.inquiries-detail.inquiries-detail', [
            'user' => $this->user,
            'inquiries' => $this->inquiries,
        ])->layout('layouts.admindashboard');
    }
}