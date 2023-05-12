@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ ĐƠN HÀNG
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
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tình trạng</th>
                            <th>Lý do hủy đơn</th>
                            <th></th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tình trạng</th>
                            <th>Lý do hủy đơn</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($order as $key => $ord)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td><i>{{$i}}</i></td>
                            <td>{{$ord->order_code}}</td>
                            <td>{{$ord->created_at}}</td>
                            <td>
                                @if($ord->order_status==1)
                                    <span class="text text-primary">Chờ xác nhận</span>
                                @elseif($ord->order_status==2)
                                    <span class="text text-success">Đã xử lý</span>
                                @else
                                    <span class="text text-danger">Đã hủy đơn hàng</span>
                                @endif
                            </td>
                            <td>
                                @if($ord->order_status==3)
                                    {{$ord->order_destroy}}
                                @endif
                            </td>
                            <td align="center">
                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class=""><i class="fa fa-eye text-success"></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class=""><i class="fa fa-times text-danger"></i></a>
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