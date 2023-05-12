
<div class="left-sidebar">
    <h2>@lang('lang.danhmuc')</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

        @foreach($category as $key => $cate)
            <div class="panel panel-default">
                @if($cate->category_parent==0)
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                <a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{$cate->category_name}}</a>
                                <!-- {{$cate->category_name}} -->
                            </a>
                        </h4>
                    </div>
                    <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category as $key => $cate_sub)
                                    @if($cate_sub->category_parent==$cate->category_id)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
                                    @endif
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
        
    </div><!--/category-products-->
    
    <!--price-range-->
    <!-- <div class="price-range">
        <h2>Price Range</h2>
        <div class="well text-center">
             <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
             <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div> -->
    <!--/price-range-->
    
    <!--shipping-->
    <!-- <div class="shipping text-center">
        <img src="images/home/shipping.jpg" alt="" />
    </div> -->
    <!--/shipping-->
    <div class="brands_products">
        <h2>Sản phẩm yêu thích</h2>
        <div class="brands-name">
            <div id="row_wishlist" class="row">
                
            </div>
        </div>
    </div>
    
    <div class="brands_products">
        <h2>Sản phẩm đã xem</h2>
        <div class="brands-name">
            <div id="row_viewed" class="row">
                
            </div>
        </div>
    </div>

    

</div>
            