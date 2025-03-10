<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annoce extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        "image",
        'users_id',
    ];
}
