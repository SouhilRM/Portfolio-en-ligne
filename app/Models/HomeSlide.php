<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    //tu peux sois faire ca mais vu que tous tes champs sont NULLABLE donc tu peux tous groupe en une seule commande
    /*
        protected $fillable = [
            'title',
            'short_title',
            'home_slide',
            'video_url',
        ];
    */
    protected $guarded = []; //cette commande va tt groupe tres pratique 
    
}
