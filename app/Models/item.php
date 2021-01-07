<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'name',
        'description',
        'price',
        'offer_price',
        'quantity',
        'status',
        'photo'
    ];

    public function sub_category()
    {
        return $this->belongsTo(sub_Category::class,'sub_category_id','id');
    }
}
