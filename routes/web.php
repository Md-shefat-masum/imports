<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// backend

// backend

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', 'UserController@login_home');
Auth::routes(['verify' => true]);
Route::match(['get', 'post'], 'admin-login', 'AdminController@login');
Route::get('login-register', 'UserController@register');
Route::post('/login-register-user', 'UserController@register_user')->name('user_register');

//Email ans otp verification START
Route::get('/user-email-check', 'VerificationController@user_email_check')->name('user_email_check');
Route::post('/otp-send-to-email', 'VerificationController@email_otp_send')->name('email_otp_send');
Route::post('/email-otp-submit', 'VerificationController@email_otp_submit')->name('email_otp_submit');
Route::get('/user-email-otp', 'VerificationController@user_email_otp')->name('user_email_otp');
Route::get('/user-email-otp-error', 'VerificationController@user_email_otp2')->name('user_email_otp2');

Route::get('/otp-send-to-phone', 'VerificationController@phone_otp_check')->name('phone_otp_check');
Route::post('/otp-send-to-phone', 'VerificationController@phone_otp_send')->name('phone_otp_send');
Route::post('/phone-otp-submit', 'VerificationController@phone_otp_submit')->name('phone_otp_submit');
Route::get('/user-phone-otp', 'VerificationController@user_phone_otp')->name('user_phone_otp');
Route::get('/user-phone-otp-error', 'VerificationController@user_phone_otp2')->name('user_phone_otp2');
//Email ans otp verification END


Route::match(['get', 'post'], 'user-login', 'UserController@login');
Route::post('suppliers-login', 'UserController@suppliersLogin')->name('suppliersLogin');
Route::post('enterpreuner-login', 'UserController@enterpreunerLogin')->name('enterpreunerLogin');

Route::post('/statesName', 'UserController@statesName')->name('statesName');

// Route::get('/supplier/register/','UserController@supplier');
// Route::post('/supplier/register/','UserController@supplierPost');
Route::get('/entrepreneur/register/', 'UserController@entrepreneurs')->name('entrepreneurs');
Route::post('/entrepreneur/register/', 'UserController@entrepreneursPost')->name('entrepreneursPost');

Route::get('/resend-email/{id}', 'UserController@userResendEmail')->name('userResendEmail');

