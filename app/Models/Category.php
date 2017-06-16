<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'slug'];

    protected $fillable = ['name', 'slug'];

    public function posts(){
        return $this->hasMany('\App\Post');
    }
}
