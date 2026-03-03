<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intake extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer'
    ];

    // Relationship with creator
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relationship with inquiries
    public function inquiries()
    {
        return $this->hasMany(RegisteredInquiry::class);
    }

    // Scope for active intakes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for intakes from last 5 years
    public function scopeLastFiveYears($query)
    {
        $currentYear = date('Y');
        return $query->where('year', '>=', $currentYear - 5)
                    ->where('year', '<=', $currentYear);
    }

    // Get display name
    public function getDisplayNameAttribute()
    {
        return "{$this->name} {$this->year}";
    }

    // Get enrolled students count for this intake
    public function getEnrolledCountAttribute()
    {
        return $this->inquiries()->where('inquiry_status', 'enrollment')->count();
    }
}