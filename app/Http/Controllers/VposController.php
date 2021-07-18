<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutOne;
use App\AboutTwo;
use App\AboutThree;
use App\Product;
use Session;
class VposController extends Controller
{
    public function all_products()
    {
        $products = Product::select(['id', 'image', 'p_name', 'unit', 'price', 'min_quientity', 'bundle_price'])->get();
        return $products;
    }

    public function get_products($id)
    {
        header("Access-Control-Allow-Origin:*");
        header("Contetnt-Type:application/json");

        $products = Product::where('id', $id)->select(['id', 'image', 'p_name','p_description', 'bundle_price'])->first();
        return $products;
    }

    public function get_products_all_info($id)
    {
        header("Access-Control-Allow-Origin:*");
        header("Contetnt-Type:application/json");

        $products = Product::where('id', $id)->with('category','brand','unit')->first();
        return $products;
    }
}
