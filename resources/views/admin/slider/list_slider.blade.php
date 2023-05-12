@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ BANNER
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
                            <th>Tên Banner</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Tình trạng</th>
                            <th></th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên Banner</th>
                            <th>Hình ảnh</th>
                            <th>Mô tả</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($all_slide as $key => $slide)
                        <tr>
                            <td>{{$slide->slider_name}}</td>
                            <td><img src="public/uploads/slider/{{$slide->slider_image}}" height="200" width="400"></td>
                            <td>{{$slide->slider_desc}}</td>
                            <td>
                                <?php
                                if($slide->slider_status==0){
                                ?>
                                    <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-up"></span></a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="fa-thumbs-styling fa fa-thumbs-down"></span></a>
                                    <?php
                                    }
                                    ?>
                            </td>
                            <td align="center">
                                <a onclick="return confirm('Ban co chac chan xoa?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class=""><i class="fa fa-times text-danger"></i></a>
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