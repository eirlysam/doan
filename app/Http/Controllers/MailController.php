<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Customer;
use App\Coupon;
use Carbon\Carbon;
use App\Slider;
use App\Peoduct;
use Session;
use DB;
use App\Http\Requests;

class MailController extends Controller
{
    // public function send_mail(){
    //   $to_name = "Ashion";
    //   $to_email = "anhtuyet231101@gmail.com";

    //   $data = array("name"=>"Mail tu tai khoan khach hang", "body"=>"Mail gui ve van de hang hoa");

    //   Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
    //     $message->to($to_email)->subject('Test thu gui mail google');
    //     $message->from($to_email,$to_name);
    //   });
    //   // return redirect('/')->with('message','');
    // }

    public function send_coupon($coupon_time,$coupon_condition,$coupon_number,$coupon_code){
        //get customer
        $customer = customer::where('customer_vip','=',NULL)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày".' '.$now;

        // Kiểm tra xem mã giảm giá đã hết hạn chưa
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $end_coupon = Carbon::createFromFormat('d-m-Y', $coupon->coupon_date_end)->format('Y-m-d');

        if ($today > $end_coupon) {
            return redirect()->back()->with('message', 'Mã giảm giá đã hết hạn!');
        }

        $data = [];
        foreach ($customer as $normal) {
            $data['email'][] = $normal->customer_email;
        }
        $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' => $end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition' => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code' => $coupon_code
        );
        
        Mail::send('pages.send_coupon',['coupon'=>$coupon],function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });

        return redirect()->back()->with('message','Gửi mã khuyến mãi khách thường thành công!');
    }

    public function send_coupon_vip($coupon_time,$coupon_condition,$coupon_number,$coupon_code){
    	//get customer
    	$customer_vip = customer::where('customer_vip',1)->get();
        $coupon = Coupon::where('coupon_code',$coupon_code)->first();
        $start_coupon = $coupon->coupon_date_start;
        $end_coupon = $coupon->coupon_date_end;
    	$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
    	$title_mail = "Mã khuyến mãi ngày".' '.$now;

        // Kiểm tra xem mã giảm giá đã hết hạn chưa
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $end_coupon = Carbon::createFromFormat('d-m-Y', $coupon->coupon_date_end)->format('Y-m-d');

        if ($today > $end_coupon) {
            return redirect()->back()->with('message', 'Mã giảm giá đã hết hạn!');
        }

    	$data = [];
    	foreach ($customer_vip as $vip) {
    		$data['email'][] = $vip->customer_email;
    	}
        $coupon = array(
            'start_coupon' => $start_coupon,
            'end_coupon' =>$end_coupon,
            'coupon_time' => $coupon_time,
            'coupon_condition' => $coupon_condition,
            'coupon_number' => $coupon_number,
            'coupon_code' => $coupon_code
        );
    	
    	Mail::send('pages.send_coupon_vip',['coupon'=>$coupon],function($message) use ($title_mail,$data){
    		$message->to($data['email'])->subject($title_mail);
    		$message->from($data['email'],$title_mail);
    	});

    	return redirect()->back()->with('message','Gửi mã khuyến mãi khách vip thành công!');
    }

    public function recover_pass(Request $request){
        $data = $request->all();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu".' '.$now;
        $customer = Customer::where('customer_email','=',$data['email_account'])->get();
        foreach ($customer as $key => $value) {
            $customer_id = $value->customer_id;
        }

        if($customer){
            $count_customer = $customer->count();
            if($count_customer==0){
                return redirect()->back()->with('error','Mail chưa được đăng ký để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();
                //send mail
                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);

                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']);

                Mail::send('pages.checkout.forget_pass_notify',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);
                });
                //send mail
                return redirect()->back()->with('message','Gửi mail thành công, vui lòng vào email lấy lại mật khẩu!');
            }
        }

    }

    public function reset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach ($customer as $key => $cus) {
                $customer_id = $cus->customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('dang-nhap')->with('message', 'Mật khẩu đã cập nhật mới. Vui lòng đăng nhập!');
        }else{
            return redirect('quen-mat-khau')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn!');
        }
    }

    public function update_new_pass(Request $request){
        //seo 
        $meta_desc = "Quên mật khẩu"; 
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();
        //--seo
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6);
        return view('pages.checkout.new_pass')->with('category',$cate_product)->with('all_product',$all_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function mail_example(){
    	return view('pages.send_coupon');
    }

    public function quen_mat_khau(Request $request){
        //seo 
        $meta_desc = "Quên mật khẩu"; 
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $url_canonical = $request->url();
        //--seo
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6);
        return view('pages.checkout.forget_pass')->with('category',$cate_product)->with('all_product',$all_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
            
    }
}
