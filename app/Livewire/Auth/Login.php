<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PortalLog;
use GuzzleHttp\Psr7\Request;
use App\Models\UserSession;

class Login extends Component
{
    public $username, $password;
    public $isLoading = false;
    public $fieldErrors = []; // Add this array to store field-specific errors

    protected $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
    ];

    protected $messages = [
        'username.required' => 'Username is required',
        'password.required' => 'Password is required',
    ];

    public function login()
    {
        $this->isLoading = true;
        $this->fieldErrors = []; // Clear previous field errors
        
        // Validate inputs
        $this->validate();

        $user = User::where('username', $this->username)->first();

        if (!$user) {
            // Username doesn't exist
            $this->fieldErrors['username'] = 'Invalid username';
            $this->isLoading = false;
            return;
        }
        
        if ($user->password !== $this->password) {
            // Wrong password
            $this->fieldErrors['password'] = 'Invalid password';
            $this->isLoading = false;
            return;
        }
        
        if ($user->status == 0) {
            $this->fieldErrors['username'] = 'Your account is disabled. Contact Admin.';
            $this->isLoading = false;
            return;
        }
        
        // All checks passed, proceed with login
        Auth::login($user);

        $sessionId = session()->getId();
        
        UserSession::updateOrCreate(
            ['user_id' => Auth::id(), 'session_id' => $sessionId],
            ['is_logged_in' => true, 'last_activity' => now()]
        );

        PortalLog::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'login_time' => now(),
            'ip_address' => request()->ip(),
            'device' => request()->header('User-Agent'),
            'is_logged_in' => true,
            'session_id' => $sessionId,
        ]);
        
        session(['session_key' => $sessionId]);
        $this->isLoading = false;

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'counsellor' => redirect()->route('agent.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            'admission' => redirect()->route('admission.team.dashboard'),
            'admissionagent' => redirect()->route('admissionagent.dashboard'),
            'externalagent' => redirect()->route('externalagent.dashboard'),
            default => redirect()->route('login')->with('error', 'Unauthorized access'),
        };
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}