Route::group(['middleware' => ['auth']], function () {

    // USER MANAGER START
    Route::resource('/user-list', 'admin\UserController');
    Route::get('/verified/user', 'UserManagerController@verified')->name('verified');
    Route::get('/unverified/user', 'UserManagerController@unverified')->name('unverified');

    Route::get('/user-manager', 'UserManagerController@index');
    Route::put('/user-action/{id}', 'UserManagerController@userAction')->name('user-action');
    Route::post('/supEnt-action', 'UserManagerController@supEntAction')->name('supEnt-action');
    Route::delete('/user-delete/{id}', 'UserManagerController@userDelete')->name('user-delete');
    // USER MANAGER END
    //    ADMIN ADD NEW USER
    Route::post('/admin-added-new-user', 'UserManagerController@adminAddedNewUser')->name('adminAddedNewUser');
    Route::get('/password-reset', 'UserManagerController@passwordReset')->name('passwordReset');
    Route::get('/password-reset/{id}', 'UserManagerController@passwordResetEdit')->name('passwordResetEdit');
    Route::put('/password-reset/{id}', 'UserManagerController@passwordResetUpdate')->name('passwordResetUpdate');

    // PARTNER START
    Route::get('/user-suppliers', 'UserManagerController@userSuppliers')->name('userSuppliers');
    Route::get('/user-entrepreneurs', 'UserManagerController@userEntrepreneurs')->name('userEntrepreneurs');
    Route::get('/suppliers-list', 'UserManagerController@suppliersList')->name('suppliersList');
    Route::get('/enterprenor-list', 'UserManagerController@enterprenorList')->name('enterprenorList');
    Route::get('/enterprenor-sales', 'UserManagerController@enterprenorSales')->name('enterprenorSales');
    // PARTNER MANAGER END

    Route::get('/manage-sales', 'AdminController@ManageSales');

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::prefix('pages')->group(function () {
        // Menus
        Route::resource('/menus', 'MenuController');
        Route::get('/contactMessage', 'ContactMessageShow@index');
        Route::get('/contactMessage/{id}', 'ContactMessageShow@messageDelete')->name('messageDelete');
        Route::post('/delete-multiple-contact-message', 'ContactMessageShow@multipleMessageDelete')->name('multipleMessageDelete');


        Route::get('/spam-registrations', 'SpamRegistrationsController@index');
        Route::get('/spam-registrations-delete/{id}', 'SpamRegistrationsController@delete_spam')->name('delete_spam_registration');

        // ORDER START
        Route::get('/orders', 'OrderController@viewOrder');
        Route::get('/orders-mail', 'OrderController@viewOrder_mail');
        Route::get('/order/delete/{id}', 'OrderController@delete_order')->name('delete_order');
        // ORDER END

        //Order Logs START
        Route::put('/create-orders-logs/{id}', 'OrderLogsController@create_order_log')->name('create_order_log');
        Route::get('/orders-logs', 'OrderLogsController@view_order_log')->name('view_order_log');
        Route::get('/orders-logs-edit/{id}', 'OrderLogsController@edit_order_log')->name('edit_order_log');
        Route::get('/delete_order_log/{id}', 'OrderLogsController@delete_order_log')->name('delete_order_log');
        Route::put('/orders-logs-update/{id}', 'OrderLogsController@update_order_log')->name('update_order_log');
        //Order Logs END

        // Shipping START
        Route::get('/verification-status', 'OrderController@verificationStatus')->name('verification-status');
        Route::get('/shipping', 'OrderController@shipping')->name('shipping');
        Route::get('/shipping-delivered', 'OrderController@shippingDelivered')->name('shipping-delivered');
        // Shipping END

        Route::get('/vpos', 'OrderController@vpos');
        Route::post('/accept-order', 'OrderController@orderStatus');
        Route::post('/vpos', 'OrderController@orderStatus');
        //Route::get('/order-details','OrderController@orderDetails');
        Route::get('/order-details/{id}', [
            'uses' => 'OrderController@orderDetails',
            'as' => 'order-details',
        ]);

        Route::resource('/submenus', 'SubmenuController');
        //Servies
        Route::resource('/services', 'ServiceController');
        //Product Category
        Route::resource('/p_category', 'ProductCategoryController');

        //Blog Category
        Route::get('/b_category', 'BlogCategoryController@index')->name('b_cat_index');
        Route::post('/b_category', 'BlogCategoryController@category_store')->name('category_store');
        Route::delete('/b_category/{id}', 'BlogCategoryController@b_category_destroy')->name('b_category_destroy');
        Route::get('/b_category/edit/{id}', 'BlogCategoryController@b_category_edit')->name('b_category_edit');
        Route::put('/b_category/update/{id}', 'BlogCategoryController@b_category_update')->name('b_category_update');

        //Blog Sub Category
        Route::get('/b_sub_category', 'BlogCategoryController@b_sub_index')->name('b_sub_cat_index');
        Route::post('/b_sub_category', 'BlogCategoryController@b_sub_category_store')->name('b_sub_category_store');
        Route::delete('/b_sub_category/{id}', 'BlogCategoryController@b_sub_category_destroy')->name('b_sub_category_destroy');
        Route::get('/b_sub_category/edit/{id}', 'BlogCategoryController@b_sub_category_edit')->name('b_sub_category_edit');
        Route::put('/b_sub_category/update/{id}', 'BlogCategoryController@b_sub_category_update')->name('b_sub_category_update');

        //Product Unit
        Route::resource('/units', 'UnitController');
        //Product Category
        Route::resource('/product', 'ProductController');
        Route::get('/category/{id}', 'ProductCategoryController@category')->name('category');
        //Product Sub Category
        Route::resource('/subCategory', 'SubCategoryController');
        // Testimonials
        Route::resource('/tes', 'TestimonialController');
        // blog or news
        Route::resource('/blog', 'NewsController');
        Route::get('/request-blog', 'BlogController@requestBlog')->name('requestBlog');
        Route::get('/blog-list', 'BlogController@blogList')->name('blogList');
        Route::put('/blog-list/{id}', 'BlogController@approveBlog')->name('approveBlog');
        Route::delete('/blog-list/{id}', 'BlogController@removeBlog')->name('removeBlog');
        Route::get('/blog-list', 'BlogController@blogList')->name('blogList');
        Route::get('/blog-details/{id}', 'BlogController@blogDescription')->name('blogDescription');
        Route::resource('/sf', 'SupplierForumController');
        Route::resource('/oe', 'EnterpreniorForumController');


        Route::get('/related-blog', 'BlogController@relatedBlog')->name('related_blog');
        Route::post('/related-blog-add', 'BlogController@relatedBlogAdd')->name('related_blog_add');
        Route::get('/delete-releted-blog/{id}', 'BlogController@delete_releted_blog')->name('delete_releted_blog');
        Route::get('/update-releted-blog/{id}', 'BlogController@update_releted_blog')->name('update_releted_blog');
        Route::post('/edit-releted-blog', 'BlogController@edit_releted_blog')->name('edit_releted_blog');

        //Deal Registration
        Route::get('/deal-manager', 'DealRegistrationController@deal_manager')->name('deal_manager');
        Route::get('/deal-registration', 'DealRegistrationController@index')->name('deal_registration');
        Route::post('/deal-registration', 'DealRegistrationController@store')->name('deal_registration_store');
        Route::get('/edit-deal-registration/{id}', 'DealRegistrationController@edit')->name('deal_registration_edit');
        Route::put('/update-deal-registration/{id}', 'DealRegistrationController@update')->name('deal_registration_update');
        Route::delete('/delete-deal-registration/{id}', 'DealRegistrationController@destroy')->name('deal_registration_destroy');

        //setting
        Route::resource('/setting', 'SettingController');
        //Slider
        Route::resource('/sliders', 'SliderController');
        //Slider Product

        //Route::resource('/slider_product','SliderProductController');
        Route::get('/slider_product', 'SliderProductController@index')->name('sliderProduct');
        Route::get('/addSlider', 'SliderProductController@addSlider')->name('addSlider');
        Route::post('/proSlider', 'SliderProductController@proSearchForSlider')->name('proSlider');
        Route::post('/addToSlider', 'SliderProductController@addToSlider')->name('addToSlider');
        Route::put('/editSlider', 'SliderProductController@editSlider')->name('editSlider');
        Route::delete('/sliderDelete/{id}', 'SliderProductController@sliderDelete')->name('sliderDelete');

        Route::get('/homecat_product', 'HomeProductCategoryController@index')->name('homecatProduct');
        Route::get('/addHomecat', 'HomeProductCategoryController@addHomecat')->name('addHomecat');
        Route::post('/proHomecat', 'HomeProductCategoryController@proSearchForHomecat')->name('proHomecat');
        Route::post('/addToHomecat', 'HomeProductCategoryController@addToHomecat')->name('addToHomecat');
        Route::put('/editHomecat', 'HomeProductCategoryController@editHomecat')->name('editHomecat');
        Route::delete('/homecatDelete/{id}', 'HomeProductCategoryController@homecatDelete')->name('homecatDelete');

        Route::get('/hot_sale_product', 'HotSaleProductController@index')->name('hot_sale_product');
        Route::get('/addHotSale', 'HotSaleProductController@addHotSale')->name('addHotSale');
        Route::post('/proHotSale', 'HotSaleProductController@proSearchForHotSale')->name('proHotSale');
        Route::post('/addToHotSale', 'HotSaleProductController@addToHotSale')->name('addToHotSale');
        Route::put('/editHotSale', 'HotSaleProductController@editHotSale')->name('editHotSale');
        Route::delete('/hot_sale_Delete/{id}', 'HotSaleProductController@hot_sale_Delete')->name('hot_sale_Delete');

        //CREATE PRODUCT LINK START
        Route::get('/product_link', 'LinkProductController@index')->name('linkProduct');
        Route::get('/addLink', 'LinkProductController@addLink')->name('addLink');
        Route::post('/proLink', 'LinkProductController@proSearchForLink')->name('proLink');
        Route::post('/searchProduct', 'LinkProductController@searchProduct')->name('searchProduct');
        Route::post('/addToLink', 'LinkProductController@addToLink')->name('addToLink');
        //Route::put('/editSlider', 'SliderProductController@editSlider')->name('editSlider');
        Route::delete('/linkDelete/{id}', 'LinkProductController@linkDelete')->name('linkDelete');
        //CREATE PRODUCT LINK END

        //    APPROVED PRODCUT FOR SUPPLIER AND Enterprenor
        Route::post('/single-supplier-product', 'SliderProductController@single_supplier_pro')->name('single_supplier_pro');

        Route::get('/supplier-products-request', 'SliderProductController@supplier_pro_request')->name('supplier_pro_request');
        Route::get('/supplier-approve-products', 'SliderProductController@supplier_pro_approve')->name('supplier_pro_approve');

        Route::get('/supplier-product-approved', 'SliderProductController@supplierApprove')->name('supplierApprove');
        Route::put('/supplier-product-approved/{id}', 'SliderProductController@supplierApproveUpdate')->name('supplierApproveUpdate');

        Route::get('/enterprenor-product-approved', 'SliderProductController@enterprenorApprove')->name('enterprenorApprove');
        Route::put('/enterprenor-product-approved/{id}', 'SliderProductController@enterprenorApproveUpdate')->name('enterprenorApproveUpdate');

        //COMMENT SECTION
        Route::get('/comment-section', 'SliderProductController@commentSection')->name('commentSection');
        Route::get('/comment-section/{id}/edit', 'SliderProductController@commentSectionEdit')->name('commentSectionEdit');
        Route::put('/comment-section/{id}', 'SliderProductController@commentSectionUpdate')->name('commentSectionUpdate');
        Route::delete('/comment-section/{id}', 'SliderProductController@commentSectionDelete')->name('commentSectionDelete');
        Route::put('/comment-section/{id}/aprove', 'SliderProductController@commentSectionApproved')->name('commentSectionApproved');

        //home product
        Route::get('/current_auction', 'SliderProductController@auctionProduct')->name('auctionProduct');
        Route::get('/add_current_auction', 'SliderProductController@addAuction')->name('addAuction');
        Route::post('/pro_auction', 'SliderProductController@proSearchForAuctin')->name('proAuction');
        Route::post('/addToAuction', 'SliderProductController@addToAuction')->name('addToAuction');
        Route::delete('/auctionDelete/{id}', 'SliderProductController@auctionDelete')->name('auctionDelete');

        Route::get('/home_product', 'SliderProductController@homeProduct')->name('homeProduct');
        Route::get('/addHome', 'SliderProductController@addHome')->name('addHome');
        Route::post('/pro_home', 'SliderProductController@proSearchForHome')->name('proHome');
        Route::post('/addToHome', 'SliderProductController@addToHome')->name('addToHome');
        Route::delete('/homeDelete/{id}', 'SliderProductController@homeDelete')->name('homeDelete');

        //Contact
        Route::resource('/supplier-forum', 'SubComForumController');
        Route::resource('/enterprenor-forum', 'EnterComForumController');

        Route::get('/bid-reset-time', 'BlogController@bid_reset')->name('bid_reset');
        Route::post('/bid-reset-time-submit', 'BlogController@bid_reset_submit')->name('bid_reset_submit');

        Route::get('/subscribes-list', 'BlogController@getSubscribe')->name('getSubscribe');
        Route::post('/subscribes-list-delete', 'BlogController@subscribe_delete')->name('subscribe_delete');

        Route::resource('/contact', 'ContactController');
        Route::resource('/aboutOne', 'About1Controller');
        Route::resource('/aboutTwo', 'About2Controller');
        Route::resource('/aboutThree', 'About3Controller');
        Route::resource('/faqs', 'FaqController');
        Route::resource('/policy', 'PrivencyPoliciController');
        Route::resource('/terms', 'TermConditionController');
        Route::resource('/megamenus', 'ManageMenusController');


        //Footer section ** facebook-feed
        Route::get('/facebook-feed', 'FooterController@facebookFeed')->name('facebookFeed');
        Route::post('/facebook-feed', 'FooterController@addFacebookFeed')->name('addFacebookFeed');
        Route::get('/facebook-feed/{id}/edit', 'FooterController@editFacebookFeed')->name('editFacebookFeed');
        Route::put('/facebook/{id}', 'FooterController@facebook')->name('facebook');
        Route::delete('/facebook-feed/{id}', 'FooterController@deleteFacebookFeed')->name('deleteFacebookFeed');
        //Footer section ** quick contact
        Route::get('/quick-contact', 'FooterController@quickContact')->name('quickContact');
        Route::get('/quick-contact/{id}/edit', 'FooterController@editQuickContact')->name('editQuickContact');
        Route::put('/facebook-feed/{id}', 'FooterController@updateQuickContact')->name('updateQuickContact');
        //Footer section ** partners
        Route::resource('/partners', 'PartnerController');
        //Footer section ** News Feed
        Route::resource('/news-feed', 'NewsFeedController');
    });
});

Route::get('/logout', 'AdminController@logout');
// Route::prefix('admin')->group(function(){
//     Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
//     Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
//     Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
// });

////////////////////// Front End Controller  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
// Route::get('/', function () {
//     return view('front_end.pages.home');
// });
Route::group(['middleware' => ['frontlogin']], function () {
    Route::get('/bid/{id}', 'FrontendController@bid');

    Route::any('add-cart', 'ProductController@addCart');
    Route::match(['get', 'post'], 'cart', 'ProductController@cart');
    Route::match(['get', 'post'], 'checkout', 'ProductController@checkout');
    Route::match(['get', 'post'], 'shopping-cart-bid', 'ProductController@shoppingCartBid');
    Route::match(['get', 'post'], 'shopping-cart-bid-n', 'ProductController@shoppingCartBidnoti');

    Route::get('/place-order-vpos', 'OrderController@place_order_vpos')->name('place_order_vpos');
    Route::get('/place-order', 'OrderController@placeOrder');
    Route::post('/place-order', 'OrderController@saveOrder');

    Route::get('/cart/delete-product/{id}', 'ProductController@delete_cart_product');
    Route::get('/cart/update-quentity/{id}', 'ProductController@update_cart_quentity');
    Route::get('/my-profile', [
        'uses' => 'FrontendController@profile',
        'as' => 'my-profile',
    ]);
    Route::get('/my-order', [
        'uses' => 'FrontendController@myOrder',
        'as' => 'my-order',
    ]);
    Route::get('/update-profile', [
        'uses' => 'UserController@editProfile',
        'as' => 'update-profile',
    ]);
    Route::post('/update-profile', [
        'uses' => 'UserController@updateProfile',
        'as' => 'update-profile',
    ]);
});

