@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ MÃ GIẢM GIÁ
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
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng</th>
                            <th>Điều kiện</th>
                            <th>Số giảm</th>
                            <th>Trạng thái</th>
                            <th>Hết hạn</th>
                            <th></th>
                            <th></th>
                            
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng giảm giá</th>
                            <th>Điều kiện giảm giá</th>
                            <th>Số giảm</th>
                            <th>Trạng thái</th>
                            <th>Hết hạn</th>
                            <th></th>
                        </tr>
                    </tfoot> -->
                    <tbody>
                        @foreach($coupon as $key => $cou)
                        <tr>
                            <td>{{$cou->coupon_name}}</td>
                            <td>{{$cou->coupon_date_start}}</td>
                            <td>{{$cou->coupon_date_end}}</td>
                            <td>{{$cou->coupon_code}}</td>
                            <td>{{$cou->coupon_time}}</td>
                            
                            <td>
                                <?php
                                if($cou->coupon_condition==1){
                                ?>
                                    Giảm theo %
                                    <?php
                                    }else{
                                    ?>
                                    Giảm theo tiền
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                if($cou->coupon_condition==1){
                                ?>
                                    Giảm {{$cou->coupon_number}}%
                                    <?php
                                    }else{
                                    ?>
                                    Giảm {{$cou->coupon_number}}đ
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                if($cou->coupon_status==1){
                                ?>
                                    <span style="color: green">Đang kích hoạt</span>
                                    <?php
                                    }else{
                                    ?>
                                    <span style="color: red">Đã khóa</span>
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td>                               
                                @if($cou->coupon_date_end>=$today)
                                    <span style="color: green">Còn hạn</span>
                                @else
                                    <span style="color: red">Đã hết hạn</span>
                                @endif  
                            </td>
                            <td>
                                <p><a href="{{url('/send-coupon-vip',[

                                    'coupon_time'=>$cou->coupon_time,
                                    'coupon_condition'=>$cou->coupon_condition,
                                    'coupon_number'=>$cou->coupon_number,
                                    'coupon_code'=>$cou->coupon_code

                                    ])}}" class="btn btn-primary" style="margin: 5px 0;">Gửi khách vip</a></p>

                                <p><a href="{{url('/send-coupon',[

                                    'coupon_time'=>$cou->coupon_time,
                                    'coupon_condition'=>$cou->coupon_condition,
                                    'coupon_number'=>$cou->coupon_number,
                                    'coupon_code'=>$cou->coupon_code

                                    ])}}" class="btn btn-default">Gửi khách thường</a></p>
                            </td>
                            <td align="center">
                                <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class=""><i class="fa fa-times text-danger"></i></a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection