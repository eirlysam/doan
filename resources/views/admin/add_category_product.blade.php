@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                THÊM DANH MỤC SẢN PHẨM
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
            <form action="{{URL::to('/save-category-product')}}" method="POST">
                {{ csrf_field() }}
                <label class="form-label">Tên danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="category_product_name" class="form-control" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                </div>
                <label class="form-label">Slug</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="slug_category_product" class="form-control" id="convert_slug">
                    </div>
                </div>
                <label class="form-label">Mô tả danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="category_product_desc" class="form-control no-resize" required></textarea>
                    </div>
                </div>
                <label class="form-label">Từ khóa danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="category_product_keywords" class="form-control no-resize" required></textarea>
                    </div>
                </div>
                <label class="form-label">Thuộc danh mục</label>
                <div class="form-group">
                    <select name="category_parent" class="form-control">
                        <option value="0">---Danh mục cha---</option>
                        @foreach($category as $key => $val)
                            <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label class="form-label">Hiển thị</label>
                <div class="form-group">
                    <select name="category_product_status" class="form-control">
                        <option value="1">Ẩn</option>
                        <option value="0">Hiển thị</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-danger waves-effect" type="submit" name="add_category_product">Thêm danh mục</button>
            </form>
        </div>
    </div>
</div>
@endsection