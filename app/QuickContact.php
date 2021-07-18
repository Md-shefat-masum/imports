<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickContact extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'address_first',
        'address_second',
        'address_third',
        'facebook',
        'twitter',
        'gmail',
        'linkedin',
    ];
}
