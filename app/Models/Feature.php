<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'description',
        'logo'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


    public function getShortDescriptionAttribute()
    {
        return substr(strip_tags($this->attributes["description"]), 0, 20) . '..';
    }

   
}