Route::get('/blog-details/{id}', 'FrontendController@blogDetails');

Route::post('/blog-comment', 'BlogCommentController@commentStore')->name('commentStore');

Route::get('/', 'FrontendController@index')->name('frontMain');
Route::get('/frontMain', 'FrontendController@index_two')->name('frontMain_two');
Route::get('/current-auction', 'FrontendController@curentAuction');
Route::post('/', 'FrontendController@subscriber')->name('subscriber');
Route::get('/about', 'FrontendController@about');
Route::get('/suppliers', 'FrontendController@supplier')->name('supplierReg');

Route::get('/sms', 'SmsController@check');
Route::post('/sms_test', 'SmsController@sms_test')->name('sms_test');

Route::get('/email-verify', 'FrontendController@emailVerify')->name('emailVerify');

Route::get('/suppliers-login', 'FrontendController@supplierLogin')->name('supplierLogin');
Route::get('/suppliers-register', 'FrontendController@suppliers_register')->name('suppliers_register');
Route::get('/user-verification', 'FrontendController@user_verification')->name('user_verification');
Route::post('/supplier', 'FrontendController@supplierRegister')->name('supplierRegister');

// START SUPPLIER MAIL START
Route::post('/suppliers', 'FrontendController@sendEmail')->name('sendEmail');
Route::get('/suppliers-resend-email', 'FrontendController@resendEmail')->name('resendEmail');
// START SUPPLIER MAIL END

