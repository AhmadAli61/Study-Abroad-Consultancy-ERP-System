<?php

namespace App\Http\Controllers;

use App\Models\RegisteredInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
    public function unassignInquiry(Request $request)
    {
        try {
            $request->validate([
                'inquiry_id' => 'required|exists:registered_inquiries,id'
            ]);

            $inquiry = RegisteredInquiry::find($request->inquiry_id);

            if (!$inquiry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Inquiry not found.'
                ], 404);
            }

            if (!$inquiry->assigned_to) {
                return response()->json([
                    'success' => false,
                    'message' => 'Inquiry is already unassigned.'
                ], 400);
            }

            // Perform the unassignment
            DB::transaction(function () use ($inquiry) {
                $inquiry->update([
                    'previous_assigned_to' => $inquiry->assigned_to,
                    'assigned_to' => null,
                    'assigned_at' => null,
                    'status' => 'unassigned',
                    'status_updated_at' => now(),
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Application unassigned successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error unassigning application: ' . $e->getMessage()
            ], 500);
        }
    }
}