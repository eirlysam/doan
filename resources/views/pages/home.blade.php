@extends('layout') 

@section('slider')
    @include('pages.include.slider');
@endsection

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            
                @include('pages.include.slidebar')
            
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Sản phẩm mới</h2>
                    @foreach($all_product as $key => $product)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <form>
                                                @csrf
                                                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                                                <input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">

                                                <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">

                                                <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">

                                                <input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">

                                                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                                                <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}">
                                                    <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="{{$product->product_name}}" />
                                                    <h2>{{number_format($product->product_price,0,',','.').'đ'}}</h2>
                                                    <p>{{$product->product_name}}</p>
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
                                                <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">

                                                <input type="button" data-toggle="modal" data-target="#xemnhanh" value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$product->product_id}}" name="add-to-cart">
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
                                            <button class="button_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach                        
                </div><!--features_items-->
                
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
                                        <!-- <label>Số lượng:</label> -->
                                        <input hidden name="qty" type="number" min="1" class="cart_product_qty_" value="1" />
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
                

            </div>
        </div>
    </div>
</section>
@endsection