Route::get('/non-auction-deals', 'FrontendController@daily_flat_sale')->name('daily_flat_sale');

// Route::get('/blog-add-to-popup/{id}', 'FrontendController@blog_add_to_popup')->name('blog_add_to_popup')->middleware('auth');
Route::get('/blog-add-to-latest-flash-sale/{id}', 'FrontendController@blog_add_to_latest_flash_sale')->name('blog_add_to_latest_flash_sale')->middleware('auth');
Route::get('/blog-remove-from-latest-flash-sale/{id}', 'FrontendController@blog_remove_from_latest_flash_sale')->name('blog_remove_from_latest_flash_sale')->middleware('auth');

Route::get('/online-ent', 'FrontendController@ent')->name('enterprenorLogin');
Route::get('/forum/supplier', 'FrontendController@ForumSupplier');
// Route::get('/forum/supplier/cat/{id}', 'FrontendController@forum_supplier');
// Route::get('/forum/entrepreneur/cat/{id}', 'FrontendController@forum_entrepreneur');
Route::post('/forum/supplier/cat/allcategory', 'FrontendController@get_allcat_forum');
Route::post('/forum/supplier/cat/subcategory', 'FrontendController@get_subcat_forum');
Route::post('/forum/supplier/cat/oe/subcategory', 'FrontendController@get_oe_subcat_forum');
Route::get('/forum/supplier/{cat}', 'FrontendController@forum_supplier_cat')->name('forum_supplier_cat');
Route::get('/forum/entrepreneur', 'FrontendController@ForumEntrepreneur');
Route::get('/forum/entrepreneur/{cat}', 'FrontendController@forum_entrepreneur_cat')->name('forum_entrepreneur_cat');

