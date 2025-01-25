<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $guarded = [];

    function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }
}
