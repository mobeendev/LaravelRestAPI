<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = ['name', 'sub_category_id'];

    public function products() {
        return $this->belongsToMany(Product::class)
                        ->withPivot('size', 'color');
    }

}
