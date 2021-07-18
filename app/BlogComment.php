<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'blog_id',
        'author_name',
        'comment',
   ];
}
