<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortalLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'login_time',
        'logout_time',
        'ip_address',
        'device',
        'is_logged_in',
        'session_id', // Store session_id to track sessions
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}