<?php

namespace App\Http\Controllers;

use App\AboutOne;
use App\AboutThree;
use App\AboutTwo;
use App\Blog;
use App\Faq;
use App\Menu;
use App\Product;
use App\ProductCategory;
use App\Service;
use App\Submenu;
use App\Terms;
use App\Testimonial;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Session;

class DiscountPageController extends Controller
{
    public function bigsale_discount_page()
    {

        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $product = Product::where('status', '1')
            ->orderBy('id', 'DESC')
            ->paginate(40);

        $productCategory = ProductCategory::all()->sortBy('cat_name');
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        } //dd($this->
        // getCategoriesWithSubCategories();
        return view('front_end.pages.bigsale-discount-product', [
            'categories' => $this->getCategoriesWithSubCategories(),
        ])
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i);
    }
    private function getCategoriesWithSubCategories()
    {
        $categories = ProductCategory::select(['id', 'cat_name'])
            ->where('status', 1)
            ->orderBy('cat_name', 'ASC')
            ->get()
            ->toArray();
        foreach ($categories as $key => $category) {
            $subcategories = Product::select(['id', 'sub_cat_id'])
                ->where('cat_id', $category['id'])
                ->where('status', 1)
                ->get()
                ->toArray();
            $subcategories_id = array_unique(Arr::pluck($subcategories, 'sub_cat_id'));
            $a = DB::table('subcategories')
                ->select(['id', 'name'])
                ->whereIn('id', $subcategories_id)
                ->orderBy('name', 'ASC')
                ->get()
                ->toArray();
            $categories[$key]['subcategories'] = count($a) ? json_decode(json_encode($a), true) : [];
        }

        return $categories;
    }
    public function discount_product_page(Request $request, $discount)
    {
        // $product = DiscountProduct::where('discount_rate', $discount)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(20);
        // return view('front_end.pages.discount-product', compact('product'));
        $category = DB::table('discount_products')->where('discount_rate', $discount)
        ->orderBy('created_at', 'desc')
            ->paginate(20);

        //$product = Product::where('cat_id',$category->id)->get(); //
        $product = Product::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(9); //dd($product);
        //dd($products);
        $menu = Menu::all();
        $faq = Faq::all();
        $terms = Terms::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $productCategory = ProductCategory::all()->sortBy('cat_name'); //dd($productCategory);
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();

        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.discount-product', [
            'categories' => $this->getCategoriesWithSubCategories(), 
            'product' => $product])
            ->withCategory($category)
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq)
            ->withTerms($terms);
    }
}
