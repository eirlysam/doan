@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                CẬP NHẬT DANH MỤC SẢN PHẨM
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
            @foreach($edit_category_product as $key => $edit_value)
            <form action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="POST">
                {{ csrf_field() }}
                <label class="form-label">Tên danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="category_product_name" value="{{$edit_value->category_name}}" class="form-control" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                </div>
                <label class="form-label">Slug</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="slug_category_product" value="{{$edit_value->slug_category_product}}" class="form-control">
                    </div>
                </div>
                <label class="form-label">Mô tả danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea name="category_product_desc" cols="30" rows="5" class="form-control no-resize" required>{{$edit_value->category_desc}}</textarea>
                    </div>
                </div>
                <label class="form-label">Từ khóa danh mục</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea style="resize: none" rows="3" name="category_product_keywords" class="form-control no-resize" required>{{$edit_value->meta_keywords}}</textarea>
                    </div>
                </div>
                <label class="form-label">Thuộc danh mục</label>
                <div class="form-group">
                    <select name="category_parent" class="form-control">
                        <option value="0">---Danh mục cha---</option>
                        @foreach($category as $key => $val)

                            @if($val->category_parent==0)
                                <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                            @endif

                            @foreach($category as $key => $val2)
                                @if($val2->category_parent==$val->category_id)
                                    <option {{$val2->category_id==$edit_value->category_id ? 'selected' : '' }} value="{{$val2->category_id}}">---{{$val2->category_name}}</option>
                                @endif
                            @endforeach

                        @endforeach
                    </select>
                </div>
                <br>
                
                <button class="btn btn-danger waves-effect" type="submit" name="update_category_product">Cập nhật danh mục</button>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection