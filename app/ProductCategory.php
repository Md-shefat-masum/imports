<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
	// protected $table='product_categories';
    protected $fillable = ['cat_name','cat_description','status'];

    function posts(){
        return $this->hasMany(Product::class);
    }

    function products(){
        return $this->hasMany(Product::class,'cat_id','id')->select(['id','cat_id','sub_cat_id','p_name','price','bundle_price','image','status']);
    }

    public static function check_products($value){
        dd($value);
    }

    function subcategory()
    {
        return $this->hasMany('App\Subcategory', 'id', 'sub_cat');
    }

}
