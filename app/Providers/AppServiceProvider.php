<?php

namespace App\Providers;
use App\Product;
use App\Order;
use App\Customer;
use App\Icons;
use App\Contact;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            //get information
            $contact_footer = Contact::where('info_id',1)->get();
            //get icons social
            $icons = Icons::orderBy('id_icons','DESC')->get();

            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');

            $min_price_range = $min_price + 1000;
            $max_price_range = $max_price + 100000;

            $app_product = Product::all()->count();
            $app_order = Order::all()->count();
            $app_customer = Customer::all()->count();

            $view->with('min_price',$min_price)->with('max_price',$max_price)->with('max_price_range',$max_price_range)->with('min_price_range',$min_price_range)->with('app_product',$app_product)->with('app_order',$app_order)->with('app_customer',$app_customer)->with('icons',$icons)->with('contact_footer',$contact_footer);
        });
    }
}
