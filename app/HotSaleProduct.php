<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotSaleProduct extends Model
{


    public function related_product()
    {
        return $this->hasOne('App\Product','id','pro_id');
    }
}
