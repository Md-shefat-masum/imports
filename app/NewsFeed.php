<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    protected $fillable = [
        'title',
        'link',
        'status',
    ];
}
