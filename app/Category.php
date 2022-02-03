<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Relation with post - categories <--> posts (categories has many posts)
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
