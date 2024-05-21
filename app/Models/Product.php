<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{


    protected $fillable = [
        'title',
        'image',
        'short_description',
        'description',
        'bg_image1',
        'bg_image2'
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = Str::slug($question->title);
        });
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function questionAnswers()
    {
        return $this->hasMany(Question::class);
    }
}
