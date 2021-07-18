<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'status',
    ];

    protected $appends = [
        'related_image',
        'number_price',
        'bid_price_your_bid',
    ];

    public function getBidPriceYourBidAttribute()
    {
        $start_time =  DB::table('bid_resets')->latest()->first()->reset_at;
        $start_time = Carbon::parse($start_time)->subdays(1);
        $end_time = Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at);
        if(DB::table('all_bids')->where('product_id',$this->id)->whereBetween('created_at',[$start_time,$end_time])->orderBy('id',"DESC")->exists()){
            $bidPrice = DB::table('all_bids')
            ->where('product_id',$this->id)
            ->whereBetween('created_at',[$start_time,$end_time])
            ->orderBy('id',"DESC")
            ->first();
        // dd($all_bids);
        }else{
            $bidPrice = new AllBid();
        }

        // $bidPrice = DB::table('all_bids')->where('product_id',$this->id)->orderBy("id",'DESC')->first();

        if(isset($bidPrice->your_bid))
            return number_format($bidPrice->your_bid != null ? $bidPrice->your_bid : 0);
        else
            return 0;
    }

    public function getRelatedImageAttribute()
    {
        return json_decode($this->image);
    }

    public function getNumberPriceAttribute()
    {
        return number_format($this->price);
    }

    //
    public function Category(){
        return $this->hasOne(ProductCategory::class,'id','cat_id');
    }
    public function Brand(){
        return $this->hasOne(Brand::class,'id','brand');
    }

    public function Unit(){
        return $this->hasOne(Unit::class,'id','unit');
    }

//     public function children()
// {
//     return $this->hasMany('App\Brand', 'id', 'brand');
// }
}
