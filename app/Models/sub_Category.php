<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_Category extends Model
{
    use HasFactory;

    protected $table = "subcategories";

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'status',
        'photo'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
