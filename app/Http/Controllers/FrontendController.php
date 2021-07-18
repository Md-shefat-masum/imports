<?php

namespace App\Http\Controllers;

use App\AboutOne;
use App\AboutThree;
use App\AboutTwo;
use App\Blog;
use App\Brand;
use App\Contact;
use App\ContactMessage;
use App\Faq;
use App\HomeProductCategory;
use App\GadgetsProductCategory;
use App\HotSaleProduct;
use App\Mail\SendMail;
use App\Mail\SupplierMail;
use App\Menu;
use App\Policy;
use App\Product;
use App\ProductCategory;
use App\Service;
use App\Slider;
use App\SliderProduct;
use App\Submenu;
use App\Subscribe;
use App\Supplier;
use App\Terms;
use App\Testimonial;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB as FacadesDB;

class FrontendController extends Controller
{


    public function epaymaker_payment_status(Request $request)
    {
        $data = $request->input();
        if (isset($data)) {
            $order_id = (int)$data['order_id'] - 1000;

            DB::table('orders')->where('id', $order_id)->update([
                'payment_status' => 'paid'
            ]);
            return 'success';
        }

        return 'failed';
    }

    public function epaymaker_status(Request $request)
    {
        Session::flash('success', 'Your Payment Is Successful');
        return redirect()->route('frontMain');
    }



    public function suppliers_register()
    {

        $token = isset($_GET['token']) ? $_GET['token'] : null;
        $databaseToken = $data = DB::table('verification')->where('token', $token)->first();

        if (isset($databaseToken)) {
            Session::put('email', $databaseToken->email);
            Session::put('phone', $databaseToken->phone);



            $menu = Menu::all();
            $submenu = Submenu::all();
            $service = Service::all();
            $tes = Testimonial::all();
            $blog = Blog::all();
            $aboutOne = AboutOne::all();
            $aboutTwo = AboutTwo::all();
            $aboutThree = AboutThree::all();
            $product = Product::all();
            $productCategory = ProductCategory::all();
            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')
                ->where(['session_id' => $session_id])
                ->get();
            for ($i = 0; $i < count($userCart); $i++) {
            }

            if (isset($_GET['verification']) && isset($_GET['_token'])) {


                $email = $_GET['verification'];
                $user_type = $request->userType;
                if (!isset($user_type)) {
                    $user_type = $_GET['userType'];
                }

                $request_user = DB::table('users')->where('email', $email)->first();

                if (isset($request_user)) {
                    if ($request->_token == $request_user->verify_token) {
                        DB::table('users')->where('email', $email)->update([
                            'email_verified_at' => Carbon::now(),
                            'verify_token' => '',
                        ]);
                        return redirect()->back()->with('email-verified', $email);
                    } else {
                        return redirect()->route('supplierLogin')->with('error', 'Your verification token is not valid or used. !!');
                    }
                } else {
                    return redirect()->route('supplierLogin')->with('error', 'We couldn\'t find this email in our database !!');
                }
            }

            return view('front_end.pages.suppliers_register')
                ->withMenu($menu)
                ->withSubmenu($submenu)
                ->withService($service)
                ->withTes($tes)
                ->withBlog($blog)
                ->withProduct($product)
                ->withProductCategory($productCategory)
                ->withI($i)
                ->withAboutOne($aboutOne)
                ->withAboutTwo($aboutTwo)
                ->withAboutThree($aboutThree);
        } else {
            Session::put('user_type', 'suppliers');
            return redirect()->route('user_email_check');
        }
    }

    public function index()
    {
        $counter = DB::table('visitor_counter')
            ->where('id', 1)
            ->first()->counter;

        DB::table('visitor_counter')
            ->where('id', 1)
            ->update([
                'counter' => $counter + 1,
            ]);

        $contact = Contact::all();
        $faq = Faq::all();
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::where('status', 1)
            ->where('type', 'admin')
            ->get();
        $product = Product::all();
        $slider = Slider::all();
        $homecats = HomeProductCategory::where('cat_status', 1)->get();
        $gadgetcats = GadgetsProductCategory::where('cat_status', 1)->orderBy('id', 'DESC')->take(1)->get();
        $productCategory = ProductCategory::all()->sortBy('cat_name');
        $sliderProduct = SliderProduct::where('slider_position', 1)
            ->inRandomOrder()
            ->take(10)
            ->get();
        $sliderProduct2 = SliderProduct::where('slider_position', 0)
            ->inRandomOrder()
            ->take(10)
            ->get();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        $categories = $this->getHomeCategoriesWithSubCategories();
        // dd($categories);
        return view('front_end.pages.home', compact('categories'))
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withSlider($slider)
            ->withHomecats($homecats)
            ->withGadgetcats($gadgetcats)
            ->withSliderProduct($sliderProduct)
            ->withI($i)
            ->withContact($contact)
            ->with('sliderProduct2', $sliderProduct2);
    }