Route::get('/product', 'FrontendController@product')->name('productAll');
Route::get('/product_home_cat', 'FrontendController@product_home_cat')->name('product_home_cat');
Route::get('/search-product', 'FrontendController@serachProduct')->name('serach_this_roduct');
Route::get('/product-search', 'FrontendController@product')->name('serachProduct');
Route::get('/faq', 'FrontendController@faq');
Route::get('/policy', 'FrontendController@policy');
Route::get('/terms', 'FrontendController@terms')->name('frontTerms');
Route::get('/payment', 'FrontendController@payment');
Route::get('/contact', 'FrontendController@contact');

Route::post('/send-otp-for-contact-message', 'FrontendController@sendOtpForContact')->name('sendOtpForContact');
Route::get('/contact-message-otp-verify-now', 'FrontendController@contact_verify_now')->name('contact_verify_now');

Route::get('/porduct_details/{id}', 'FrontendController@porduct_details');
Route::get('/cat/{id}', 'FrontendController@category');
Route::get('/sub-cat/{id}', 'FrontendController@subCategory');
Route::post('frontEndContact', 'FrontendController@ContactPost');

Route::post('/product-price-range', 'ProductPriceController@product_price_range');
Route::post('/product-low-high', 'ProductPriceController@product_low_high');
Route::post('/product-subcat', 'ProductPriceController@product_subcat');
Route::post('/product-home-subcat', 'ProductPriceController@product_home_subcat');
Route::post('/product-brand', 'ProductPriceController@product_brand');
Route::post('/home-product-subcat', 'ProductPriceController@home_product_subcat');

Route::get('/wishlist-page', 'ProductPriceController@wishlist_page')->name('wishlist_page');

Route::post('/addWishList', 'ProductPriceController@addWishList')->name('addWishList');
Route::post('/addWishList-flash', 'ProductPriceController@addWishList_flash')->name('addWishList_flash');
Route::post('/wishlist_delete', 'ProductPriceController@wishlist_delete')->name('wishlist_delete');
Route::get('wishpage', 'ProductPriceController@wishpage');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/brand', 'BrandController@index')->name('brand');
    Route::get('/brand-add', 'BrandController@add')->name('brand_add');
    Route::post('/brand-store', 'BrandController@store')->name('brand_store');
    Route::get('/brand-edit/{id}', 'BrandController@edit')->name('brand_edit');
    Route::post('/brand-update', 'BrandController@update')->name('brand_update');
    Route::post('/brand-delete', 'BrandController@delete')->name('brand_delete');
    Route::delete('/brand-delete/{id}', 'BrandController@destroy')->name('brand_destroy');
    //  Route::delete('/b_category/{id}', 'BlogCategoryController@b_category_destroy')->name('b_category_destroy');
});
Route::get('/brand-product/{id}', 'FrontendController@brand_product')->name('brand_product');

