@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM BANNER
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
            <form action="{{URL::to('/insert-slider')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="form-label">Tên Slide</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="slider_name" class="form-control">
                    </div>
                </div>
                <label class="form-label">Hình ảnh</label>
                <div class="form-group">
                    
                        <input type="file" name="slider_image" class="form-control">
                    
                </div>
                <label class="form-label">Mô tả</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="slider_desc" class="form-control no-resize" required></textarea>
                    </div>
                </div>
                <label class="form-label">Hiển thị</label>
                <div class="form-group">
                    <select name="slider_status" class="form-control">
                        <option value="1">Ẩn</option>
                        <option value="0">Hiện</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-danger waves-effect" type="submit" name="add_slider">Thêm banner</button>
            </form>
        </div>
    </div>
</div>
@endsection