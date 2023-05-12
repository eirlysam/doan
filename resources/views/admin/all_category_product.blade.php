@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ DANH MỤC SẢN PHẨM
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
                            <th>Tên danh mục</th>
                            <th>Thuộc danh mục</th>
                            <th>Slug</th>
                            <th>Hiển thị</th>
                            <th></th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Thuộc danh mục</th>
                            <th>Slug</th>
                            <th>Hiển thị</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <style type="text/css">
                        #category_order .ui-state-hightlight {
                            padding: 24px;
                            background-color: #ffffcc;
                            cursor: move;
                            margin-top: 12px;
                        }
                    </style>
                    <form>
                        @csrf
                    <tbody id="category_order">
                        @foreach($all_category_product as $key => $cate_pro)
                        <tr id="{{$cate_pro->category_id}}">
                            <td>{{$cate_pro->category_name}}</td>
                            <td>
                                @if($cate_pro->category_parent==0)
                                    <span style="color: red">Danh mục cha</span>
                                @else
                                    @foreach($category_product as $key => $cate_sub_pro)
                                        @if($cate_sub_pro->category_id==$cate_pro->category_parent)
                                            <span style="color: green">{{$cate_sub_pro->category_name}}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $cate_pro->slug_category_product }}</td>
                            <td>
                                <?php
                                if($cate_pro->category_status==0){
                                ?>
                                    <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td align="center">
                                <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class=""><i class="fa fa-pencil-square-o text-success"></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class=""><i class="fa fa-times text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </form>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection