<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class exam_records extends Model
{
    use HasFactory , SoftDeletes; 
   protected $fillable = [
        "exames_id" , "users_id" , "note" , "comment"
   ] ;  

}
