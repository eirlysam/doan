@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM THÔNG TIN WEBSITE
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
            @foreach($contact as $key => $cont)
                <form action="{{URL::to('/update-info/'.$cont->info_id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <label class="form-label">Thông tin liên hệ</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea style="resize: none" data-validation="length" data-validation-length="min3" data-validation-error-msg="Điền ít nhất 3 ký tự" rows="3" name="info_contact" id="ckeditor" class="form-control no-resize" required>{{$cont->info_contact}}</textarea>
                        </div>
                    </div>
                    
                    <label class="form-label">Bản đồ</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea style="resize: none" data-validation="length" data-validation-length="min3" data-validation-error-msg="Điền ít nhất 3 ký tự" rows="3" name="info_map" class="form-control no-resize" required>{{$cont->info_map}}</textarea>
                        </div>
                    </div>

                    <label class="form-label">Hình ảnh logo</label>
                    <div class="form-group">
                        <div>
                            <input type="file" name="info_logo" class="form-control">
                            <img src="{{url('public/uploads/contact/'.$cont->info_logo)}}" height="100" width="150">
                        </div>
                    </div>

                    <label class="form-label">Slogan logo</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="slogan_logo" value="{{$cont->slogan_logo}}" class="form-control">
                        </div>
                    </div>

                    <br>
                    <button class="btn btn-danger waves-effect" type="submit" name="add_info">Cập nhật thông tin</button>
                </form>
            @endforeach
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                CẬP NHẬT THÔNG TIN MẠNG XÃ HỘI
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
            
                <form role="form" id="form-nut">
                    {{ csrf_field() }}
                    
                    <label class="form-label">Tên mạng xã hội</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    
                    <label class="form-label">Link mạng xã hội</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="name" id="link" class="form-control">
                        </div>
                    </div>

                    <label class="form-label">Hình ảnh</label>
                    <div class="form-group">
                        <div>
                            <input type="file" name="info_logo" class="form-control" id="image_nut">
                            
                        </div>
                    </div>

                    
                    <button class="btn btn-danger waves-effect add-nut" type="submit" name="add_info">Thêm mạng xã hội</button>
                </form>
                <br>    
                <div class="position-center">
                    <div id="list_nut"></div>
                </div>
            
        </div>
    </div>
</div>
@endsection