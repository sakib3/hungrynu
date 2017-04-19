<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent','name','price','description'
    ];

    public function menu()
    {
        return $this->belongsTo('App\Menu','parent');
    }
}
