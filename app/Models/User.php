<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'status',
        'parent_id',
        'user_type',
        'permission_level' // ADD THIS

    ];

    // Relationship: Parent user (for assistants)
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // Relationship: Child users (assistants)
    public function assistants()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
    

    // Check if user is an assistant
    public function isAssistant()
    {
        return $this->user_type === 'assistant';
    }

    // Check if user is a primary agent
    public function isPrimaryAgent()
    {
        return $this->user_type === 'primary' && $this->role === 'admissionagent';
    }

    // Get the primary agent (returns self for primary, parent for assistants)
    public function getPrimaryAgent()
    {
        return $this->isAssistant() ? $this->parent : $this;
    }

    // Scope for primary admission agents
    public function scopePrimaryAdmissionAgents($query)
    {
        return $query->where('role', 'admissionagent')
                    ->where('user_type', 'primary');
    }

    // Scope for assistants
    public function scopeAssistants($query)
    {
        return $query->where('user_type', 'assistant');
    }

    // Existing methods remain the same...
    public function isActive()
    {
        return $this->status == 1;
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }
    
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_counsellor', 'counsellor_id', 'team_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id');
    }
       public function assignedInquiries()
    {
        return $this->hasMany(RegisteredInquiry::class, 'assigned_to');
    }
    
    public function inquiries()
    {
        return $this->hasMany(Inquiiry::class, 'assigned_to');
    }
    
    public function admissionTeams()
    {
        return $this->belongsToMany(TeamAdmission::class, 'team_admission_agent', 'agent_id', 'team_id');
    }

    public function managedAdmissionTeams()
    {
        return $this->hasMany(TeamAdmission::class, 'manager_id');
    }
}