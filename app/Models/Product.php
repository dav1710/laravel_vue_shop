<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    public function category(){

        return $this->belongsTo('App\Category');
    }
    public function colors(){

        return $this->hasMany(ColorProduct::class);
    }
}
