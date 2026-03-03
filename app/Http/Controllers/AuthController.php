<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PortalLog;
use App\Models\UserSession;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function logout()
    {
        $sessionId = session('session_key');  // Get the current session ID
    
        // Update the portal log entry with the logout time and mark as not logged in
        $log = PortalLog::where('user_id', Auth::id())
                        ->where('session_id', $sessionId)
                        ->where('is_logged_in', true)
                        ->latest()
                        ->first();
    
        if ($log) {
            // Update the logout time for the current session log entry
            $log->update([
                'logout_time' => now(),
                'is_logged_in' => false
            ]);
        }
    
        // Update the user_sessions table to mark the session as logged out
        UserSession::where('user_id', Auth::id())
                   ->where('session_id', $sessionId)
                   ->update(['is_logged_in' => false]);
    
        // Logout the user and invalidate the session
        Auth::logout();
        session()->regenerateToken(); // Regenerate the CSRF token
    
        // Redirect to login page with a success message
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
    

}
