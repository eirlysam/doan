@extends('layout')
@section('content')
<div class="container">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                XEM CHI TIẾT ĐƠN HÀNG {{$order_code}}

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
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                        </thead>
                        
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
</div>
<br>
<div class="container">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                THÔNG TIN VẬN CHUYỂN
            
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
</div>
<br>
<div class="container">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                LIỆT KÊ CHI TIẾT ĐƠN HÀNG
            
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
                                    <input type="number" min="1" readonly {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                                    <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                                    <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                                    <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

                                    
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
                            
                        </tbody>
                    </table>
                    <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection