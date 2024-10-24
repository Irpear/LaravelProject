<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    protected $fillable = [
        'title',
        'description',
        'solution',
        'category',
        'status',
        'user_id',
    ];


}