// CategoryOffer
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/category-offer', 'CategoryOfferController@index')->name('category_offer');
    Route::get('/category-offer-add', 'CategoryOfferController@add')->name('category_offer_add');
    Route::post('/category-offer-store', 'CategoryOfferController@store')->name('category_offer_store');
    Route::get('/category-offer-view/{id}', 'CategoryOfferController@view')->name('category_offer_view');
    Route::get('/category-offer-edit/{id}', 'CategoryOfferController@edit')->name('category_offer_edit');
    Route::post('/category-offer-update', 'CategoryOfferController@update')->name('category_offer_update');
    Route::post('/category-offer-delete', 'CategoryOfferController@delete')->name('category_offer_delete');
    Route::delete('/category-offer-delete/{id}', 'CategoryOfferController@destroy')->name('category_offer_destroy');
});
// Gadgets Banner
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/gadgets-banner', 'GadgetsBannerController@index')->name('gadgets_banner');
    Route::get('/gadgets-banner-add', 'GadgetsBannerController@add')->name('gadgets_banner_add');
    Route::post('/gadgets-banner-store', 'GadgetsBannerController@store')->name('gadgets_banner_store');
    Route::get('/gadgets-banner-view/{id}', 'GadgetsBannerController@view')->name('gadgets_banner_view');
    Route::get('/gadgets-banner-edit/{id}', 'GadgetsBannerController@edit')->name('gadgets_banner_edit');
    Route::post('/gadgets-banner-update', 'GadgetsBannerController@update')->name('gadgets_banner_update');
    Route::post('/gadgets-banner-delete', 'GadgetsBannerController@delete')->name('gadgets_banner_delete');
    Route::delete('/gadgets-banner-delete/{id}', 'GadgetsBannerController@destroy')->name('gadgets_banner_destroy');
});
// discount
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/discount', 'DiscountController@index')->name('discount');
    Route::get('/discount-add', 'DiscountController@add')->name('discount_add');
    Route::post('/discount-store', 'DiscountController@store')->name('discount_store');
    Route::get('/discount-view/{id}', 'DiscountController@view')->name('discount_view');
    Route::get('/discount-edit/{id}', 'DiscountController@edit')->name('discount_edit');
    Route::post('/discount-update', 'DiscountController@update')->name('discount_update');
    Route::post('/discount-delete', 'DiscountController@delete')->name('discount_delete');
    Route::delete('/discount-delete-delete/{id}', 'DiscountController@destroy')->name('discount_destroy');
});

Route::get('/discount_product', 'DiscountProductController@index')->name('discountProduct');
Route::get('/adddiscount', 'DiscountProductController@adddiscount')->name('adddiscount');
Route::post('/prodiscount', 'DiscountProductController@proSearchFordiscount')->name('prodiscount');
Route::post('/addTodiscount', 'DiscountProductController@addTodiscount')->name('addTodiscount');
Route::put('/editdiscount', 'DiscountProductController@editdiscount')->name('editdiscount');
Route::put('/add-discount-rate', 'DiscountProductController@add_discount_rate')->name('add_discount_rate');
Route::delete('/discountDelete/{id}', 'DiscountProductController@discountDelete')->name('discountDelete');

