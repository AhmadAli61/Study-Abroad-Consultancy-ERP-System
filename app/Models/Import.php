<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'website',
        'name',
        'email',
        'phone_number',
        'url',
        'type',
        'status',
    ];
}
