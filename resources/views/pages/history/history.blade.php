@extends('layout')
@section('content')

<div class="container">
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">                
                    LIỆT KÊ ĐƠN HÀNG
                <?php
                $message = Session::get('message');
                if($message){
                    echo $message;
                    Session::put('message',null);
                }
                ?>
                
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tình trạng</th>
                                <th></th>
                        </thead>
                        
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($order as $key => $ord)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td><i>{{$i}}</i></td>
                                <td>{{$ord->order_code}}</td>
                                <td>{{$ord->created_at}}</td>
                                <td>
                                    @if($ord->order_status==1)
                                        <span class="text text-primary">Chờ xác nhận</span>
                                    @elseif($ord->order_status==2)
                                        <span class="text text-success">Đã xử lý</span>
                                    @else
                                        <span class="text text-danger">Đã hủy đơn hàng</span>
                                    @endif
                                </td>
                                <td align="center">
                                    
                                    @if($ord->order_status!=3 && $ord->order_status != 2)
                                    <!-- Trigger the modal with a button -->
                                    <p><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon_{{$ord->order_code}}">Hủy đơn hàng</button></p>
                                    @endif
                                    <!-- Modal -->
                                    <div id="huydon_{{$ord->order_code}}" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <form>
                                            @csrf
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                                              </div>
                                              <div class="modal-body">
                                                <p><textarea id="lydohuydon_{{$ord->order_code}}" rows="3" class="lydohuydon" required placeholder="(*) Lý do bạn hủy đơn...."></textarea></p>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="button" id="huydon_{{$ord->order_code}}" onclick="Huydonhang(this.id)" class="btn btn-danger">Gửi</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>

                                    <p><a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class=""><i class="text-success text-active">Xem đơn hàng</i></a></p>
                                    <!-- <a onclick="return confirm('Ban co chac chan xoa?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class=""><i class="fa fa-times text-danger"></i></a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center"></div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                               {!!$order->links()!!}
                            </ul>
                        </div>
                    </div>
                </footer>
                
            </div>
        </div>
    </div>
</div>
@endsection