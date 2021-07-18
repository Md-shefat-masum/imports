<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function category()
    {
       return $this->belongsTo('blog_category','category','id');
    }
}
