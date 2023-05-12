@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                CẬP NHẬT SẢN PHẨM
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
            @foreach($edit_product as $key => $pro)
            <form action="{{URL::to('/update-product/'.$pro->product_id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="form-label">Tên sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="product_name" class="form-control" value="{{$pro->product_name}}" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                </div>

                <label class="form-label">Slug</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="product_slug" class="form-control" value="{{$pro->product_slug}}" id="convert_slug">
                    </div>
                </div>

                <label class="form-label">Số lượng sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" data-validation="number" data-validation-error-msg="Điền vào số lượng" name="product_quantity" class="form-control" value="{{$pro->product_quantity}}">
                    </div>
                </div>

                <label class="form-label">Hình ảnh sản phẩm</label>
                <div class="form-group">
                    <div>
                        <input type="file" name="product_image" class="form-control">
                        <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="70" width="70">
                    </div>
                </div>

                <label class="form-label">Danh mục sản phẩm</label>
                <div class="form-group">
                    <select name="product_cate" class="form-control">
                        @foreach($cate_product as $key => $cate)
                            @if($cate->category_id==$pro->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <label class="form-label">Giá bán</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="product_price" class="form-control price_format" value="{{$pro->product_price}}">
                    </div>
                </div>

                <label class="form-label">Giá gốc</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="price_cost"  class="form-control price_format" value="{{$pro->price_cost}}">
                    </div>
                </div>

                <label class="form-label">Mô tả sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="product_desc" class="form-control no-resize" required>{{$pro->product_desc}}</textarea>
                    </div>
                </div>

                <label class="form-label">Nội dung sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="product_content" class="form-control no-resize" required>{{$pro->product_content}}</textarea>
                    </div>
                </div>

                <label class="form-label">Hiển thị</label>
                <div class="form-group">
                    <select name="product_status" class="form-control">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                <br>

                <button class="btn btn-danger waves-effect" type="submit" name="add_product">Cập nhật sản phẩm</button>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection