<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class UserSession extends Model
{
    use HasFactory;

    protected $table = 'user_sessions'; // Specify the table name if not following Laravel's plural naming convention

    protected $fillable = [
        'user_id',
        'session_id',
        'is_logged_in',
        'last_activity',
    ];

    protected $casts = [
        'is_logged_in' => 'boolean',
        'last_activity' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}