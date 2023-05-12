@extends('layout')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('pages.include.slidebar')
            </div>
       
            <div class="col-sm-9 padding-right">
            	@foreach($product_details as $key => $value)

            	<input type="hidden" id="product_viewed_id" value="{{$value->product_id}}">
            	<input type="hidden" id="viewed_productname{{$value->product_id}}" value="{{$value->product_name}}">
            	<input type="hidden" id="viewed_producturl{{$value->product_id}}" value="{{url('/chi-tiet-san-pham/'.$value->product_slug)}}">
            	<input type="hidden" id="viewed_productimage{{$value->product_id}}" value="{{asset('public/uploads/product/'.$value->product_image)}}">
            	<input type="hidden" id="viewed_productprice{{$value->product_id}}" value="{{number_format($value->product_price,0,',','.')}}đ">

				<div class="product-details"><!--product-details-->
					<style type="text/css">
						ul li.active {
							border: 2px solid #FE980F;
						}
					</style>
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb" style="background: none;">
					    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
					    <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$cate_slug)}}">{{$product_cate}}</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
					  </ol>
					</nav>
					<div class="col-sm-6">

						<ul id="imageGallery">
							@foreach($gallery as $key => $gal)
								<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
								<img width="100%" src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" />
								</li>
						  	@endforeach
						</ul>

					</div>
					<div class="col-sm-6">
						<div class="product-information"><!--/product-information-->
							<!-- <img src="images/product-details/new.jpg" class="newarrival" alt="" /> -->
							<h2>{{$value->product_name}}</h2>
								
							<!-- <img src="images/product-details/rating.png" alt="" /> -->
							<form action="{{URL::to('/save-cart')}}" method="post">
								@csrf
									<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                                    <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
								
									<span>{{number_format($value->product_price,0,',','.').'đ'}}</span>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}" value="1" />
									<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
								
							
								<input type="button" value="Thêm giỏ hàng" class="btn btn-primary add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
									<!-- <i class="fa fa-shopping-cart"></i> -->
							</form>
							<p><b>Tình trạng:</b> Còn hàng</p>
							<p><b>Điều kiện:</b> Mới</p>
							<p><b>Danh mục:</b> {{$value->category_name}}</p>
							<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
							<!-- share fb -->
							<!-- <div id="fb-root"></div>
							<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="7o3EL4YR"></script>
							<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="" data-size=""><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div> -->
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->
				
				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li  class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
							<li><a href="#tag" data-toggle="tab">Chi tiết sản phẩm</a></li>
							<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							<!-- <li><a href="#binhluan" data-toggle="tab">Bình luận</a></li> -->
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="binhluan" >
							<div class="col-sm-3">
								<div id="fb-root"></div>
								<div id="fb-root"></div>
								<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="R4axbGf5"></script>
								<div class="fb-comments" data-href="" data-width="" data-numposts="5"></div>
							</div>								
						</div>

						<div class="tab-pane fade  active in" id="details" >
							<!-- <div class="col-sm-3"> -->
								<p>{!!$value->product_desc!!}</p>
							<!-- </div> -->								
						</div>
						
						
						<div class="tab-pane fade" id="tag" >
							<!-- <div class="col-sm-3"> -->
								<p>{!!$value->product_content!!}</p>
							<!-- </div> -->								
						</div>
						
						<div class="tab-pane fade" id="reviews" >
							<div class="col-sm-12">
								
								<style type="text/css">
									.style_comment {
										border: 1px solid #ddd;
										border-radius: 10px;
										background: #F0F0E9;
									}
								</style>
								<form>
									@csrf

									<input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
									<div id="comment_show"></div>

								</form>
								<br>
								<p><b>Viết đánh giá của bạn</b></p>
								<ul class="list-inline" title="Average Rating">
									@for($count=1;$count<=5;$count++)
										@php 
											if($count<=$rating){
												$color = 'color:#ffcc00;';
											}else{
												$color = 'color:#ccc;';
											}
										@endphp
									<li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor: pointer; {{$color}} font-size: 30px;">&#9733;</li>
									@endfor
								</ul>
								
								<form action="#">
									<span>
										<input style="width: 100%; margin-left: 0" type="text" class="comment_name" placeholder="Tên đánh giá"/>
										
									</span>
									<textarea name="comment" class="comment_content" placeholder="Nội dung đánh giá"></textarea>
									<div id="notify_comment"></div>
									
									<button type="button" class="btn btn-default pull-right send-comment">
										Gửi
									</button>

								</form>
							</div>
						</div>
						
					</div>
				</div><!--/category-tab-->
				@endforeach
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">Sản phẩm liên quan</h2>
					
					<!-- <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active"> -->
							@foreach($relate as $key => $lienquan)	
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<form>
	                                                @csrf
	                                                <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">

	                                                <input type="hidden" id="wishlist_productname{{$lienquan->product_id}}" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">

	                                                <input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">

	                                                <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">

	                                                <input type="hidden" id="wishlist_productprice{{$lienquan->product_id}}" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">

	                                                <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">

	                                                <a id="wishlist_producturl{{$lienquan->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">
	                                                    <img id="wishlist_productimage{{$lienquan->product_id}}" src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="{{$lienquan->product_name}}" />

	                                                    <h2>{{number_format($lienquan->product_price,0,',','.').'đ'}}</h2>
	                                                    <p>{{$lienquan->product_name}}</p>
	                                                </a>
	                                                <!-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a> -->
	                                                <style type="text/css">
	                                                    .xemnhanh {
	                                                        background: #F5F5ED;
	                                                        border: 0 none;
	                                                        border-radius: 0;
	                                                        color: #696763;
	                                                        font-family: 'Roboto', sans-serif;
	                                                        font-size: 15px;
	                                                        margin-bottom: 25px;
	                                                    }
	                                                </style>
	                                                <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">

	                                                <input type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
	                                            </form>
											</div>
										</div>
										<div class="choose">
		                                    <ul class="nav nav-pills nav-justified">
		                                        <style type="text/css">
		                                            ul.nav.nav-pills.nav-justified li {
		                                                text-align: center;
		                                                font-size: 13px;
		                                            }
		                                            .button_wishlist {
		                                                border: none;
		                                                background: #ffff;
		                                                color: #B3AFA8;
		                                            }
		                                            ul.nav.nav-pills.nav-justified i {
		                                                color: #B3AFA8;
		                                            }
		                                            .button_wishlist span:hover {
		                                                color: #FE980F;
		                                            }
		                                            .button_wishlist:focus {
		                                                border: none;
		                                                outline: none;
		                                            }
		                                        </style>
		                                        <li>
		                                            <i class="fa fa-plus-square"></i>
		                                            <button class="button_wishlist" id="{{$lienquan->product_id}}" onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
		                                        </li>
		                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
		                                    </ul>
		                                </div>
									</div>
								</div>
							@endforeach	
							<!-- </div>
							
						</div> -->
						 <!-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						  </a>
						  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						  </a> -->			
					<!-- </div> -->
					<!-- Modal -->
                <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title product_quickview_title" id="">
                            <span id="product_quickview_title"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <div class="row">
                            <div class="col-md-5">
                                <span id="product_quickview_image"></span>
                                <span id="product_quickview_gallery"></span>
                            </div>
                            <form>
                                @csrf
                                <div id="product_quickview_value"></div>
                                <div class="col-md-7">
                                    <style type="text/css">
                                        h5.modal-title.product_quickview_title {
                                            text-align: center;
                                            font-size: 25px;
                                            color: brown;
                                        }
                                        p.quickview {
                                            font-size: 14px;
                                            color: brown;
                                        }
                                        span#product_quickview_content img {
                                            width: 100%;
                                        }
                                        <style>
                                            @media screen and (min-width: 768px) {
                                                .modal-dialog {
                                                    width: 700px;
                                                }
                                                .modal-sm {
                                                    width: 350px;
                                                }
                                            }
                                            @media screen and (min-width: 992px) {
                                                .modal-lg {
                                                    width: 1200px;
                                                }
                                            }
                                        </style>
                                    </style>
                                    <h2><span id="product_quickview_title"></span></h2>
                                    <span>
                                        <h2 style="color: #FE980F">Giá tiền: <span id="product_quickview_price"></span></h2><br>
                                        <label>Số lượng:</label>
                                        <input name="qty" type="number" min="1" class="cart_product_qty_" value="1" />
                                        <input name="productid_hidden" type="hidden" value="" />
                                    </span>
                                    <p>Mô tả sản phẩm</p>
                                    <fieldset>
                                        <span style="width: 100%" id="product_quickview_desc"></span>
                                        <span style="width: 100%" id="product_quickview_content"></span>
                                    </fieldset>
                                    
                                
                                    <div id="product_quickview_button"></div>
                                    <div id="beforesend_quickview"></div>
                                </div>
                            </form>
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
                      </div>
                    </div>
                  </div>
                </div>
				</div><!--/recommended_items-->
			</div>
        </div>
    </div>
</section>
@endsection
