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

//language
Route::get('lang/{locale}', function($locale){
	if(! in_array($locale, ['en','vi','cn'])){
		abort(404);
	}
	session()->put('locale', $locale);
	return redirect()->back();
});

Route::get('create-transaction', 'PayPalController@createTransaction')->name('createTransaction');
Route::get('process-transaction', 'PayPalController@processTransaction')->name('processTransaction');
Route::get('success-transaction', 'PayPalController@successTransaction')->name('successTransaction');
Route::get('cancel-transaction', 'PayPalController@cancelTransaction')->name('cancelTransaction');

//Frontend
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::post('/tim-kiem','HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocomplete_ajax');

//trang lien he
Route::get('/lien-he','ContactController@lien_he');
Route::get('/info','ContactController@info');
Route::get('/list-nut','ContactController@list_nut');
Route::get('/delete-icons','ContactController@delete_icons');

Route::post('/add-nut','ContactController@add_nut');
Route::post('/save-info','ContactController@save_info');
Route::post('/update-info/{info_id}','ContactController@update_info');

//Danh muc san pham index
Route::get('/danh-muc-san-pham/{slug_category_product}', 'CategoryProduct@show_category_shop');
Route::get('/chi-tiet-san-pham/{product_slug}', 'ProductController@details_product');
Route::post('/quickview', 'ProductController@quickview');
Route::post('/load-comment', 'ProductController@load_comment');
Route::post('/send-comment', 'ProductController@send_comment');
Route::get('/comment', 'ProductController@list_comment');
Route::post('/allow-comment', 'ProductController@allow_comment');
Route::post('/reply-comment', 'ProductController@reply_comment');
Route::post('/insert-rating', 'ProductController@insert_rating');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/filter-by-date', 'AdminController@filter_by_date');
Route::post('/days-order', 'AdminController@days_order');
Route::post('/dashboard-filter', 'AdminController@dashboard_filter');

//Category Product
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

Route::post('/arrange-category','CategoryProduct@arrange_category');

//login customer by google
Route::get('/login-customer-google','AdminController@login_customer_google');
Route::get('/customer/google/callback','AdminController@callback_customer_google');

//Product
Route::get('/add-product','ProductController@add_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');

// Route::get('/users','UserController@index');
// Route::get('/add-users','UserController@add_users');
// Route::post('/store-users','UserController@store_users');
// Route::post('/assign-roles','UserController@assign_roles');


Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//Cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/gio-hang','CartController@gio_hang');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/update-cart','CartController@update_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::get('/del-product/{session_id}','CartController@delete_product');
Route::get('/del-all-product','CartController@delete_all_product');
Route::get('/show-cart','CartController@show_cart_menu');

//Checkout
Route::get('/dang-nhap','CheckoutController@login_checkout');

Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/add-customer','CheckoutController@add_customer');
Route::get('/checkout','CheckoutController@checkout')->name('checkout');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');
Route::post('/confirm-order','CheckoutController@confirm_order');

//Order
Route::get('/view-history-order/{order_code}','OrderController@view_history_order');
Route::get('/history','OrderController@history');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/delete-order/{order_code}', 'OrderController@delete_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');
Route::post('/huy-don-hang','OrderController@huy_don_hang');

//Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/insert-coupon', 'CouponController@insert_coupon');
Route::post('/insert-coupon-code', 'CouponController@insert_coupon_code');
Route::get('/list-coupon', 'CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');
Route::get('/unset-coupon', 'CouponController@unset_coupon');

//Delivery
// Route::get('/delivery','DeliveryController@delivery');
// Route::post('/select-delivery','DeliveryController@select_delivery');
// Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slider_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slider_id}','SliderController@active_slide');
Route::get('/delete-slide/{slider_id}','SliderController@delete_slide');

//Authentication
Route::get('/register-auth','AuthController@register_auth');
Route::get('/login-auth','AuthController@login_auth');
Route::get('/logout-auth','AuthController@logout_auth');
Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');

//Gallery
Route::get('/add-gallery/{product_id}','GalleryController@add_gallery');
Route::post('/select-gallery','GalleryController@select_gallery');
Route::post('/insert-gallery/{pro_id}','GalleryController@insert_gallery');
Route::post('/update-gallery-name','GalleryController@update_gallery_name');
Route::post('/delete-gallery','GalleryController@delete_gallery');
Route::post('/update-gallery','GalleryController@update_gallery');

//send mail
Route::get('/send-mail','MailController@send_mail');
Route::get('/send-coupon-vip/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','MailController@send_coupon_vip');
Route::get('/send-coupon/{coupon_time}/{coupon_condition}/{coupon_number}/{coupon_code}','MailController@send_coupon');
Route::get('/mail-example','MailController@mail_example');
Route::get('/quen-mat-khau','MailController@quen_mat_khau');
Route::get('/update-new-pass','MailController@update_new_pass');
Route::post('/recover-pass','MailController@recover_pass');
Route::post('/reset-new-pass','MailController@reset_new_pass');