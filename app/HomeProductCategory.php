<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeProductCategory extends Model
{
    protected $appends = [
        'cat_info'
    ];

    public function getCatInfoAttribute()
    {
        if(ProductCategory::where('id',$this->cat_id)->exists()){
            return ProductCategory::where('id',$this->cat_id)->select('cat_name','id')->first();
        }else{
            return [];
        }
    }

    public function products(){
        return $this->hasMany(Product::class,'cat_id','cat_id')->select(['id','cat_id','sub_cat_id','p_name','price','bundle_price','image','status']);
    }

}
