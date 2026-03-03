<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamAdmission extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function agents()
    {
        return $this->belongsToMany(User::class, 'team_admission_agent', 'team_id', 'agent_id')
                    ->where('status', 1);
    }
}