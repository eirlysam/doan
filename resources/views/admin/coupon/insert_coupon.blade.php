@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM MÃ GIẢM GIÁ
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
            <form action="{{URL::to('/insert-coupon-code')}}" method="POST">
                {{ csrf_field() }}
                <label class="form-label">Tên mã giảm giá</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_name" class="form-control">
                    </div>
                </div>
                <label class="form-label">Ngày bắt đầu</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_date_start" id="start_coupon" class="form-control">
                    </div>
                </div>
                <label class="form-label">Ngày kết thúc</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_date_end" id="end_coupon" class="form-control">
                    </div>
                </div>
                <label class="form-label">Mã giảm giá</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_code" class="form-control">
                    </div>
                </div>
                <label class="form-label">Số lượng mã</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_time" class="form-control">
                    </div>
                </div>
                <label class="form-label">Tính năng mã</label>
                <div class="form-group">
                    <select name="coupon_condition" class="form-control">
                        <option value="0">---Chọn---</option>
                        <option value="1">Giảm theo phần trăm</option>
                        <option value="2">Giảm theo tiền</option>
                    </select>
                </div>
                <label class="form-label">Số % hoặc tiền gỉảm</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="coupon_number" class="form-control">
                    </div>
                </div>
                
                <br>
                <button class="btn btn-danger waves-effect" type="submit" name="add_coupon">Thêm mã giảm giá</button>
            </form>
        </div>
    </div>
</div>
@endsection