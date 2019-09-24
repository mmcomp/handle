@php
$current_url = explode('/', str_replace('http://','', url()->current()));
if(count($current_url)>1) {
    $current_url = $current_url[count($current_url)-1];
}else {
    $current_url = '';
}
$user = Auth::user();
$user->load('group.details');
$isAdmin = false;
$hasStatics = false;
$hasReport = false;
$pathes = [];
foreach($user->group->details as $detail) {
    if($detail->path=='all') {
        $isAdmin = true;
    }
    if(strpos($detail->path, 'statistic')===0) {
        $hasStatics = true;
    }
    if(strpos($detail->path, 'report')===0) {
        $hasReport = true;
    }
    $pathes[] = $detail->path;
}
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
                                    <img src="/admin/dist/img/avatar5.png" class="img-circle" alt="{{ $user->name }}">
                                    <p>
                                        {{ $user->name }}
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div class="pull-left1">
                                        <form method="post"  action="/changepass">
                                            @csrf
                                            <label>
                                            رمز عبور فعلی : 
                                            </label>
                                            <input type="password" class="form-control" name="password" /><br/>
                                            <label>
                                            رمز عبور جدید : 
                                            </label>
                                            <input type="password" class="form-control" name="newpassword" /><br/>
                                            <label>
                                            تکرار رمز عبور جدید : 
                                            </label>
                                            <input type="password" class="form-control" name="newpassword2" /><br/>
                                            <button class="btn btn-default btn-flat">
                                            تغییر
                                            </button>
                                            <a href="/login" class="btn btn-default btn-flat" style="float: left;">خروج</a>
                                        </form>
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
                <ul class="sidebar-menu">
                  <li class="header">ناوبری اصلی</li>
                  @if($isAdmin || in_array('/', $pathes))
                  <li
                  @if($current_url=='' || $current_url=='home')
                   class="active"
                  @endif
                  >
                    <a href="/">
                      <i class="fa fa-chart-line"></i> <span>داشبورد</span> 
                    </a>
                  </li>
                  @endif @if($isAdmin || in_array('/protocols', $pathes))
                  <li
                  @if($current_url=='protocols')
                   class="active"
                  @endif
                  >
                    <a href="/protocols">
                      <i class="fa fa-file-signature"></i> <span>قراردادها</span> 
                    </a>
                  </li>
                  @endif @if($isAdmin || $hasStatics)
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
                                <i class="fa fa-certificate"></i> <span>انواع قرارداد</span> 
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
                        <li
                        @if($current_url=='statistics_province')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_province">
                                <i class="fa fa-certificate"></i> <span>استان</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_city')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_city">
                                <i class="fa fa-certificate"></i> <span>شهر</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_Education')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_Education">
                                <i class="fa fa-certificate"></i> <span>تحصیلات</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_FormalityStatus')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_FormalityStatus">
                                <i class="fa fa-certificate"></i> <span>وضعیت تشریفات</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_FormalityType')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_FormalityType">
                                <i class="fa fa-certificate"></i> <span>نوع تشریفات</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_GiveWay')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_GiveWay">
                                <i class="fa fa-certificate"></i> <span>روش واگذاری</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_Ownership')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_Ownership">
                                <i class="fa fa-certificate"></i> <span>نوع شرکت</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_Service')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_Service">
                                <i class="fa fa-certificate"></i> <span>خدمات</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_ServicesDesc')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_ServicesDesc">
                                <i class="fa fa-certificate"></i> <span>شرح خدمات</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_Transaction')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_Transaction">
                                <i class="fa fa-certificate"></i> <span>نوع معامله</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_Unit')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_Unit">
                                <i class="fa fa-certificate"></i> <span>واحدها</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='statistics_WinnerSelectWay')
                        class="active"
                        @endif
                        >
                            <a href="/statistics_WinnerSelectWay">
                                <i class="fa fa-certificate"></i> <span>نحوه تعیین برنده</span> 
                            </a>
                        </li>
                    </ul>
                  </li>
                  @endif @if($isAdmin || $hasReport)
                  <li class="treeview
                  @if(strpos($current_url, 'report')===0)
                   active
                  @endif
                  "
                  >
                    <a>
                      <i class="fa fa-folder-open"></i> <span>گزارشات</span> 
                    </a>
                    <ul class="treeview-menu">
                        <li
                        @if($current_url=='report_compare')
                        class="active"
                        @endif
                        >
                            <a href="/report_compare">
                                <i class="fa fa-chart-line"></i> <span>گزارش مقایسه ای</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='report_company')
                        class="active"
                        @endif
                        >
                            <a href="/report_company">
                                <i class="fa fa-chart-line"></i> <span>گزارش لیست پیمانگاران</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='report_protocol')
                        class="active"
                        @endif
                        >
                            <a href="/report_protocol">
                                <i class="fa fa-chart-line"></i> <span>گزارش لیست قراردادها</span> 
                            </a>
                        </li>
                        <li
                        @if($current_url=='report_warranty')
                        class="active"
                        @endif
                        >
                            <a href="/report_warranty">
                                <i class="fa fa-chart-line"></i> <span>گزارش لیست ضمانت نامه ها</span> 
                            </a>
                        </li>
                    </ul>
                  </li>
                  @endif
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <footer class="main-footer" style="padding-right: 100px !important;">
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
