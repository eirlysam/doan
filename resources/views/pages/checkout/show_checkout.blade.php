@extends('layout') 
@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
			  <li class="active">Thanh toán</li>
			</ol>
		</div><!--/breadcrums-->

		<div class="register-req">
			<p>Đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
		</div><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-9 ">
					@if(session()->has('message'))
				        <div class="alert alert-success">
				            {{ session()->get('message') }}
				        </div>
				    @elseif(session()->has('error'))
				         <div class="alert alert-danger">
				            {{ session()->get('error') }}
				        </div>
				    @endif
					<div class="table-responsive cart_info">
						<form action="{{url('/update-cart')}}" method="post">
							@csrf
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Hình ảnh</td>
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá tiền</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@if(Session::get('cart')==true)
									<?php
										$total = 0;  
									?>
									@foreach(Session::get('cart') as $key => $cart)
										<?php 
											$subtotal = $cart['product_price']*$cart['product_qty'];
											$total+=$subtotal;
										?>
									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_image']}}"></a>
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
												
													
													<input class="cart_quantity_input" type="number" 

													@if(Session::get('success_paypal')==true)
														readonly 
													@endif

													min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" autocomplete="off" size="2">
													<!-- <input type="hidden" value="" name="rowId_cart" class="form-control"> -->
													
												
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}}đ
											</p>
										</td>
										<td class="cart_delete">
											@if(!Session::get('success_paypal')==true)
													
											<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>

											@endif
										</td>
									</tr>

									@endforeach	
									<tr>
										@if(!Session::get('success_paypal')==true)
										<td>
											<input type="submit" value="Cập nhật" name="update_qty" class="update btn-default btn-sm">
										</td>
										<td><a class="btn btn-default delete" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
										<td colspan="2">
											<!-- <form action="{{url('/check_coupon')}}" method="post">
												<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá...">
												<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Áp dụng">
											</form> -->
											<a class="btn btn-default check_out" href="{{route('processTransaction')}}">Thanh toán bằng PayPal</a>
										</td>
										@endif
										<td colspan="2">
											<div class="total_area">
											
											<ul>
												<li>Tổng <span>{{number_format($total,0,',','.')}}đ</span></li>
												@if(Session::get('coupon'))
												<li> 
													@foreach(Session::get('coupon') as $key => $cou)
														@if($cou['coupon_condition'] == 1)
															Mã giảm <span>{{$cou['coupon_number']}} %</span>
															<p>
																@php
																$total_coupon = ($total*$cou['coupon_number'])/100;
																echo '<p><li>Tổng giảm <span>'.number_format($total_coupon,0,',','.').'đ</span></li></p>';
																@endphp
															</p>
															<p><li>Thành tiền <span> {{number_format($total-$total_coupon,0,',','.')}}đ</span></li></p>
														@else
															Mã giảm <span>{{number_format($cou['coupon_number'],0,',','.')}} đ</span>
															<p>
																@php
																$total_coupon = $total - $cou['coupon_number'];
																@endphp
															</p>
															<p><li>Thành tiền <span>{{number_format($total_coupon,0,',','.')}}đ</span></li></p>
														@endif
													@endforeach
												</li>
												@endif
												
											</ul>
												<!-- @if(Session::get('customer'))
					                          	<a class="btn btn-default check_out" href="{{url('/checkout')}}">Đặt hàng</a>
					                          	@else 
					                          	<a class="btn btn-default check_out" href="{{url('/dang-nhap')}}">Đặt hàng</a>
												@endif  -->
												
												
										</div>

										<ul>
											<div class="col-sd-12">
												@php
													$vnd_to_usd = $total / 23495;

												    if (Session::get('coupon')) {
												        foreach (Session::get('coupon') as $key => $cou) {
												            if ($cou['coupon_condition'] == 1) {
												                $total_coupon = ($total * $cou['coupon_number']) / 100;
												                $vnd_to_usd = ($total - $total_coupon) / 23495;
												            } else {
												                $total_coupon = $total - $cou['coupon_number'];
												                $vnd_to_usd = $total_coupon / 23495;
												            }
												        }
												    }

												    $total_paypal = round($vnd_to_usd,2);
													\Session::put('total_paypal',$total_paypal);

												@endphp
												<!-- <div id="paypal-button"></div> -->
												<!-- <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}"> -->
											</div>
										</ul>

										</td>
									</tr>
									@else
									<tr>
										<td colspan="5"><center>
										@php 
										echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
										@endphp
										</center></td>
									</tr>
									@endif
								</tbody>

							</table>
							
						</form>
						@if(Session::get('cart'))
						@if(!Session::get('success_paypal')==true)
							<div class="container">
								<div class="row">
									<div class="col-sm-3">
										
										<form action="{{url('/check-coupon')}}" method="post">
											@csrf
											<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá...">
											<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Áp dụng">
											@if(Session::get('coupon'))
				                          		<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif
										</form>
										
									</div>	
								</div>
							</div>
						@endif
						@endif
					</div>
				</div>
				<div class="col-sm-3">
					@if(\Session::has('error'))
				        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
				        {{ \Session::forget('error') }}
				    @endif
				    @if(\Session::has('success'))
				        <div class="alert alert-success">{{ \Session::get('success') }}</div>
				        {{ \Session::forget('success') }}
				    @endif
					<div class="shopper-info">
						<p>Thông tin thanh toán</p>
						<form method="post">
							@csrf
							<input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
							<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
							<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
							<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
							<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú" rows="3"></textarea>
							@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
								<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
								@endforeach
							@else
								<input type="hidden" name="order_coupon" class="order_coupon" value="no">
							@endif	

							<div class="form-group"><br>
			                    <label class="form-label">Chọn hình thức thanh toán</label>
			                    @if(!Session::get('success_paypal')==true)
			                    <select name="payment_select" class="form-control payment_select">
			                        <option value="0">Chuyển khoản</option> 
			                        <option value="1">Tiền mặt</option> 
			                    </select>
			                    @else
			                    <select name="payment_select" class="form-control payment_select">
			                        <option value="2">Đã thanh toán thành công bằng Paypal</option>  
			                    </select>
			                    @endif
			                </div>
			                <a><input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary send_order"></a>
							<!-- <a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a> -->
						</form>
						
					</div>
				</div>	
				<!-- <div class="col-sm-12 clearfix"> -->
						
			</div>
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection