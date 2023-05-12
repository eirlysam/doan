<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;
use App\Statistical;
use Carbon\Carbon;
use App\Slider;
use PDF;
use Mail;
use Session;
use DB;

class OrderController extends Controller
{
    public function huy_don_hang(Request $request){
        $data = $request->all();
        $order = Order::where('order_code',$data['order_code'])->first();
        $order->order_destroy = $data['lydo'];
        $order->order_status = 3;
        $order->save();
    }

    public function update_qty(Request $request){
        $data = $request->all();
        $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function update_order_qty(Request $request){
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();

        //send mail confirm
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Đơn hàng xác nhận ngày".' '.$now;
        $customer = Customer::where('customer_id',$order->customer_id)->first();
        $data['email'][] = $customer->customer_email;

        //lay san pham
        foreach ($data['order_product_id'] as $key => $product) {
            $product_mail = Product::find($product);
            foreach ($data['quantity'] as $key2 => $qty) {
                    if($key==$key2){
                        $cart_array[] = array(
                            'product_name' => $product_mail['product_name'],
                            'product_price' => $product_mail['product_price'],
                            'product_qty' => $qty
                        );
                    }
            }
        }

        //lay shipping
        $details = OrderDetails::where('order_code',$order->order_code)->first();
        $coupon_mail = $details->product_coupon;
        $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
        $shipping_array = array(
            'customer_name' => $customer->customer_name,
            'shipping_name' => $shipping->shipping_name,
            'shipping_email' => $shipping->shipping_email,
            'shipping_phone' => $shipping->shipping_phone,
            'shipping_address' => $shipping->shipping_address,
            'shipping_notes' => $shipping->shipping_notes,
            'shipping_method' => $shipping->shipping_method
        );
        //lay coupon
        $ordercode_mail = array(
            'coupon_code' => $coupon_mail,
            'order_code' => $details->order_code
        );

        Mail::send('admin.confirm_order',['cart_array'=>$cart_array,'shipping_array'=>$shipping_array,'code'=>$ordercode_mail],function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });

        //order date
        $order_date = $order->order_date;
        $statistic = Statistical::where('order_date',$order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        if($order->order_status==2){
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0; 
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;

                $product_price = $product->product_price;
                $product_cost = $product->price_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();

                        //update doanh thu
                        $quantity+=$qty;
                        $total_order+=1;
                        $sales+=$product_price*$qty;
                        $profit = $sales-($product_cost*$qty);
                    }
                }

            }
            if($statistic_count>0){
            $statistic_update = Statistical::where('order_date',$order_date)->first();
            $statistic_update->sales = $statistic_update->sales + $sales;
            $statistic_update->profit = $statistic_update->profit + $profit;
            $statistic_update->quantity = $statistic_update->quantity + $quantity;
            $statistic_update->total_order = $statistic_update->total_order + $total_order;
            $statistic_update->save();
        }else{
            $statistic_new = new Statistical();
            $statistic_new->order_date = $order_date;
            $statistic_new->sales = $sales;
            $statistic_new->profit = $profit;
            $statistic_new->quantity = $quantity;
            $statistic_new->total_order = $total_order;
            $statistic_new->save();
        }
        }
        

    }

	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		return $pdf->stream();
	}

	public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();
		$order_details_product = OrderDetails::with('product')->where('order_code',$checkout_code)->get();
		foreach($order_details as $key => $order_d){
			$product_coupon = $order_d->product_coupon;

		}
		if($product_coupon!='no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}else{
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
			
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
			$coupon_echo = '0';
		}
		$output = '';
		$output.='
		<style>
		body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border: 1px solid #000;
		}

		</style>
		<h3><center>Phụ kiện - Văn phòng phẩm Ichi</center></h3>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
            </thead>
            <tbody>';
        $output.='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_email.'</td>
                    <td>'.$customer->customer_phone.'</td>
                </tr>';
        $output.='
            </tbody>
        </table>

        <p>Ship hàng tới</p>
		<table class="table-styling">
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
            </thead>
            <tbody>';
        $output.='
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_email.'</td>
                    <td>'.$shipping->shipping_notes.'</td>
                </tr>';
        $output.='
            </tbody>
        </table>

        <p>Đơn hàng</p>
		<table class="table-styling">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Thành tiền</th>
            </thead>
            <tbody>';
            $total = 0;
            foreach ($order_details_product as $key => $product) {
            	$subtotal = $product->product_price*$product->product_sales_quantity;
            	$total+= $subtotal;

            	if($product->product_coupon!='no'){
            		$product_coupon = $product->product_coupon;
            	}else{
            		$product_coupon = 'Không mã giảm giá';
            	}

        $output.='
                <tr>
                    <td>'.$product->product_name.'</td>
                    <td>'.$product_coupon.'</td>
                    <td>'.$product->product_sales_quantity.'</td>
                    <td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
                    <td>'.number_format($subtotal,0,',','.').'đ'.'</td>
                </tr>';
            }

            if($coupon_condition==1){
            	$total_after_coupon = ($total*$coupon_number)/100;
            	
                $total_coupon = $total - $total_after_coupon;
            }else{
            	
                $total_coupon = $total - $coupon_number;
            }

        $output.='
        <tr>
        	<td colspan="2">
        		<p>Tổng giảm : '.$coupon_echo.'</p>
        		<p>Thanh toán : '.number_format($total_coupon,0,',','.').'đ'.'</p>
        	</td>

        </tr>';
        $output.='
            </tbody>
        </table>
        <br>
        <br>
		<table>
            <thead>
                <tr>
                    <th width="200px">Người lập phiếu</th>
                    <th width="800px">Khách hàng</th>
            </thead>
            <tbody>';

        $output.='
            </tbody>
        </table>

        ';
		return $output;
	}

	public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();

		foreach($order_details as $key => $order_d){
			$product_coupon = $order_d->product_coupon;

		}
		if($product_coupon!='no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		return view('admin.view_order')->with(compact('order_details','customer','shipping','coupon_condition','coupon_number','order','order_status'));

	}

    public function delete_order($order_code){
        DB::table('tbl_order')->where('order_code',$order_code)->delete();
        Session::put('message', 'Xóa đơn hàng thành công!');
        return Redirect::to('manage-order'); 
    }

    public function manage_order(){
    	$order = Order::orderby('order_id','DESC')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }

    public function history(Request $request){
        if(!Session::get('customer_id')){
            return redirect('/dang-nhap')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');
        }else{
            
            //seo 
            $meta_desc = "Lịch sử đơn hàng"; 
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            //--seo
            //slide
            $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
            
            $order = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','DESC')->paginate(10);

            return view('pages.history.history')->with('category',$cate_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('order',$order);
        }
    }

    public function view_history_order(Request $request, $order_code){
        if(!Session::get('customer_id')){
            return redirect('/dang-nhap')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');
        }else{
            
            //seo 
            $meta_desc = "Lịch sử đơn hàng"; 
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            //--seo
            //slide
            $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','0')->take(3)->get();


            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_parent','desc')->orderby('category_order','ASC')->get();
            // xem lich su don hang
            $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
            $order = Order::where('order_code',$order_code)->first();
            
            $customer_id = $order->customer_id;
            $shipping_id = $order->shipping_id;
            $order_status = $order->order_status;
            
            $customer = Customer::where('customer_id',$customer_id)->first();
            $shipping = Shipping::where('shipping_id',$shipping_id)->first();

            $order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();

            foreach($order_details as $key => $order_d){
                $product_coupon = $order_d->product_coupon;

            }
            if($product_coupon!='no'){
                $coupon = Coupon::where('coupon_code',$product_coupon)->first();
                $coupon_condition = $coupon->coupon_condition;
                $coupon_number = $coupon->coupon_number;
            }else{
                $coupon_condition = 2;
                $coupon_number = 0;
            }

            return view('pages.history.view_history_order')->with('category',$cate_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('order_details',$order_details)->with('customer',$customer)->with('shipping',$shipping)->with('coupon_condition',$coupon_condition)->with('coupon_number',$coupon_number)->with('order',$order)->with('order_status',$order_status)->with('order_code',$order_code);
        }
    }
}