    public function curentAuction()
    {
        $counter = DB::table('visitor_counter')
            ->where('id', 1)
            ->first()->counter;

        DB::table('visitor_counter')
            ->where('id', 1)
            ->update([
                'counter' => $counter + 1,
            ]);

        $contact = Contact::all();
        $faq = Faq::all();
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::where('status', 1)
            ->where('type', 'admin')
            ->get();
        $product = Product::all();
        $slider = Slider::all();
        $productCategory = ProductCategory::all()->sortBy('cat_name');
        $sliderProduct = SliderProduct::where('slider_position', 1)
            ->inRandomOrder()
            ->take(1)
            ->get();
        $sliderProduct2 = SliderProduct::where('slider_position', 0)
            ->inRandomOrder()
            ->take(1)
            ->get();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.current_auction')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withSlider($slider)
            ->withSliderProduct($sliderProduct)
            ->withI($i)
            ->withContact($contact)
            ->with('sliderProduct2', $sliderProduct2);
    }

    public function about()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.about')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree);
    }

    public function supplier(Request $request)
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        if (isset($_GET['verification']) && isset($_GET['userType'])) {
            $email = $request->verification;
            $token = DB::table('users')
                ->where('email', $email)
                ->select('verify_token', 'email_verified_at', 'email')
                ->first();
            if (isset($token)) {
                if ($request->_token == $token->verify_token) {
                    DB::table('users')
                        ->where('email', $email)
                        ->update([
                            'email_verified_at' => Carbon::now(),
                            'verify_token' => '',
                        ]);
                    return redirect()
                        ->route('enterprenorLogin')
                        ->with('error', 'Successfully Email Verified');
                }
            }
        }
        if (isset($_GET['verification']) && isset($_GET['_token'])) {
            $email = $request->verification;
            $token = DB::table('users')
                ->where('email', $email)
                ->select('verify_token', 'email_verified_at', 'email')
                ->first();

            if (isset($token)) {
                if ($request->_token == $token->verify_token) {
                    DB::table('users')
                        ->where('email', $email)
                        ->update([
                            'email_verified_at' => Carbon::now(),
                            'verify_token' => '',
                        ]);
                    $request->session()->flash('email-verified', $token->email);
                    return view('front_end.pages.supplier')
                        ->withMenu($menu)
                        ->withSubmenu($submenu)
                        ->withService($service)
                        ->withTes($tes)
                        ->withBlog($blog)
                        ->withProduct($product)
                        ->withProductCategory($productCategory)
                        ->withI($i)
                        ->withAboutOne($aboutOne)
                        ->withAboutTwo($aboutTwo)
                        ->withAboutThree($aboutThree);
                } else {
                    $dbEmail = DB::table('users')
                        ->where('email', $email)
                        ->select('email', 'first_name')
                        ->first();
                    if ($dbEmail->first_name == null) {
                        $request->session()->flash('email-verified', $dbEmail->email);
                        return view('front_end.pages.supplier')
                            ->withMenu($menu)
                            ->withSubmenu($submenu)
                            ->withService($service)
                            ->withTes($tes)
                            ->withBlog($blog)
                            ->withProduct($product)
                            ->withProductCategory($productCategory)
                            ->withI($i)
                            ->withAboutOne($aboutOne)
                            ->withAboutTwo($aboutTwo)
                            ->withAboutThree($aboutThree);
                    } else {
                        return abort(404);
                    }
                }
            }

            return abort(404);
        }

        return view('front_end.pages.supplier')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree);
    }

    public function daily_flat_sale(Request $request)
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();
        $blog = Blog::where('type', 'supplier')
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.daily-flash-sales')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function blog_add_to_popup(Request $request, $id)
    {
        Blog::where('add_to_popup', 1)->update([
            'add_to_popup' => 0,
        ]);
        Blog::where('id', $id)->update([
            'add_to_popup' => 1,
        ]);
        return redirect()
            ->back()
            ->with('success', 'blog added to pop up');
    }

    public function blog_add_to_latest_flash_sale(Request $request, $id)
    {
        Blog::where('id', $id)->update([
            'add_to_latest' => 1,
        ]);
        return redirect()
            ->back()
            ->with('success', 'blog added to latest');
    }

    public function blog_remove_from_latest_flash_sale(Request $request, $id)
    {
        Blog::where('id', $id)->update([
            'add_to_latest' => 0,
        ]);
        return redirect()
            ->back()
            ->with('success', 'blog remove from latest');
    }

    public function emailVerify(Request $request)
    {
        $email = $request->verification;
        $user_type = $request->userType;
        $request_user = DB::table('users')
            ->where('email', $email)
            ->first();

        if (isset($request_user)) {
            if ($request->_token == $request_user->verify_token) {
                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'email_verified_at' => Carbon::now(),
                        'verify_token' => '',
                    ]);
                //Session::flash('success', 'Successfully Verify');
                //Session::flash('email-verified', $email);
                //return redirect()->route('frontMain');
                if ($user_type == 'entrepreneur') {
                    return redirect()
                        ->route('enterprenorLogin')
                        ->with('success', 'Thanks For Verification !!');
                } else {
                    return redirect()
                        ->route('supplierLogin')
                        ->with('success', 'Thanks For Verification !!');
                }
            } else {
                //Session::flash('success', 'Already Verify');
                //return redirect()->route('frontMain');
                if ($user_type == 'entrepreneur') {
                    return redirect()
                        ->route('enterprenorLogin')
                        ->with('error', 'Already Verified !!');
                } else {
                    return redirect()
                        ->route('supplierLogin')
                        ->with('error', 'Already Verified !!');
                }
            }
        }
        //Session::flash('success', 'Successfully Verify');
        if ($user_type == 'entrepreneur') {
            return redirect()
                ->route('enterprenorLogin')
                ->with('error', 'Your verification token is not valid. !!');
        } else {
            return redirect()
                ->route('supplierLogin')
                ->with('error', 'Your verification token is not valid. !!');
        }
    }

    public function user_verification(Request $request)
    {
        if (isset($_GET['verification']) && isset($_GET['_token'])) {


            $email = $_GET['verification'];

            $request_user = DB::table('users')->where('email', $email)->first();

            if (isset($request_user)) {
                if ($request->_token == $request_user->verify_token) {
                    DB::table('users')->where('email', $email)->update([
                        'email_verified_at' => Carbon::now(),
                        'verify_token' => '',
                    ]);
                    return redirect()->route('frontMain')->with('success', 'Your email has been successfully verified');
                } else {
                    return redirect()->route('frontMain')->with('error', 'Your verification token is not valid or used. !!');
                }
            } else {
                return redirect()->route('frontMain')->with('error', 'We couldn\'t find this email in our database !!');
            }
        }
    }
    public function supplierLogin(Request $request)
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        if (isset($_GET['verification']) && isset($_GET['_token'])) {


            $email = $_GET['verification'];
            $user_type = $request->userType;
            if (!isset($user_type)) {
                $user_type = $_GET['userType'];
            }

            $request_user = DB::table('users')->where('email', $email)->first();

            if (isset($request_user)) {
                if ($request->_token == $request_user->verify_token) {
                    DB::table('users')->where('email', $email)->update([
                        'email_verified_at' => Carbon::now(),
                        'verify_token' => '',
                    ]);
                    return redirect()->back()->with('email-verified', $email);
                } else {
                    return redirect()->route('supplierLogin')->with('error', 'Your verification token is not valid or used. !!');
                }
            } else {
                return redirect()->route('supplierLogin')->with('error', 'We couldn\'t find this email in our database !!');
            }
        }

        return view('front_end.pages.suppliers_login')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree);
    }

    public function supplierRegister(Request $request)
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        $countryName = DB::table('countries')
            ->where('id', $request->country)
            ->select('name')
            ->first();

        $data = $request->all();

        $user = new User();
        $user->email = Session::get('email');
        $user->cell_phone = Session::get('phone');
        $user->password = Hash::make($data['password']);
        $user->first_name = $data['name'];
        $user->address = $data['address'];
        $user->country = $countryName->name;
        $user->states = $data['states'];
        $user->user_action = 'active';
        $user->user_type = 'supplier';
        $user->group_id = '4';
        $user->email_verified_at = Carbon::now();
        $user->save();

        $time = Carbon::now();
        $data = [
            'email' => 'iazharul351@gmail.com',
            'name' => 'Supper Admin',
            'message' => 'Registered a new Supplier',
            'url' => 'this-is-ok.',
            'time' => $time,
            'userType' => 'Supplier',
        ];

        Mail::to('bizdev@freeworldimports.com')->send(new SupplierMail($data));
        Mail::to('sumonahmed123@gmail.com')->send(new SupplierMail($data));
        //Mail::to('iazharul351@gmail.com')->send(new SupplierMail($data));

        $request->session()->flash('success', 'You scessfully register');

        return view('front_end.pages.suppliers_login')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree);
    }

    public function ent()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.enterpreuner')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree);
    }

    public function faq()
    {
        $menu = Menu::all();
        $faq = Faq::where('status', 1)->get();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();
        $blog = Blog::where('type', 'faq')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.faq')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function ForumSupplier()
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();
        $blog = Blog::where('type', 'supplier')
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.spForum')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function get_allcat_forum(Request $request)
    {
        if ($request->id == 'all') {
            $blogs = Blog::where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } elseif (isset($request->cat)) {
            $blogs = Blog::where('category', $request->cat)
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $blogs = Blog::where('sub_category', $request->id)
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        if (count($blogs) > 0) {
            foreach ($blogs as $b) {
                echo '<div class="col-lg-3 col-md-4 col-12 ">';
                echo '<article class="single_product">';
                echo '<figure>';
                echo '<div class="product_thumb">';
                echo '<a href="/blog-details/' . $b->id . '">';
                echo '<img src="/images/blog/' . $b->image . '" alt="" style="height: 243px;"></a>';
                echo '<div class="label_product">';

                echo '</div>';

                echo '</div>';

                echo '<div class="product_content grid_content">';
                echo '<div class="product_content_inner">';
                echo '<?php $readmore="...";?>';
                echo '<h4 class="product_name product_name_two"><a href="/blog-details/' . $b->id . '">';
                echo substr(strip_tags($b->title), 0, 50);
                echo strlen(strip_tags($b->title)) > 50 ? "..." : "";
                echo '</a>';
                echo '</h4>';
                echo '<div class="price_box" style="padding: 20px 0px 0px 0px;">';

                echo '<div class="current_price_two">';
                echo '<span class="current_price">';
                echo '<a href="/blog-details/' . $b->id . '"> Read More';
                echo '</a>';
                echo '</span>';
                echo '<br>';
                echo '</div>';

                echo '</div>';
                echo '</div>';

                echo '</div>';

                echo '</figure>';
                echo '</article>';
                echo '</div>';
            }
        } else {
            echo "There is no blog in this category";
        }
    }

    public function get_subcat_forum(Request $request)
    {
        if ($request->id == 'all') {
            $blogs = Blog::where('type', 'supplier')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } elseif (isset($request->cat)) {
            $blogs = Blog::where('category', $request->cat)
                ->where('type', 'supplier')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $blogs = Blog::where('sub_category', $request->id)
                ->where('type', 'supplier')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        if (count($blogs) > 0) {
            foreach ($blogs as $b) {
                echo '<div class="col-lg-3 col-md-4 col-12 ">';
                echo '<article class="single_product">';
                echo '<figure>';
                echo '<div class="product_thumb">';
                echo '<a href="/blog-details/' . $b->id . '">';
                echo '<img src="/images/blog/' . $b->image . '" alt="" style="height: 243px;"></a>';
                echo '<div class="label_product">';

                echo '</div>';

                echo '</div>';

                echo '<div class="product_content grid_content">';
                echo '<div class="product_content_inner">';
                echo '<?php $readmore="...";?>';
                echo '<h4 class="product_name product_name_two"><a href="/blog-details/' . $b->id . '">';
                echo substr(strip_tags($b->title), 0, 50);
                echo strlen(strip_tags($b->title)) > 50 ? "..." : "";
                echo '</a>';
                echo '</h4>';
                echo '<div class="price_box" style="padding: 20px 0px 0px 0px;">';

                echo '<div class="current_price_two">';
                echo '<span class="current_price">';
                echo '<a href="/blog-details/' . $b->id . '"> Read More';
                echo '</a>';
                echo '</span>';
                echo '<br>';
                echo '</div>';

                echo '</div>';
                echo '</div>';

                echo '</div>';

                echo '</figure>';
                echo '</article>';
                echo '</div>';
            }
        } else {
            echo "There is no blog in this category";
        }
    }

    public function get_oe_subcat_forum(Request $request)
    {
        if ($request->id == 'all') {
            $blogs = Blog::where('type', 'entrepreneur')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } elseif (isset($request->cat)) {
            $blogs = Blog::where('category', $request->cat)
                ->where('type', 'entrepreneur')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $blogs = Blog::where('sub_category', $request->id)
                ->where('type', 'entrepreneur')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        if (count($blogs) > 0) {
            foreach ($blogs as $b) {
                echo '<div class="col-lg-3 col-md-4 col-12 ">';
                echo '<article class="single_product">';
                echo '<figure>';
                echo '<div class="product_thumb">';
                echo '<a href="/blog-details/' . $b->id . '">';
                echo '<img src="/images/blog/' . $b->image . '" alt="" style="height: 243px;"></a>';
                echo '<div class="label_product">';

                echo '</div>';

                echo '</div>';

                echo '<div class="product_content grid_content">';
                echo '<div class="product_content_inner">';
                echo '<?php $readmore="...";?>';
                echo '<h4 class="product_name product_name_two"><a href="/blog-details/' . $b->id . '">';
                echo substr(strip_tags($b->title), 0, 50);
                echo strlen(strip_tags($b->title)) > 50 ? "..." : "";
                echo '</a>';
                echo '</h4>';
                echo '<div class="price_box" style="padding: 20px 0px 0px 0px;">';

                echo '<div class="current_price_two">';
                echo '<span class="current_price">';
                echo '<a href="/blog-details/' . $b->id . '"> Read More';
                echo '</a>';
                echo '</span>';
                echo '<br>';
                echo '</div>';

                echo '</div>';
                echo '</div>';

                echo '</div>';

                echo '</figure>';
                echo '</article>';
                echo '</div>';
            }
        } else {
            echo "There is no blog in this category";
        }
    }

    public function forum_supplier_cat($cat)
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();

        if ($cat == 'All') {
            $blog = Blog::where('type', 'supplier')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } else {
            $blog = Blog::where('type', 'supplier')
                ->where('status', 1)
                ->where('category', $cat)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        }
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.spForum')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function ForumEntrepreneur()
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();
        $blog = Blog::where('type', 'entrepreneur')
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.oe')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function forum_entrepreneur_cat($cat)
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        //$blog=Blog::all();

        if ($cat == 'All') {
            $blog = Blog::where('type', 'entrepreneur')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        } else {
            $blog = Blog::where('type', 'entrepreneur')
                ->where('status', 1)
                ->where('category', $cat)
                ->orderBy('created_at', 'DESC')
                ->paginate(12);
        }

        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.oe')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq);
    }

    public function policy()
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $policy = Policy::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.policy')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq)
            ->withPolicy($policy);
    }

    public function terms()
    {
        $menu = Menu::all();
        $faq = Faq::all();
        $terms = Terms::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $aboutOne = AboutOne::all();
        $aboutTwo = AboutTwo::all();
        $aboutThree = AboutThree::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.terms')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq)
            ->withTerms($terms);
    }

    public function category(Request $request, $id)
    {
        $category = DB::table('subcategories')
            ->where('id', $id)
            ->first(); //dd($category);

        //$product = Product::where('cat_id',$category->id)->get(); //
        $product = Product::where('sub_cat_id', $id)
            ->where('status', '1')
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
        return view('front_end.pages.cat', ['categories' => $this->getCategoriesWithSubCategories(), 'product' => $product])
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
    // public function forum_supplier(Request $request, $id)
    // {

    // $category = DB::table('blog_sub_cat')->where('id', $id)->first();
    // $products = Blog::where('category', $id)->where('type', 'supplier')->where('status',
    // 1)->orderBy('created_at', 'DESC')->paginate(12);

    // $productCategory = DB::table('blog_category')->orderBy('cat_name')->get();

    // return view('front_end.pages.spForum_cat', [
    // 'products' => $products
    // ])->withCategory($category)
    // ->withProductCategory($productCategory);
    // }
    // public function forum_entrepreneur(Request $request, $id)
    // {

    // $category = DB::table('blog_sub_cat')->where('id', $id)->first();
    // $products = Blog::where('category', $id)->where('type', 'entrepreneur')->where('status',
    // 1)->orderBy('created_at', 'DESC')->paginate(12);

    // $productCategory = DB::table('blog_category')->orderBy('cat_name')->get();

    // return view('front_end.pages.oeForum_cat', [
    // 'products' => $products
    // ])->withCategory($category)
    // ->withProductCategory($productCategory);
    // }

    private function getblogCategoriesWithSubCategories()
    {
        $categories = DB::table('blog_category')
            ->where('cat_name', 'id')
            ->where('status', 1)
            ->orderBy('cat_name', 'ASC')
            ->get()
            ->toArray();

        foreach ($categories as $key => $category) {
            $subcategories = Blog::select(['id', 'sub_category'])
                ->where('type', 'entrepreneur')
                ->where('category', $category['id'])
                ->where('status', 1)
                ->get()
                ->toArray();
            $subcategories_id = array_unique(Arr::pluck($subcategories, 'sub_category'));
            $a = DB::table('blog_sub_cat')
                ->select(['id', 'sub_cat_name'])
                ->whereIn('id', $subcategories_id)
                ->orderBy('sub_cat_name', 'ASC')
                ->get()
                ->toArray();
            $categories[$key]['blog_sub_cat'] = count($a) ? json_decode(json_encode($a), true) : [];
        }

        return $categories;
    }

    public function subCategory($id)
    {
        $category = ProductCategory::where('sub_cat', $id)->first();

        $product = Product::where('sub_cat_id', $id)->get(); //dd($product);

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
        $product = Product::find($id);

        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.cat')
            ->withCategory($category)
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withAboutOne($aboutOne)
            ->withAboutTwo($aboutTwo)
            ->withAboutThree($aboutThree)
            ->withFaq($faq)
            ->withTerms($terms)
            ->withProduct($product);
    }

    public function product()
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

        return view('front_end.pages.product', [
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

    private function getHomeCategoriesWithSubCategories()
    {
        $categories = HomeProductCategory::select(['id', 'cat_id'])
            ->where('cat_status', 1)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
        foreach ($categories as $key => $category) {
            $subcategories = Product::select(['id', 'sub_cat_id'])
                ->where('cat_id', $category['cat_id'])
                ->where('status', 1)
                ->get()
                ->toArray();
            $subcategories_id = array_unique(Arr::pluck($subcategories, 'sub_cat_id'));
            $a = FacadesDB::table('subcategories')
                ->select(['id', 'name'])
                ->whereIn('id', $subcategories_id)
                ->orderBy('name', 'ASC')
                ->get()
                ->toArray();
            $categories[$key]['subcategories'] = count($a) ? json_decode(json_encode($a), true) : [];
        }

        return $categories;
    }

    private function getCategoriesWithSubCategoriesForJson($paginate_number)
    {

        $categories = HomeProductCategory::select(['id', 'cat_id'])
            ->where('cat_status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
        foreach ($categories as $key => $category) {
            $category->product = $category->products()->paginate($paginate_number);
            $subcategories = Product::select(['id', 'sub_cat_id'])
                ->where('cat_id', $category->cat_id)
                ->where('status', 1)
                ->get()
                ->toArray();
            $subcategories_id = array_unique(Arr::pluck($subcategories, 'sub_cat_id'));
            $a = FacadesDB::table('subcategories')
                ->select(['id', 'name'])
                ->whereIn('id', $subcategories_id)
                ->orderBy('name', 'ASC')
                ->get()
                ->toArray();
            $categories[$key]['subcategories'] = count($a) ? json_decode(json_encode($a), true) : [];
        }

        // dd($categories);
        return $categories;
    }


    public function category_product_json($paginate_number)
    {
        return $this->getCategoriesWithSubCategoriesForJson($paginate_number);
    }

    public function hot_sales_json($paginate_number)
    {
        $item = HotSaleProduct::orderBy('id', 'DESC')
            ->with('related_product')
            ->where('hot_sale_status', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('products')
                    ->whereRaw('hot_sale_products.pro_id = products.id');
            })
            ->paginate($paginate_number);
        return $item;
    }

    public function serachProduct(Request $request)
    {
        $key = $request->search;

        //$product = Product::all();
        $proCat = ProductCategory::where('cat_name', $key)->first();
        if (isset($proCat)) {
            $product = Product::where('cat_id', $proCat->id)->paginate(9);
        } else {
            $product = Product::where('p_name', $key)
                ->orWhere('p_name', 'like', '%' . $key . '%')
                ->orWhere('brand', 'like', '%' . $key . '%')
                ->orWhere('model', 'like', '%' . $key . '%')
                ->orWhere('price', 'like', '%' . $key . '%')
                ->orWhere('p_quientity', 'like', '%' . $key . '%')
                ->paginate(9);

            if (count($product) < 1) {
                $proCat = ProductCategory::where('cat_name', $key)
                    ->orWhere('cat_name', 'like', '%' . $key . '%')
                    ->first();
                if (isset($proCat)) {
                    $product = Product::where('cat_id', $proCat->id)->paginate(9);
                }
            }
        }

        if (count($product) < 1) {
            $request->session()->flash('test', 'Nodata');
            $request->session()->flash('section', 'Nodata');
        }
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        $product->appends(['search' => $key]);
        return view('front_end.pages.product', [
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

    public function contact()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $contact = Contact::all();
        $blog = Blog::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.contact_sumit')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withContact($contact);
    }

    public function ContactPost(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);


        $checkEmail = DB::table('spam_emails')->where('email', $request->email)->first();

        if (!isset($checkEmail)) {

            $contactMsg = new ContactMessage();
            $contactMsg->full_name = $request->full_name;
            $contactMsg->phone = $request->phone;
            $contactMsg->email = $request->email;
            $contactMsg->message = $request->message;

            $contactMsg->save();
            Session::flash('success', 'Contact Message Successfully Send');
        } else {
            Session::flash('error', 'Your mail is blocked please contact with administration ');
        }


        return back();
    }

    public function porduct_details($id)
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $product = Product::find($id);
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.product_details')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i);
    }

    public function bid($id)
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $product = Product::find($id);
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.shopingCart')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i);
    }

    public function user_dashboard()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::all();
        $product = Product::all();
        $productCategory = ProductCategory::all();
        return view('front_end.pages.user_dashboard')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory);
    }

    public function blogDetails($id)
    {

        $menu = Menu::all();
        $submenu = Submenu::all();
        $service = Service::all();
        $tes = Testimonial::all();
        $blog = Blog::find($id);
        $product = Product::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }

        return view('front_end.pages.blog_details', ['categories' => $this->getCategoriesWithSubCategories()])
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withService($service)
            ->withTes($tes)
            ->withBlog($blog)
            ->withProduct($product)
            ->withProductCategory($productCategory)
            ->withI($i);
    }

    public function subscriber(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $newEmail = $request->email;
        $existEmail = Subscribe::where('email', $newEmail)->first();

        if (isset($existEmail)) {
            Session::flash(
                'success',
                'This email already exists
                                                            !!!'
            );
            return back();
        } else {
            $sub = new Subscribe();
            $sub->email = $newEmail;
            $sub->save();
            Session::flash(
                'success',
                'Thank you for subscribing to
                                                            our
                                                            Newsletter'
            );
            return back();
        }
    }

    public function payment()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $productCategory = ProductCategory::all();
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        return view('front_end.pages.payment')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withProductCategory($productCategory)
            ->withI($i);
    }

    public function profile()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $productCategory = ProductCategory::all();
        $user_id = \Auth::user()->id;
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($i = 0; $i < count($userCart); $i++) {
        }
        $details = User::find($user_id);
        return view('front_end.pages.profile')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withProductCategory($productCategory)
            ->withI($i)
            ->withDetails($details);
    }

    public function myOrder()
    {
        $menu = Menu::all();
        $submenu = Submenu::all();
        $productCategory = ProductCategory::all();
        $user_id = \Auth::user()->id;
        $session_id = Session::get('session_id');
        $userCart = DB::table('carts')
            ->where(['session_id' => $session_id])
            ->get();
        for ($r = 0; $r < count($userCart); $r++) {
        }
        $orders = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('users.*', 'order_details.*', 'orders.*', 'products.p_name')
            ->where(['orders.user_id' => $user_id])
            ->get();

        if (isset($_GET['verification']) && isset($_GET['_token'])) {
            $id = $request->id;
            $token = DB::table('orders')
                ->where('id', $id)
                ->select('order_verification')
                ->first();
            if ($request->_token == $token->order_verification) {
                DB::table('orders')
                    ->where('id', $id)
                    ->update([
                        'status' => 2,
                        'order_verification' => Carbon::now(),
                    ]);
                return view('front_end.pages.order')
                    ->withMenu($menu)
                    ->withSubmenu($submenu)
                    ->withProductCategory($productCategory)
                    ->withR($r)
                    ->withOrders($orders);
            }
            return view('front_end.pages.order')
                ->withMenu($menu)
                ->withSubmenu($submenu)
                ->withProductCategory($productCategory)
                ->withR($r)
                ->withOrders($orders);
        }

        return view('front_end.pages.order')
            ->withMenu($menu)
            ->withSubmenu($submenu)
            ->withProductCategory($productCategory)
            ->withR($r)
            ->withOrders($orders);
    }

    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);


        list($username, $domain) = explode('@', $request->email);

        if ($domain == 'gmail.com' || $domain == 'yahoo.com' || 'hotmail.com') {
            Session::flash('error', 'Please use your company mail or contact with administration !');
            return back();
        } else {
            $email = $request->email;



            $emailMatch = User::where('email', $email)->first();

            if (isset($emailMatch)) {
                return redirect()->back()->with('email-exists', 'Your email address already exists');
            } else {
                $token_key = Str::random(150);
                $url = 'suppliers-login?verification=' . $email . '&' . '_token=' . $token_key . '&userType=supplier';
                $time = Carbon::now();
                $data = [
                    'email' => $email,
                    'url' => $url,
                    'time' => $time,
                    'userType' => 'Supplier',
                ];

                \Session::put(['user_new_email' => $email]);
                \Session::put(['email_information' => $data]);

                $user = new User();
                $user->email = $email;
                $user->user_type = 'supplier';
                $user->group_id = '4';
                $user->verify_token = $token_key;
                $user->save();

                Mail::to($data['email'])->send(new SendMail($data));
                //
                \Session::put(['user_new_email' => $email]);

                return redirect()->back()->with('info', 'Please verified your email address');
            }
        }



        //return redirect()->back()->with('info',
        // ('Please verified your email address');
    }

    public function resendEmail(Request $request)
    {
        $data = Session::get('email_information');


        Mail::to($data['email'])->send(new SendMail($data));
        return redirect()
            ->back()
            ->with(
                'info',
                'Please verified your email address'
            );
    }

    // public function brand_product(Request
    // $request) {
    // $data=About::find($id);
    // return view('admin.about.view',
    // compact('data'));
    // }

    public function brand_product($id)
    {
        $products = Brand::find($id);
        if (!is_null($products)) {
            return view('front_end.pages.cat', compact('products'));
        } else {
            return redirect('front_end.pages.product');
        }
    }

    public function sendOtpForContact(Request $request)
    {
        $this->validate($request, [
            'phone'  =>  'required|numeric',
            'country_name'  =>  'required',
        ]);

        $otp_number = mt_rand(100000, 999999);
        $phone_number = '+' . $request->country_name . $request->phone;

        DB::table('contact_msg_vrify')->insert(
            [
                'phone' => $request->country_name . $request->phone,
                'phone_otp' => $otp_number,
            ]
        );

        $url = "https://api.twilio.com/2010-04-01/Accounts/ACc1275cac4f939a2f6d9749bdea1726d4/Messages.json";
        $from = '+18044093532';
        $to = $phone_number;
        $body = 'Your Freeworld Verification Code is ' . $otp_number . '.';
        $id = "ACc1275cac4f939a2f6d9749bdea1726d4";
        $token = 'e2c002c9c60f6e8bd99ecd38c271a7f6';
        $data = array(
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url);
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        curl_close($x);

        return redirect()->route('');
    }
}
