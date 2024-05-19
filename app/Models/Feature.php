<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function getShortDescriptionAttribute()
    {
        return substr(strip_tags($this->attributes["description"]), 0, 20) . '..';
    }

   
}
