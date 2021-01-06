<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = [
        'name',
        'description',
        'status',
    ];


    use HasFactory;
}