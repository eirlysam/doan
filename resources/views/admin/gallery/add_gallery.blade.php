@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM THƯ VIỆN ẢNH
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
        <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3" align="right">
                    
                </div>
                <div class="col-md-5">
                    <input type="file" name="file[]" id="file" class="form-control" accept="image/*" multiple>
                    <span id="error_gallery"></span>
                </div>
                <div class="col-md-4">
                    <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success">
                </div>
            </div>
        </form>
        <div class="body">
            <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
            <form>
                @csrf
            <div id="gallery_load">
                
            </div>
            </form>
        </div>
    </div>
</div>
@endsection