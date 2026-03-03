<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reminder_time',
        'reminder_reason',
        'is_active',
        'reminder_shown',
    ];

    protected $dates = [
        'reminder_time',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
