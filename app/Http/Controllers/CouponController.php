<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
// use Cart;
use Carbon\Carbon;

class CouponController extends Controller
{
	public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}

    public function insert_coupon(){
    	return view('admin.coupon.insert_coupon');
    }

    public function delete_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }

    public function list_coupon(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.coupon.list_coupon')->with(compact('coupon','today'));
    }

    public function insert_coupon_code(Request $request){
    	$data = $request->all();

        $couponName = $request->coupon_name;
    
        // Kiểm tra xem danh mục đã tồn tại hay chưa
        $existingCoupon = Coupon::where('coupon_name', $couponName)->first();
        
        if ($existingCoupon) {
            // Danh mục đã tồn tại, xử lý thông báo lỗi hoặc thực hiện các xử lý khác
            Session::put('message', 'Danh mục đã tồn tại!');
        } else {

        	$coupon = new Coupon;

        	$coupon->coupon_name = $data['coupon_name'];
            $coupon->coupon_date_start = $data['coupon_date_start'];
            $coupon->coupon_date_end = $data['coupon_date_end'];
        	$coupon->coupon_number = $data['coupon_number'];
        	$coupon->coupon_code = $data['coupon_code'];
        	$coupon->coupon_time = $data['coupon_time'];
        	$coupon->coupon_condition = $data['coupon_condition'];
        	$coupon->save();

            $today = Carbon::now()->toDateString();

        	Session::put('message','Thêm mã giảm giá thành công');
        }
        return Redirect::to('insert-coupon');
    }
}
