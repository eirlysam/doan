@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÔNG TIN KHÁCH HÀNG
            </h2>
            <br>
            <style>
                .text-alert {
                    color: black;
                    background-color: #DDF7E3;
                    padding: 10px;
                    border-radius: 5px;
                }
            </style>

            <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên người vận chuyển</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$customer->customer_name}}</td>
                            <td>{{$customer->customer_email}}</td>
                            <td>{{$customer->customer_phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÔNG TIN VẬN CHUYỂN
            </h2>
            <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message',null);
            }
            ?>
            
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tên người vận chuyển</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Thanh toán</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên người vận chuyển</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>{{$shipping->shipping_name}}</td>
                            <td>{{$shipping->shipping_address}}</td>
                            <td>{{$shipping->shipping_phone}}</td>
                            <td>{{$shipping->shipping_email}}</td>
                            <td>{{$shipping->shipping_notes}}</td>
                            <td>
                                @if($shipping->shipping_method==0)
                                    Chuyển khoản
                                @elseif($shipping->shipping_method==1)
                                    Thanh toán khi nhận hàng
                                @else
                                    Thanh toán Paypal
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ CHI TIẾT ĐƠN HÀNG
            </h2>
            <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message',null);
            }
            ?>
            
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng kho</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Giá gốc</th>
                            <th>Tổng tiền</th>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng kho</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        @php 
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach($order_details as $key => $details)
                        @php 
                            $i++;
                            $subtotal = $details->product_price*$details->product_sales_quantity;
                            $total+=$subtotal;
                        @endphp
                        <tr class="color_qty_{{$details->product_id}}">
                            <td><i>{{$i}}</i></td>
                            <td>{{$details->product_name}}</td>
                            <td>{{$details->product->product_quantity}}</td>
                            <td>
                                @if($details->product_coupon!='no')
                                    {{$details->product_coupon}}
                                @else
                                    Không mã giảm giá
                                @endif
                            </td>
                            <td>
                                <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                                <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

                                @if($order_status!=2)
                                <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập nhật</button>
                                @endif
                            </td>
                            <td>{{number_format($details->product_price,0,',','.')}}đ</td>
                            <td>{{number_format($details->product->price_cost,0,',','.')}}đ</td>
                            <td>{{number_format($subtotal,0,',','.')}}đ</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                                
                                @php
                                    $total_coupon = 0; 
                                @endphp
                                @if($coupon_condition==1)
                                    @php
                                        $total_after_coupon = ($total*$coupon_number)/100;
                                    echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').'đ'.'</br>';
                                        $total_coupon = $total - $total_after_coupon;
                                    @endphp
                                @else
                                    @php
                                        echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').'đ'.'</br>';
                                        $total_coupon = $total - $coupon_number;
                                    @endphp
                                @endif
                                Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @foreach($order as $key => $or)
                                    @if($or->order_status==1)
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                
                                                <option id="{{$or->order_id}}" selected value="1">Chờ xử lý</option>
                                                <option id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>
                                                
                                            </select>
                                        </form>
                                    
                                    @else
                                        <form>
                                            @csrf
                                            <select class="form-control order_details">
                                                
                                                <option disabled id="{{$or->order_id}}" value="1">Chờ xử lý</option>
                                                <option id="{{$or->order_id}}" selected value="2">Đã xử lý - Đã giao hàng</option>
                                                
                                            </select>
                                        </form>
                                    @endif
                                @endforeach
                            </td>
                            
                        </tr>
                    </tbody>
                </table>
                <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection