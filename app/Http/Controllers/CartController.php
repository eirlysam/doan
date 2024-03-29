<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
// use Cart;
use App\Coupon;
use Carbon\Carbon;
session_start();

class CartController extends Controller
{
    public function show_cart_menu(){
        $cart = Session::get('cart');
        $output = '';
        if(!empty($cart)){
            $cartCount = count($cart);
            $output.= '
                <li><a href="'.url('/gio-hang').'"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                    <span class="badges">'.$cartCount.'</span>
                </a></li>
            ';
        }else{
            $output.= '
                <li><a href="'.url('/gio-hang').'"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                    <span class="badges">0</span>
                </a></li>
            ';
        }
        echo $output;
    }

    public function check_coupon(Request $request){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $data = $request->all();
        if(Session::get('customer_id')){
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->where('coupon_used','LIKE','%'.Session::get('customer_id').'%')->first();
            if($coupon){
                return redirect()->back()->with('error','Mã giảm giá đã được sử dụng, vui lòng nhập mã khác');
            }else{
                $coupon_login = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if($count_coupon>0){
                        $coupon_session = Session::get('coupon');
                        if($coupon_session==true){
                            $is_avaiable = 0;
                            if($is_avaiable==0){
                                $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,

                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[] = array(
                                    'coupon_code' => $coupon_login->coupon_code,
                                    'coupon_condition' => $coupon_login->coupon_condition,
                                    'coupon_number' => $coupon_login->coupon_number,

                                );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                    }

                }else{
                    return redirect()->back()->with('error','Mã giảm giá không đúng hoặc mã đã hết hạn');
                }
            }
            //neu chua dang nhap
        }else{
            $coupon = Coupon::where('coupon_code',$data['coupon'])->where('coupon_status',1)->where('coupon_date_end','>=',$today)->first();
            if($coupon){
                $count_coupon = $coupon->count();
                if($count_coupon>0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session==true){
                        $is_avaiable = 0;
                        if($is_avaiable==0){
                            $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,

                            );
                            Session::put('coupon',$cou);
                        }
                    }else{
                        $cou[] = array(
                                'coupon_code' => $coupon->coupon_code,
                                'coupon_condition' => $coupon->coupon_condition,
                                'coupon_number' => $coupon->coupon_number,

                            );
                        Session::put('coupon',$cou);
                    }
                    Session::save();
                    return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                }

            }else{
                return redirect()->back()->with('error','Mã giảm giá không đúng hoặc mã đã hết hạn');
            }
        }
        
    }   
    
    public function gio_hang(Request $request){
        //seo
        $meta_desc = "Giỏ hàng của bạn"; 
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $url_canonical = $request->url();
        //endseo
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_available = false;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_available = true;
                    $cart[$key]['product_qty'] += intval($data['cart_product_qty']);
                    break;
                    // $is_avaiable++;
                }
            }
            if(!$is_available){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => intval($data['cart_product_qty']),
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => intval($data['cart_product_qty']),
                'product_price' => $data['cart_product_price'],

            );
            
        }
        Session::put('cart',$cart);
        Session::save();
    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }
    // public function update_cart(Request $request){
    //     $data = $request->all();
    //     $cart = Session::get('cart');
    //     if($cart==true){
    //         $message = '';
    //         foreach($data['cart_qty'] as $key => $qty){
    //             foreach($cart as $session => $val){
    //                 if($val['session_id']==$key && $qty<$cart[$session]['product_quantity']){
    //                     $cart[$session]['product_qty'] = $qty;
    //                     $message.='<p style="color:blue">Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công</p>';
    //                 }elseif($val['session_id']==$key && $qty>=$cart[$session]['product_quantity']){
    //                     $message.='<p style="color:red">Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại</p>';
    //                 }
    //             }
    //         }
    //         Session::put('cart',$cart);
    //         return redirect()->back()->with('message',$message);
    //     }else{
    //         return redirect()->back()->with('message','Cập nhật số lượng thất bại');
    //     }
    // }

    public function update_cart(Request $request){
        $session_id = $request->input('session_id');
        $qty = $request->input('qty');

        // Lấy giỏ hàng từ session
        $cart = Session::get('cart');

        // Kiểm tra xem giỏ hàng có tồn tại hay không
        if ($cart) {
            // Lặp qua từng sản phẩm trong giỏ hàng
            foreach ($cart as $session => $val) {
                // Kiểm tra session_id của sản phẩm khớp với session_id nhận được từ yêu cầu
                if ($val['session_id'] == $session_id) {
                    
                    // Thực hiện cập nhật số lượng sản phẩm
                    $cart[$session]['product_qty'] = $qty;
                    break;
                }
            }
            // Cập nhật giỏ hàng trong session
            Session::put('cart', $cart);

            $message = 'Cập nhật số lượng thành công';
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } else {
            // Giỏ hàng không tồn tại
            $message = 'Giỏ hàng không tồn tại';

            return response()->json([
                'success' => false,
                'message' => $message
            ]);
        }
    }
    
    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }
    
    public function save_cart(Request $request){

    	$productId = $request->productid_hidden;
    	$quantity = $request->qty;

    	$product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

    	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);
    	// Cart::destroy();

    	$data['id'] = $product_info->product_id;
    	$data['qty'] = $quantity;
    	$data['name'] = $product_info->product_name;
    	$data['price'] = $product_info->product_price;
    	$data['weight'] = $product_info->product_price;
    	$data['options']['image'] = $product_info->product_image;
    	// Cart::add($data);
    	// Cart::setGlobalTax(10);
    	// //Cart::destroy();
    	return Redirect::to('/show-cart');

    	
    }

    // public function show_cart(Request $request){
    //     //seo
    //     $meta_desc = "Giỏ hàng của bạn"; 
    //     $meta_keywords = "Giỏ hàng";
    //     $meta_title = "Giỏ hàng";
    //     $url_canonical = $request->url();
    //     //endseo
    // 	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();

    // 	return view('pages.cart.show_cart')->with('category',$cate_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    // }

    public function delete_to_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request){
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    }
}
