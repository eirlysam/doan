@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM VẬN CHUYỂN
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
            <form>
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Chọn thành phố</label>
                    <select name="city" id="city" class="form-control choose city">
                        <option value="">---Chọn tỉnh thành phố---</option>
                    @foreach($city as $key => $ci)
                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                    @endforeach
                    </select>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Chọn quận huyện</label>
                    <select name="province" id="province" class="form-control province choose">
                        <option value="">---Chọn quận huyện---</option>
                        
                    </select>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Chọn xã phường</label>
                    <select name="wards" id="wards" class="form-control wards">
                        <option value="">---Chọn xã phường---</option>
                        
                    </select>
                </div>

                <label class="form-label">Phí vận chuyển</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="fee_ship" class="form-control fee_ship">
                    </div>
                </div>
                
                <br>

                <button type="button" name="add_delivery" class="btn btn-danger add_delivery">Thêm phí vận chuyển</button>
            </form>
        </div>
        <!-- <div id="load_delivery"></div> -->
    </div>
</div>
@endsection