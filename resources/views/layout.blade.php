<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- seo -->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{$url_canonical}}"/>
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href=""/>



    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">

    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/alertify.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/default.min.css')}}"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/semantic.min.css')}}"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap1.min.css')}}"/>



    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{('public/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{('public/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{('public/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{('public/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 0989123531</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> matustore@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                                @foreach($icons as $key => $icon)
                                <li><a target="_blank" title="{{$icon->name}}" href="{{$icon->link}}">
                                        <img alt="{{$icon->name}}" style="margin: 4px" width="20px" height="20px" src="{{asset('public/uploads/icons/'.$icon->image)}}">
                                </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img width="140px" height="70px" src="{{asset('public/frontend/images/home/logo1.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    @lang('lang.language')
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('lang/vi')}}">Việt Nam</a></li>
                                    <li><a href="{{url('lang/en')}}">English</a></li>
                                    <li><a href="{{url('lang/cn')}}">China</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VNĐ
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                 }
                                ?>
                                <style type="text/css">
                                    span#show-cart li {
                                        margin-top: 10px;
                                    }
                                </style>
                                <span id="show-cart"></span>

                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                ?>
                                    <li>
                                        <a href="{{URL::to('/history')}}"><i class="fa fa-lock"></i> Lịch sử đơn hàng</a>
                                        
                                    </li>

                                <?php 
                                }
                                ?>

                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                ?>
                                    <li>
                                        <a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i><img width="10%" src="{{Session::get('customer_picture')}}"> {{Session::get('customer_name')}} | Đăng xuất</a>
                                        
                                    </li>
                                
                                <?php
                                    }else{
                                ?>
                                    <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">@lang('lang.home')</a></li>
                                <li class="dropdown"><a href="#">@lang('lang.product')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $cate)
                                            @if($cate->category_parent==0)
                                                <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{$cate->category_name}}</a></li>
                                                @foreach($category as $key => $cate_sub)
                                                    @if($cate_sub->category_parent == $cate->category_id)
                                                        <ul class="cate_sub">
                                                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">{{$cate_sub->category_name}}</a></li>
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </li> 
                                
                                    
                                </li> 
                                
                                <li><a href="{{URL::to('/lien-he')}}">@lang('lang.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="post">
                            {{csrf_field()}}
                        <div class="search_box pull-right">
                            <input type="text" style="width: 60%; margin-right: 5px" name="keywords_submit" id="keywords" placeholder="Tìm kiếm..."/>
                            <div id="search_ajax"></div>
                            <input type="submit" style="margin-top: 0; color: #fff" name="search_items" class="btn btn-primary" value="Tìm kiếm">
                        </div>
                        </form>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    
    
    @yield('slider')
    @yield('slidebar')
    @yield('content')

    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    @foreach($contact_footer as $key => $logo)
                    <div class="col-sm-6">
                        <div class="companyinfo">
                            <p><img width="140" height="70" src="{{asset('public/uploads/contact/'.$logo->info_logo)}}"></p>
                            <p>{{$logo->slogan_logo}} </p>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-sm-6">
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    @foreach($contact_footer as $key => $contact)
                    <div class="col-sm-5">
                        <div class="single-widget">
                            <h2>Thông tin shop</h2>
                            <div class="information-footer">
                                {!!$contact->info_contact!!}
                            <!-- <ul class="nav nav-pills nav-stacked">
                                <li>Địa chỉ: </li>
                                <li>Số điện thoại: </li>
                                <li>Email: </li>
                            </ul> -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Dịch vụ chúng tôi</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hướng dẫn mua hàng</a></li>
                                <li><a href="#">Hướng dẫn thanh toán</a></li>
                                <li><a href="#">Chính sách đổi trả</a></li>
                                <li><a href="#">Điều khoản dịch vụ</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    
                    
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Đăng ký Email</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Điền email..." />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Shop chúng tôi sẽ cập nhật thông tin mới <br />nhất đến bạn...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2023 MaTu - Store</p>
                    
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>

    <!-- JavaScript -->
    <script src="{{asset('public/frontend/js/alertify.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>

    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>

    <script src="https://www.paypalobjects.com/api/checkout.js"></script>


    <script type="text/javascript">
        function Huydonhang(id){
            var order_code = id;
            var lydo = $('.lydohuydon').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{url('/huy-don-hang')}}",
                method:"POST",
                data:{order_code:order_code, lydo:lydo, _token:_token},
                success:function(data){
                    alert('Hủy đơn hàng thành công');
                    location.reload();
                    
                }
            });
        }
    </script>
    
    <!-- <script>
        var usd = document.getElementById("vnd_to_usd").value;
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
              sandbox: 'AYdnxZOpXJBwabqJPmn5wTtzo-BeEfnSUk-tnS0uo6e52SBHJ4rVECcC03FRDv2pB3KfvMG1henMbK4w',
              production: 'demo_production_client_id'
        },
            // Customize button (optional)
            locale: 'en_US',
            style: {
              size: 'small',
              color: 'gold',
              shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                  amount: {
                    total: `${usd}`,
                    currency: 'USD'
                  }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Cảm ơn bạn đã mua hàng của chúng tôi!');
            });
        }
      }, '#paypal-button');

    </script> -->
    
    <script type="text/javascript">
        $(document).ready(function(){
            $( "#slider-range" ).slider({
                orientation: "horizontal",
                range: true,

                min:{{$min_price_range}},
                max:{{$max_price_range}},
                steps:10000,
                 
                values: [ {{$min_price}}, {{$max_price}}  ],
                slide: function( event, ui ) {
                    $( "#amount_start" ).val(ui.values[ 0 ]+'đ -').simpleMoneyFormat();
                    $( "#amount_end" ).val(ui.values[ 1 ]+'đ').simpleMoneyFormat();

                    $( "#start_price" ).val(ui.values[ 0 ]);
                    $( "#end_price" ).val(ui.values[ 1 ]);
                }
            });
            $( "#amount_start" ).val($( "#slider-range" ).slider( "values", 0 )+'đ -');
            $( "#amount_end" ).val($( "#slider-range" ).slider( "values", 1 )+'đ');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change',function(){
                var url = $(this).val();
                // alert(url);
                if(url){
                    window.location = url;
                }
                return false;
            });
        });
    </script>

    <script type="text/javascript">
        function viewed(){
            if(localStorage.getItem('viewed')!=null){
                var data = JSON.parse(localStorage.getItem('viewed'));
                data.reverse();
                document.getElementById('row_viewed').style.overflow = 'scroll';
                document.getElementById('row_viewed').style.height = '300px';
                
                for(i=0;i<data.length;i++){

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_viewed').append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FE980F">'+price+'</p><a href="'+url+'">Mua ngay</a></div></div>');
                }
            }
        }
        viewed();
        product_viewed();
        function product_viewed(){

            var id_product = $('#product_viewed_id').val();

            if(id_product != undefined){
                var id = id_product;
                var name = document.getElementById('viewed_productname'+id).value;
                var url = document.getElementById('viewed_producturl'+id).value;
                var price = document.getElementById('viewed_productprice'+id).value;
                var image = document.getElementById('viewed_productimage'+id).value;
                
                // alert(name);
                // alert(price);
                // alert(image);
                // alert(url);
                var newItem = {
                    'url':url,
                    'id':id,
                    'name':name,
                    'price':price,
                    'image':image
                }

                if(localStorage.getItem('viewed')==null){
                    localStorage.setItem('viewed','[]');
                }

                var old_data = JSON.parse(localStorage.getItem('viewed'));

                var matches = $.grep(old_data, function(obj){
                    return obj.id == id;
                });

                if(matches.length){
                    
                }else{
                    old_data.push(newItem);
                    $('#row_viewed').append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+'</p><a href="'+newItem.url+'">Mua ngay</a></div></div>');
                }
                localStorage.setItem('viewed', JSON.stringify(old_data));
            }
            
        }
    </script>

    <script type="text/javascript">
        function view(){
            if(localStorage.getItem('data')!=null){
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '300px';

                for(i=0;i<data.length;i++){

                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;

                    $('#row_wishlist').append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FE980F">'+price+'</p><a href="'+url+'">Mua ngay</a></div></div>');
                }
            }
        }
        view();

        function add_wishlist(clicked_id){
            var id = clicked_id;
            // alert(id);
            var name = document.getElementById('wishlist_productname'+id).value;
            var price = document.getElementById('wishlist_productprice'+id).value;
            var image = document.getElementById('wishlist_productimage'+id).src;
            var url = document.getElementById('wishlist_producturl'+id).href;
            // alert(name);
            // alert(price);
            // alert(image);
            // alert(url);
            var newItem = {
                'url':url,
                'id':id,
                'name':name,
                'price':price,
                'image':image
            }

            if(localStorage.getItem('data')==null){
                localStorage.setItem('data','[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj){
                return obj.id == id;
            });

            if(matches.length){
                alert('Sản phẩm đã yêu thích, không thể thêm');
            }else{
                old_data.push(newItem);
                $('#row_wishlist').append('<div class="row" style="margin:10px 0;"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+'</p><a href="'+newItem.url+'">Mua ngay</a></div></div>');
            }
            localStorage.setItem('data', JSON.stringify(old_data));
        }
    </script>

    <script type="text/javascript">
        function remove_background(product_id){
            for(var count = 1; count <= 5; count++){
                $('#'+product_id+'-'+count).css('color', '#ccc');
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');

            remove_background(product_id);

            for(var count = 1; count <= index; count++){
                $('#'+product_id+'-'+count).css('color', '#ffcc00');
            }
        });
        //nhả chuột không đánh giá
        $(document).on('mouseleave', 'rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");

            remove_background(product_id);

            for(var count = 1; count <= rating; count++){
                $('#'+product_id+'-'+count).css('color', '#ffcc00');
            }
        });

        //click đánh giá sao
        $(document).on('click', '.rating', function(){
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/insert-rating')}}",
                method:"POST",
                data:{index:index, product_id:product_id, _token:_token},
                success:function(data){
                    if(data == 'done'){
                        alert("Cảm ơn bạn đã đánh giá "+index+ " trên 5");
                    }else{
                        alert("Lỗi đánh giá");
                    }
                    
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            load_comment();
            
            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/load-comment')}}",
                    method:"POST",
                    data:{product_id:product_id, _token:_token},
                    success:function(data){
                        $('#comment_show').html(data);
                        
                    }
                });
            }
            $('.send-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/send-comment')}}",
                    method:"POST",
                    data:{product_id:product_id, comment_name:comment_name, comment_content:comment_content,  _token:_token}, 
                    success:function(data){
                        
                        $('#notify_comment').html('<span class="text text-success">Thêm đánh giá thành công, đang chờ duyệt</span>');
                        load_comment();
                        $('#notify_comment').fadeOut(5000);
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    }
                });
            });
        })
    </script>

    <script type="text/javascript">
        $('.xemnhanh').click(function(){
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/quickview')}}",
                method:"POST",
                dataType:"JSON",
                data:{product_id:product_id, _token:_token},
                success:function(data){
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            }); 
        });
    </script>

    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();
            // alert(query);
            if(query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/autocomplete-ajax')}}",
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_search_ajax', function(){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Mua hàng",
                  cancelButtonText: "Hủy",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm){
                    if(isConfirm){
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();
                        
                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,shipping_method:shipping_method,order_coupon:order_coupon,_token:_token},
                            success:function(){
                                swal("Đơn hàng", "Thành công, chờ xác nhận.", "success");
                            }
                        });
                        window.setTimeout(function(){
                            window.location.href = '{{url('/history')}}';
                        } , 3000);
                        
                    }else{
                        swal("Đóng", "Hãy hoàn tất đơn hàng.", "error");
                    }
                  
                });
                
                
            });
        });
    </script>

    <script type="text/javascript">
        show_cart();
            //show cart-quantity
            function show_cart(){
                $.ajax({
                    url:'{{url('/show-cart')}}',
                    method:"GET",
                    
                    success:function(data){
                        $('#show-cart').html(data);
                    }
                });
            }
        $(document).ready(function(){
            
            $('.add-to-cart').click(function(){
                var id= $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Vuot qua so luong' + cart_product_quantity);
                }else{
                
                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){
                            // alertify.error('Đã thêm vào giỏ hàng');
                            swal({
                              title: "Đã thêm vào giỏ hàng!",
                              timer: 1000,
                            });
                            show_cart();
                        }

                    });
                }
                
            });
        });
    </script>

    <!-- add-to-cart-quickview -->
    <script type="text/javascript">
        
            $(document).on('click', '.add-to-cart-quickview', function(){
                var id= $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Vuot qua so luong' + cart_product_quantity);
                }else{
                
                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        beforeSend:function(){
                            $("#beforesend_quickview").html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                        },
                        success:function(){
                            $("#beforesend_quickview").html("<p class='text text-success'>Sản phẩm đã thêm vào giỏ hàng</p>");

                        }
                    });
                }
                
            });
            $(document).on('click','.redirect-cart',function(){
                window.location.href = "{{url('/gio-hang')}}";
            })
        
    </script>
</body>
</html>