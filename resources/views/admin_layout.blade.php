<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/plugins/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/plugins/font-awesome/fonts/fontawesome-webfont.eot')}}">

    <!-- JQuery DataTable Css -->
    <link href="{{asset('public/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('public/backend/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('public/backend/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('public/backend/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <!-- <link href="{{asset('public/backend/plugins/morrisjs/morris.css')}}" rel="stylesheet" /> -->

    <!-- Bootstrap Select Css -->
    <link href="{{asset('public/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('public/backend/css/themes/all-themes.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">ADMIN - MATUSTORE</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('public/backend/images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            $name = Auth::user()->admin_name;
                            if($name){
                                echo $name;
                            }
                        ?>
                    </div>
                    <div class="email">
                        <?php
                            $email = Auth::user()->admin_email;
                            if($email){
                                echo $email;
                            }
                        ?>
                    </div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="{{URL::to('/dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">info</i>
                            <span>Thông tin website</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/info')}}">Thêm thông tin</a>
                            </li>
                           
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">face</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/add-users')}}">Thêm users</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/users')}}">Liệt kê users</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">slideshow</i>
                            <span>Banner</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/add-slider')}}">Thêm slider</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shop</i>
                            <span>Đơn hàng</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">loyalty</i>
                            <span>Giảm giá</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a>
                                <a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Vận chuyển</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a>
                                
                            </li>
                            
                        </ul>
                    </li> -->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Danh mục sản phẩm</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">category</i>
                            <span>Sản phẩm</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a>
                            </li>
                            <li>
                                <a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">grading</i>
                            <span>Đánh giá</span>
                        </a>
                        <ul class="ml-menu">
        
                            <li>
                                <a href="{{URL::to('/comment')}}">Liệt kê đánh giá</a>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!-- <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div> -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
          <div class="block-header">
            @yield('admin_content')
          </div>

            
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('public/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('public/backend/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('public/backend/plugins/node-waves/waves.js')}}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('public/backend/plugins/jquery-countto/jquery.countTo.js')}}"></script>

    <!-- Morris Plugin Js -->
    <!-- <script src="{{asset('public/backend/plugins/raphael/raphael.min.js')}}"></script> -->
    <!-- <script src="{{asset('public/backend/plugins/morrisjs/morris.js')}}"></script> -->

    <!-- ChartJs -->
    <!-- <script src="{{asset('public/backend/plugins/chartjs/Chart.bundle.js')}}"></script> -->

    <!-- Flot Charts Plugin Js -->
    <!-- <script src="{{asset('public/backend/plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('public/backend/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('public/backend/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('public/backend/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('public/backend/plugins/flot-charts/jquery.flot.time.js')}}"></script> -->

    <!-- Sparkline Chart Plugin Js -->
    <!-- <script src="{{asset('public/backend/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script> -->
    

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('public/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('public/backend/js/admin.js')}}"></script>
    <script src="{{asset('public/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <!-- <script src="{{asset('public/backend/js/pages/index.js')}}"></script> -->


    <!-- Demo Js -->
    <script src="{{asset('public/backend/js/demo.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    
    <script type="text/javascript">
        $( function() {
            $( "#start_coupon" ).datepicker({
                dateFormat:"dd-mm-yy"
            });
        });
        $( function() {
            $( "#end_coupon" ).datepicker({
                dateFormat:"dd-mm-yy"
            });
        });
    </script>

    <script type="text/javascript">
        list_nut();
        function delete_icons(id){
            $.ajax({
                url:'{{url('/delete-icons')}}',
                method:"GET",
                data:{id:id},
                success:function(data){
                    list_nut();
                }
            });

        }
        function list_nut(){
            $.ajax({
                url:'{{url('/list-nut')}}',
                method:"GET",
                success:function(data){
                    $('#list_nut').html(data);
                }
            });

        }
        $('.add-nut').click(function(){
            var name = $('#name').val();
            var link = $('#link').val();
            var image = $('#image_nut')[0].files[0];
            var form_data = new FormData();

            form_data.append('file',image);
            form_data.append('name',name);
            form_data.append('link',link);
            
            

            $.ajax({
                url:'{{url('/add-nut')}}',
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                cache: false,
                processData: false,

                data:form_data,
                success:function(data){
                    alert("Thêm mạng xã hội thành công!");
                    list_nut();
                }
            });
        });
    </script>

    <!-- <script type="text/javascript">
        $('.price_format').simpleMoneyFormat();
    </script> -->

    <script type="text/javascript">
        $(document).ready(function(){
            chart60daysorder();

            var chart = new Morris.Bar({
            
                element: 'chart',

                // option chart
                lineColors: ['#819C79','#FC8710','#FF6541','#A4ADD3','#766B56'],
                    parseTime: false,
                    hideHover: 'auto',
                    xkey: 'period',
                    ykeys: ['order','sales','profit','quantity'],
                    labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']

            });

            function chart60daysorder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/days-order')}}',
                    method:"POST",
                    dataType:"JSON",
                    data:{_token:_token},
                        success:function(data){
                            chart.setData(data);
                        }
                });
            }

            $('.dashboard-filter').change(function(){
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();

                // alert(dashboard_value);
                 
                $.ajax({
                    url:'{{url('/dashboard-filter')}}',
                    method:"POST",
                    dataType:"JSON",
                    data:{dashboard_value:dashboard_value,_token:_token},
                    success:function(data){
                        chart.setData(data);
                    }
                });
            });

            $('#btn-dashboard-filter').click(function(){
                // alert('ok');
                var _token = $('input[name="_token"]').val();

                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                // alert(from_date);
                // alert(to_date); 
                $.ajax({
                    url:'{{url('/filter-by-date')}}',
                    method:"POST",
                    dataType:"JSON",
                    data:{from_date:from_date,to_date:to_date,_token:_token},
                    success:function(data){
                        chart.setData(data);

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            var donut = Morris.Donut({
              element: 'donut',
              resize: true,
              colors: [
                '#CE616A',
                
                '#CE8F61',
                
                '#4842F5',

                // '#FDCEDF'
              ],
              //labelColor:"#cccccc", // text color
              //backgroundColor: '#333333', // border color
              data: [
                {label:"San pham", value:<?php echo $app_product ?>},
                
                {label:"Don hang", value:<?php echo $app_order ?>},
    
                {label:"Khach hang", value:<?php echo $app_customer ?>}

                
              ]
            });
        });
    </script>

    <script type="text/javascript">
        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat:"yy-mm-dd"
            });
        });
        $( function() {
            $( "#datepicker2" ).datepicker({
                dateFormat:"yy-mm-dd"
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#category_order').sortable({
                placeholder: 'ui-state-hightlight',
                update : function(event, ui){
                    var page_id_array = new Array();
                    var _token = $('input[name="_token"]').val();
                    $('#category_order tr').each(function(){
                        page_id_array.push($(this).attr("id"));
                    });
                    // alert(page_id_array);

                    $.ajax({
                        url:'{{url('/arrange-category')}}',
                        method:"POST",
                        data:{page_id_array:page_id_array,_token:_token},
                        success:function(data){
                            alert(data);
                        }
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.comment_duyet_btn').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');

            if(comment_status==0){
                var alert = 'Duyệt thành công';
            }else{
                var alert = 'Bỏ duyệt thành công';
            }

            $.ajax({
                url:'{{url('/allow-comment')}}',
                method:"POST",
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){

                    $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');
                    location.reload();
                }
            });
        });
        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_'+comment_id).val();
            
            var comment_product_id = $(this).data('product_id');

            // alert(comment);
            // alert(comment_id);
            // alert(comment_product_id);

            $.ajax({
                url:'{{url('/reply-comment')}}',
                method:"POST",
                data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $('.reply_comment_'+comment_id).val('');
                    $('#notify_comment').html('<span class="text text-alert">Trả lời đánh giá thành công</span>');
                    location.reload();
                }
            });
        });
    </script>

    <script type="text/javascript">
        
            load_gallery();

            function load_gallery(){
                var pro_id= $('.pro_id').val();
                var _token = $('input[name="_token"]').val();
                // alert(pro_id);
                $.ajax({
                    url:'{{url('/select-gallery')}}',
                    method:"POST",
                    data:{pro_id:pro_id,_token:_token},
                    success:function(data){
                        $('#gallery_load').html(data);
                    }
                });
            }

            $('#file').change(function(){
                var error = '';
                var files = $('#file')[0].files;

                if(files.length>3){
                    error+='<p>Chọn tối đa 3 ảnh</p>';
                }else if(files.length==''){
                    error+='<p>Không được bỏ trống ảnh</p>';
                }

                if(error==''){

                }else{
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            });

            $(document).on('blur','.edit_gal_name',function(){
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/update-gallery-name')}}',
                    method:"POST",
                    data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Cập nhật tên sản phẩm thành công</span>');
                    }
                });
            });

            $(document).on('click','.delete-gallery',function(){
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(confirm('Bạn muốn xóa hình ảnh này không?')){
                    $.ajax({
                        url:'{{url('/delete-gallery')}}',
                        method:"POST",
                        data:{gal_id:gal_id,_token:_token},
                        success:function(data){
                            load_gallery();
                            $('#error_gallery').html('<span class="text-danger">Xóa tên sản phẩm thành công</span>');
                        }
                    });
                }
            });

            $(document).on('change','.file_image',function(){
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById("file-"+gal_id).files[0];

                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-'+gal_id).files[0]);
                form_data.append("gal_id",gal_id);

                $.ajax({
                    url:"{{url('/update-gallery')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh sản phẩm thành công</span>');
                    }
                });
                
            });
        
    </script>

    <script type="text/javascript">
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    <script type="text/javascript">
        $('.update_quantity_order').click(function(){
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);

            $.ajax({
                url : '{{url('/update-qty')}}',
                method: 'POST',
                data:{_token:_token, order_product_id:order_product_id, order_qty:order_qty, order_code:order_code},
                success:function(data){
                    alert('Cập nhật số lượng thàng công');
                    location.reload();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.order_details').change(function(){
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            // alert(order_status);
            // alert(order_id);
            // alert(_token);

            //lay ra so luong
            quantity = [];
            $("input[name='product_sales_quantity']").each(function(){
                quantity.push($(this).val());
            });

            //lay ra product_id
            order_product_id = [];
            $("input[name='order_product_id']").each(function(){
                order_product_id.push($(this).val());
            });
            j = 0;
            for(i=0;i<order_product_id.length;i++){
                //so luong khach hang dat mua
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                //so luong ton kho
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if(parseInt(order_qty)>parseInt(order_qty_storage)){
                    j = j + 1;
                    if(j==1){
                        alert('Số lượng bán trong kho không đủ');
                    }
                    $('.color_qty_'+order_product_id[i]).css('background','#FFDDD2')
                }

            }
            if(j==0){
                $.ajax({
                    url : '{{url('/update-order-qty')}}',
                    method: 'POST',
                    data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
                    success:function(data){
                        alert('Cập nhật tình trạng đơn hàng thàng công');
                        location.reload();
                    }
                });
            }

            

        });
    </script>

    

    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
                // console.log('Button clicked!');
                // alert('ok');
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                // console.log(action); 
                // console.log(ma_id); 
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                //  alert(matp);
                //   alert(_token);

                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : '{{url('/select-delivery')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        console.log(data);
                       $('#'+result).html(data);     
                    }
                });
            });

        });
    </script> -->

    <script type="text/javascript">
        $(document).ready( function () {
        $('#myTable').DataTable();
        } );
    </script>

    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>

    <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
    </script>

    

</html>