Route::get('/big-sale-discount', 'DiscountPageController@bigsale_discount_page')->name('bigsale_discount_page');
Route::get('/discount-product/{discount}', 'DiscountPageController@discount_product_page')->name('discount_product_page');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/big-sales', 'BigSaleController@index')->name('big_sales');
    Route::get('/big-sales-add', 'BigSaleController@add')->name('big_sales_add');
    Route::post('/big-sales-store', 'BigSaleController@store')->name('big_sales_store');
    Route::get('/big-sales-edit/{id}', 'BigSaleController@edit')->name('big_sales_edit');
    Route::post('/big-sales-update', 'BigSaleController@update')->name('big_sales_update');
    Route::post('/big-sales-delete', 'BigSaleController@delete')->name('big_sales_delete');
    Route::delete('/big-sales-delete/{id}', 'BigSaleController@destroy')->name('big_sales_destroy');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/hotsale-date', 'HotSaleDateController@index')->name('hotsale_date');
    Route::get('/hotsale-date-add', 'HotSaleDateController@add')->name('hotsale_date_add');
    Route::post('/hotsale-date-store', 'HotSaleDateController@store')->name('hotsale_date_store');
    Route::get('/hotsale-date-edit/{id}', 'HotSaleDateController@edit')->name('hotsale_date_edit');
    Route::post('/hotsale-date-update', 'HotSaleDateController@update')->name('hotsale_date_update');
    Route::post('/hotsale-date-delete', 'HotSaleDateController@delete')->name('hotsale_date_delete');
    Route::delete('/hotsale-date-delete/{id}', 'HotSaleDateController@destroy')->name('hotsale_date_destroy');
});

Route::get('/hotsale-offer-products', 'HotsaleOfferProductController@index')->name('hotsaleProduct');
Route::get('/addhotsale', 'HotsaleOfferProductController@addhotsale')->name('addhotsale');

Route::post('/addTohotsale', 'HotsaleOfferProductController@addTohotsale')->name('addTohotsale');
Route::put('/edithotsale', 'HotsaleOfferProductController@edithotsale')->name('edithotsale');
Route::put('/add-hotsale-rate', 'HotsaleOfferProductController@add_hotsale_rate')->name('add_hotsale_rate');
Route::delete('/hotsaleDelete/{id}', 'HotsaleOfferProductController@hotsaleDelete')->name('hotsaleDelete');

// Route::put('/blog-add-to-popup/{id}', 'FrontendController@blog_add_to_popup')->name('blog_add_to_popup')->middleware('auth');

Route::get('/blog-add-to-popup', 'BlogPopupController@index')->name('blogpopupProduct');
Route::get('/addblogpopup', 'BlogPopupController@addblogpopup')->name('addblogpopup');
Route::post('/problogpopup', 'BlogPopupController@proSearchForblogpopup')->name('problogpopup');
Route::post('/addToblogpopup', 'BlogPopupController@addToblogpopup')->name('addToblogpopup');
Route::put('/editblogpopup', 'BlogPopupController@editblogpopup')->name('editblogpopup');
Route::put('/add-blogpopup-rate', 'BlogPopupController@add_blogpopup_rate')->name('add_blogpopup_rate');
Route::delete('/blogpopupDelete/{id}', 'BlogPopupController@blogpopupDelete')->name('blogpopupDelete');

Route::get('/gadgetscat_product', 'GadgetsProductCategoryController@index')->name('gadgetscatProduct');
Route::get('/addGadgetscat', 'GadgetsProductCategoryController@addGadgetscat')->name('addGadgetscat');
Route::post('/proGadgetscat', 'GadgetsProductCategoryController@proSearchForGadgetscat')->name('proGadgetscat');
Route::post('/addToGadgetscat', 'GadgetsProductCategoryController@addToGadgetscat')->name('addToGadgetscat');
Route::put('/editGadgetscat', 'GadgetsProductCategoryController@editGadgetscat')->name('editGadgetscat');
Route::delete('/GadgetscatDelete/{id}', 'GadgetsProductCategoryController@GadgetscatDelete')->name('GadgetscatDelete');

Route::get('/reset-bid-price', 'ResetController@index')->name('reset_bid_price');
Route::post('/reset-now', 'ResetController@reset_now')->name('reset_now');
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

// json routes
Route::get('/hot-sales-json/{paginate_number}','FrontendController@hot_sales_json')->name('hot_sales_json');
Route::get('/category-product-json/{paginate_number}','FrontendController@category_product_json')->name('category_product_json');
