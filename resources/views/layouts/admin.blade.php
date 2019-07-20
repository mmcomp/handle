@php
$current_url = explode('/', str_replace('http://','', url()->current()));
if(count($current_url)>1) {
    $current_url = $current_url[count($current_url)-1];
}else {
    $current_url = '';
}
$user = Auth::user();
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>رسیدگی و نظارت | داشبورد</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css" > -->
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!--Persian Date Picker-->
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
    @yield('extra_css')

    <link rel="stylesheet" href="/admin/dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="/admin/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="/admin/dist/css/rtl.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
@if($user->group_id==1)
<body class="skin-purple-light sidebar-mini">
@elseif($user->group_id==2)
<body class="skin-green sidebar-mini">
@else
<body class="skin-blue sidebar-mini">
@endif
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/ad" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>رسی</b>ن</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>رسیدگی</b>نظارت</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-right">
                                                    <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-right">
                                                    <img src="/admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-right">
                                                    <img src="/admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-right">
                                                    <img src="/admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-right">
                                                    <img src="/admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li> -->
                        <!-- Notifications: style can be found in dropdown.less -->
                        <!-- <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">۱۰</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li> -->
                        <!-- Tasks: style can be found in dropdown.less -->
                        <!-- <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">۹</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-left">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-left">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-left">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-left">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <!-- <li class="dropdown tasks-menu"> -->
                        <!-- href="/help/{{ $current_url }}"  -->
                            <!-- <a target="_blank" style="position: relative;color: #ffffff;float: right;margin: 15px;"  data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-question"></i>
                            </a> -->
                        <!-- </li>                         -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(isset($resident) && $resident->image_path && $resident->image_path!='')
                                <!-- <img src="{{ $resident->image_path }}" class="user-image" alt="{{ $user->name }}"> -->
                                @else
                                <!-- <img src="/admin/dist/img/avatar5.png" class="user-image" alt="{{ $user->name }}"> -->
                                @endif
                                <img src="/admin/dist/img/avatar5.png" class="user-image" alt="{{ $user->name }}">
                                <span class="hidden-xs">{{ $user->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if(isset($resident) && $resident->image_path && $resident->image_path!='')
                                    <!-- <img src="{{ $resident->image_path }}" class="img-circle" alt="{{ $user->name }}"> -->
                                    @else
                                    <!-- <img src="/admin/dist/img/avatar5.png" class="img-circle" alt="{{ $user->name }}"> -->
                                    @endif
                                    <img src="/admin/dist/img/avatar5.png" class="img-circle" alt="{{ $user->name }}">
                                    <p>
                                        {{ $user->name }}
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                @if($user->group_id!=2)
                                <!--
                                <li class="user-body">
                                    <div class="col-xs-12">
                                        <form action="/editprofile" method="post">
                                            @csrf
                                            @if($user->group_id==0)
                                            <div class="form-group">
                                                <label for="mobile">
                                                    موبایل
                                                </label>
                                                <input class="form-control" name="mobile" placeholder="موبایل" value="{{ $user->mobile }}" />
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="password">
                                                    رمز عبور جدید
                                                </label>
                                                <input class="form-control" type="password" name="password" placeholder="رمز عبور جدید" />
                                            </div>
                                            <div style="text-align: left;">
                                                <button class="btn btn-primary">ثبت</button>
                                            </div>
                                        </form> 
                                    </div>
                                </li>
                                -->
                                @endif
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div class="pull-left">
                                        <a href="/login" class="btn btn-default btn-flat">خروج</a>
                                        @if($user->group_id!=2)
                                        <!-- <a href="/login" class="btn btn-default btn-flat">خروج</a> -->
                                        @else
                                        <!--
                                        <form method="post"  enctype="multipart/form-data" action="/resident_image">
                                            @csrf
                                            تصویر : <input type="file" name="image_path" /><br/>
                                            نمایش در رده بندی : <input type="checkbox" name="show_in_leaderboard" 
                                            @if(isset($resident) && $resident->show_in_leaderboard==1)
                                            checked
                                            @endif
                                            /><br/><br/>
                                            <button class="btn btn-default btn-flat">
                                            تغییر
                                            </button>
                                            <a href="/resident_login" class="btn btn-default btn-flat" style="float: left;">خروج</a>
                                        </form>
                                        -->
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-right image">
                        <img src="/admin/dist/img/avatar5.png" class="img-circle" alt="{{ $user->name }}">
                    </div>
                    <div class="pull-left info">
                        <p>{{ $user->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                    </div>
                </div>
                <!-- search form -->
                <!--
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="جستوجو ...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                -->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                  <li class="header">ناوبری اصلی</li>
                  @if($user->group_id==1)
                  <!--
                  <li
                  @if($current_url=='' || $current_url=='userlevels')
                   class="active"
                  @endif
                  >
                    <a href="/">
                      <i class="fa fa-archive"></i> <span>مدیریت سطوح</span> 
                    </a>
                  </li>
                  <li
                  @if($current_url=='user_medalians')
                   class="active"
                  @endif
                  >
                    <a href="/user_medalians">
                      <i class="fa fa-angle-double-up"></i> <span>مدیریت نشان افتخارها</span> 
                    </a>
                  </li>
                  <li
                  @if($current_url=='user_token')
                   class="active"
                  @endif
                  >
                    <a href="https://documenter.getpostman.com/view/200973/RztkNV1j#7c593f53-7f39-f7d7-2f0f-f54cff4a2228" target="_blank" >
                      <i class="fa fa-lock"></i> <span>راهنمای وب سرویس</span> 
                    </a>
                  </li>
                  -->
                  @elseif($user->group_id==2)
                  <!--
                  <li
                  @if($current_url=='' || $current_url=='resident')
                   class="active"
                  @endif
                  >
                    <a href="/">
                      <i class="fa fa-user"></i> <span>پروفایل</span> 
                    </a>
                  </li>
                  <li
                  @if($current_url=='resident_signs')
                   class="active"
                  @endif
                  >
                    <a href="/resident_signs">
                      <i class="fa fa-asterisk"></i> <span>نشانها</span> 
                    </a>
                  </li>
                  <li
                  @if($current_url=='resident_coin_trans')
                   class="active"
                  @endif
                  >
                    <a href="/resident_coin_trans">
                      <i class="fa fa-coins"></i> <span>تراکنشهای سکه</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_catagory')
                   class="active"
                  @endif
                  >
                    <a href="/resident_catagory">
                      <i class="fa fa-archive"></i> <span>دسته شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_leaderboard')
                   class="active"
                  @endif
                  >
                    <a href="/resident_leaderboard">
                      <i class="fa fa-list-ol"></i> <span>جدول رده بندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_activity')
                   class="active"
                  @endif
                  >
                    <a href="/resident_activity">
                      <i class="fa fa-stream"></i> <span>گروه ها</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_tournament')
                   class="active"
                  @endif
                  >
                    <a href="/resident_tournament">
                      <i class="fab fa-algolia"></i> <span>چالش ها</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_battle')
                   class="active"
                  @endif
                  >
                    <a href="/resident_battle">
                      <i class="fa fa-fist-raised"></i> <span>نبردها</span> 
                    </a>
                  </li>
                  -->
                  @else
                  <li
                  @if($current_url=='' || $current_url=='home')
                   class="active"
                  @endif
                  >
                    <a href="/">
                      <i class="fa fa-chart-line"></i> <span>داشبورد</span> 
                    </a>
                  </li>
                  <li
                  @if($current_url=='protocols')
                   class="active"
                  @endif
                  >
                    <a href="/protocols">
                      <i class="fa fa-file-signature"></i> <span>قراردادها</span> 
                    </a>
                  </li>
                  <li class="treeview
                  @if(strpos($current_url, 'statistic')===0)
                   active
                  @endif
                  "
                  >
                    <a>
                      <i class="fa fa-folder-open"></i> <span>اطلاعات پایه</span> 
                    </a>
                    <ul class="treeview-menu">
                        <li
                        @if($current_url=='statistics_protocol_type')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_protocol_type">
                                <i class="fa fa-file-contract"></i> <span>انواع قرارداد</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_certificate_type')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_certificate_type">
                                <i class="fa fa-certificate"></i> <span>انواع مدرک شناسایی</span> 
                            </a>
                        </li>
                    </ul>
                  </li>
                  <!--
                  <li                  
                  @if($current_url=='fields')
                   class="active"
                  @endif
                  >
                    <a href="/fields">
                      <i class="fa fa-list-ol"></i> <span>مدیریت امتیازها</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='resident_catagories')
                   class="active"
                  @endif
                  >
                    <a href="/resident_catagories">
                      <i class="fa fa-archive"></i> <span>مدیریت دسته های شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='levels')
                   class="active"
                  @endif
                  >
                    <a href="/levels">
                      <i class="fa fa-angle-double-up"></i> <span>مدیریت سطوح شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='sequences')
                   class="active"
                  @endif
                  >
                    <a href="/sequences">
                      <i class="fa fa-arrows-alt"></i> <span>مدیریت چرخه ها</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='signs')
                   class="active"
                  @endif
                  >
                    <a href="/sign">
                      <i class="fa fa-asterisk"></i> <span>مدیریت نشان های شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='signs')
                   class="active"
                  @endif
                  >
                    <a href="/nicknames">
                      <i class="fa fa-address-book"></i> <span>مدیریت لقب های شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='activity_groups')
                   class="active"
                  @endif
                  >
                    <a href="/activity_groups">
                      <i class="fa fa-stream"></i> <span>مدیریت گروه های شهروندی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='tournamets')
                   class="active"
                  @endif
                  >
                    <a href="/tournamets">
                      <i class="fab fa-algolia"></i> &nbsp;&nbsp;&nbsp;<span>مدیریت چالش های گروهی</span> 
                    </a>
                  </li>
                  <li                  
                  @if($current_url=='battle')
                   class="active"
                  @endif
                  >
                    <a href="/battle">
                      <i class="fa fa-fist-raised"></i> <span>مدیریت نبردها</span> 
                    </a>
                  </li>
                  <li>
                    <a href="/under">
                      <i class="fa fa-brain"></i> <span>پنل هوش تجاری</span>
                    </a>
                  </li>
                  <li>
                    <a href="/under">
                      <i class="fa fa-hand-pointer"></i> <span>تنظیمات هوش مصنوعی</span>
                    </a>
                  </li>
                  <li>
                    <a href="/under">
                      <i class="fa fa-sim-card"></i> <span>تنظیمات مربوط به اینترنت اشیا</span>
                    </a>
                  </li>
                  <li>
                    <a href="/under">
                      <i class="fa fa-at"></i> <span>مدیریت دسترسی </span>
                    </a>
                  </li>
                  <li>
                    <a href="/under">
                      <i class="fa fa-database"></i> <span>داده کاوی</span>
                    </a>
                  </li>
                  -->
                  @endif
                    <!--
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>پیشخوان</span> <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> پیشخوان v1</a></li>
                            <li><a href="/admin/index2.html"><i class="fa fa-circle-o"></i> پیشخوان v2</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Layout Options</span>
                            <span class="label label-primary pull-left">۴</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top
                                    Navigation</a></li>
                            <li><a href="/admin/pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                            <li><a href="/admin/pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                            <li><a href="/admin/pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i>
                                    Collapsed Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/pages/widgets.html">
                            <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-left bg-green">new</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                            <li><a href="/admin/pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="/admin/pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="/admin/pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="/admin/pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="/admin/pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="/admin/pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="/admin/pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="/admin/pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/forms/general.html"><i class="fa fa-circle-o"></i> General
                                    Elements</a></li>
                            <li><a href="/admin/pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced
                                    Elements</a></li>
                            <li><a href="/admin/pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="/admin/pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/pages/calendar.html">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <small class="label pull-left bg-red">3</small>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-left bg-yellow">12</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="/admin/pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="/admin/pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="/admin/pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i>
                                    Lockscreen</a></li>
                            <li><a href="/admin/pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="/admin/pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="/admin/pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                            <li><a href="/admin/pages/examples/profile.html"><i class="fa fa-circle-o"></i> <span>Profil<small
                                            class="label bg-red">جديد</small></a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <i class="fa fa-angle-left pull-left"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-left"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-left"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        </ul>
                    </li>
                    <li><a href="/admin/documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                    <li class="header">LABELS</li>
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                    -->
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <footer class="main-footer">
            <!-- <div class="pull-left hidden-xs">
                <b>Version</b> 2.2.0
            </div> -->
            کلیه حقوق متعلق به  <strong><a target="_blank" href="http://datiscompany.ir">شرکت داتیس نگارنده</a> &copy; 2015-2019</strong> می باشد.
        </footer>


        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    @yield('alerts')
    
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
        <div class="modal-content" style="background: #000;color: #fff;">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">راهنما</h4>
            </div>
            <div class="modal-body" style="background: #000;color: #fff;">
                <div style="text-align: center;">
                    <img src="/admin/dist/img/help_img.png" style="height: 100px;" />
                </div>
            <p>{!! (isset($help))?$help:'' !!}</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">خروج</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.4 -->
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="/admin/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/admin/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin/dist/js/app.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!--Persian Date Picker-->
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <script>
      $(".pdate").pDatepicker({
        format: 'YYYY/MM/DD',
        initialValue: false,
        initialValueType: 'persian',
      });
    </script>
    @yield('extra_script')
</body>

</html>
