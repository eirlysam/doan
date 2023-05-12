@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ SẢN PHẨM
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
                            <th>Tên sản phẩm</th>
                            <th>Thư viện ảnh</th>
                            <th>Slug</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Giá gốc</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Hiển thị</th>
                            <th></th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Thư viện ảnh</th>
                            <th>Slug</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Giá gốc</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Hiển thị</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($all_product as $key => $pro)
                        <tr>
                            <td>{{$pro->product_name}}</td>
                            <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm ảnh</a></td>
                            <td>{{$pro->product_slug}}</td>
                            <td>{{$pro->product_quantity}}</td>
                            <td>{{number_format($pro->product_price,0,',','.')}}đ</td>
                            <td>{{number_format($pro->price_cost,0,',','.')}}đ</td>
                            <td><img src="public/uploads/product/{{$pro->product_image}}" height="70" width="70"></td>
                            <td>{{$pro->category_name}}</td>
                            
                            <td>
                                <?php
                                if($pro->product_status==0){
                                ?>
                                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td align="center">
                                <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class=""><i class="fa fa-pencil-square-o text-success"></i></a>
                                <a onclick="return confirm('Bạn có chắc chắn xóa?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class=""><i class="fa fa-times text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection