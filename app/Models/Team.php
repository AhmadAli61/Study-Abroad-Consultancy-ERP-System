<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

public function counsellors()
{
    return $this->belongsToMany(User::class, 'team_counsellor', 'team_id', 'counsellor_id')
                ->where('status', 1);
}


}
