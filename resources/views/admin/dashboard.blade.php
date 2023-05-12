@extends('admin_layout')
@section('admin_content')


        <div class="container-fluid">
            <!-- <div class="block-header">
                <h2>DASHBOARD</h2>
            </div> -->
            <style type="text/css">
            	p.title_thongke {
            		text-align: center;
            		font-size: 20px;
            		font-style: bold;
            	}
            </style>
            <div class="row clearfix">
            	<p class="title_thongke">THỐNG KÊ ĐƠN HÀNG DOANH SỐ</p>
            	<form autocomplete="off">
            		@csrf
            		<div class="col-md-4">
            			<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            			<input type="button" id="btn-dashboard-filter" class="btn btn-danger btn-sm" value="Lọc kết quả">
            		</div>
            		<div class="col-md-4">
            			<p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            			
            		</div>
            		<div class="col-md-4">
            			<p>Lọc theo:
            			<select class="dashboard-filter form-control">
            				<option>---Chọn---</option>
            				<option value="7ngay">7 ngày qua</option>
            				<option value="thangtruoc">Tháng trước</option>
            				<option value="thangnay">Tháng này</option>
            				<option value="365ngayqua">365 ngày qua</option>
            			</select>
            		</div>
            	</form>

            	<div class="col-md-12">
            		<div id="chart" style="height: 250px;"></div>
            	</div>
            </div>
            <br>
            
            

            <div class="row clearfix">
            	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2 class="title_thongke">TỔNG SẢN PHẨM BÀI VIẾT ĐƠN HÀNG</h2>
                        </div>
                        <div class="body">
                            <div id="donut" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div>
                
                
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">SẢN PHẨM XEM NHIỀU</div>
                            <ul class="dashboard-stat-list">
                            	@foreach($product_views as $key => $pro)
                                <li>
                                    <a target="_blank" style="color: white" href="{{url('/chi-tiet-san-pham/'.$pro->product_slug)}}">{{$pro->product_name}}</a> 
                                    <span class="pull-right">{{$pro->product_views}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>
        </div>


@endsection