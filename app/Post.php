<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = [
       'title',
       'content',
       'slug',
       'category_id',
   ];

   /**
    * Relation with categories - posts <---> categories (A single post has one category)
    */

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
