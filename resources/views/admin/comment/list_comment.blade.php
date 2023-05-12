@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>
                LIỆT KÊ COMMENT
            </h2>
            <div id="notify_comment"></div>
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
                            <th>Duyệt</th>
                            <th>Tên người gửi</th>
                            <th>Ngày gửi</th>
                            <th>Đánh giá</th>
                            <th>Sản phẩm</th>
                            <th></th>
                            
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Duyệt</th>
                            <th>Tên người gửi</th>
                            <th>Ngày gửi</th>
                            <th>Đánh giá</th>
                            <th>Sản phẩm</th>
                            <th></th>
                            
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($comment as $key => $comm)
                        <tr>
                            <td>
                                @if($comm->comment_status==1)
                                    <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-success btn-xs comment_duyet_btn" value="Duyệt">
                                @else
                                    <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" id="{{$comm->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ duyệt">
                                @endif
                            </td>
                            
                            <td>{{$comm->comment_name}}</td>
                            <td>{{$comm->comment_date}}</td>
                            <td>
                                {{$comm->comment}}<br><br>
                                <style type="text/css">
                                    ul.list_rep li {
                                        list-style-type: decimal;
                                        color: blue;
                                        /*margin: 5px 40px;*/
                                    }
                                </style>
                                Trả lời: 
                                <ul class="list_rep">
                                    @foreach($comment_rep as $key => $comm_reply)
                                        @if($comm_reply->comment_parent_comment==$comm->comment_id)
                                            <li>{{$comm_reply->comment}}</li>
                                        @endif
                                    
                                    @endforeach
                                </ul>
                                @if($comm->comment_status==0)
                                    <textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="3"></textarea><br><br>
                                    <button class="btn btn-danger btn-xs btn-reply-comment" data-comment_id="{{$comm->comment_id}}" data-product_id="{{$comm->comment_product_id}}">Trả lời</button>
                                @endif
                                
                            </td>
                            
                            <!-- @if(isset($comm->product) && is_object($comm->product)) -->
                            <td><a href="{{url('/chi-tiet-san-pham/'.$comm->product->product_slug)}}" target="_blank">{{$comm->product->product_name}}</a></td>
                            <!-- @endif -->
                            <td align="center">
                                <a onclick="return confirm('Ban co chac chan xoa?')" href="" class=""><i class="fa fa-times text-danger"></i></a>
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