@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM SẢN PHẨM
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
            <form action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class="form-label">Tên sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Điền ít nhất 3 ký tự" name="product_name" class="form-control" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                </div>

                <label class="form-label">Slug</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="product_slug" class="form-control" id="convert_slug">
                    </div>
                </div>

                <label class="form-label">Số lượng sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" data-validation="number" data-validation-error-msg="Điền vào số lượng" name="product_quantity" class="form-control">
                    </div>
                </div>

                <label class="form-label">Hình ảnh sản phẩm</label>
                <div class="form-group">
                    <div>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                </div>

                <label class="form-label">Danh mục sản phẩm</label>
                <div class="form-group">
                    <select name="product_cate" class="form-control">
                        @foreach($cate_product as $key => $cate)
                            @if($cate->category_parent==0)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @foreach($cate_product as $key => $cate_sub)
                                    @if($cate_sub->category_parent!=0 && $cate_sub->category_parent==$cate->category_id)
                                        <option style="color: red;" value="{{$cate_sub->category_id}}">--- {{$cate_sub->category_name}}</option>
                                        
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>

                <label class="form-label">Giá bán</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Điền vào số tiền" name="product_price" class="form-control">
                    </div>
                </div>

                <label class="form-label">Giá gốc</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Điền vào số tiền" name="price_cost" class="form-control">
                    </div>
                </div>

                <label class="form-label">Mô tả sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="product_desc" class="form-control no-resize" required id="ckeditor1"></textarea>
                    </div>
                </div>

                <label class="form-label">Nội dung sản phẩm</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="product_content" class="form-control no-resize" required id="ckeditor"></textarea>
                    </div>
                </div>

                <label class="form-label">Hiển thị</label>
                <div class="form-group">
                    <select name="product_status" class="form-control">
                        <option value="0">Hiển thị</option>
                        <option value="1">Ẩn</option>
                    </select>
                </div>
                <br>

                <button class="btn btn-danger waves-effect" type="submit" name="add_product">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>
@endsection