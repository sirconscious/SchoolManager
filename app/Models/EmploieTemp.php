<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploieTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'time_slot',
        'subject',
        'teacher',
        'room',
        'grp',
    ];
}
