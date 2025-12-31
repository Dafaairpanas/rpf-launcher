<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'description',
        'app_url',
        'theme_color',
    ];
}
