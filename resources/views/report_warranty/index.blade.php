@extends('layouts.admin')

@section('extra_css')
<!-- DataTables -->
<link rel="stylesheet" href="/admin/plugins/datatables/dataTables.bootstrap.css">
<!-- Select2 -->
<link href="/admin/plugins/select2/select2.min.css" rel="stylesheet" />
<style>
  .select2-container {
    width: 100% !important;
  }

  .select2-selection__rendered {
    direction: rtl !important;
  }

  .select2-results__option {
    direction: rtl !important;
    text-align: right !important;
  }
</style>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url('/admin/dist/img/mashhad.png');">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1 style="background-color: #ffffff;padding: 10px;">
            لیست ضمانت نامه ها
              <small></small>
          </h1>
          <!-- <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Tables</a></li>
              <li class="active">Data tables</li>
          </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-header">
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <div>
                          <!-- <a class="btn btn-primary pull-left" href="/report_company/create">
                          ثبت
                          </a> -->
                        </div>
                        <div class="col-md-12">
                        <table id="example2" class="table table-condensed table-bordered table-hover table-striped table-responsive" data-page-length='20'>
                            <thead>
                              <tr>
                                <th>ردیف</th>
                                <th>نوع ضمانت‌ ‌نامه</th>
                                <th>شماره ضمانت‌ ‌نامه</th>
                                <th>تاریخ ضمانت‌ ‌نامه</th>
                                <th>بانک</th>
                                <th>مبلغ ضمانت‌ ‌نامه</th>
                                <th>شناسه قرارداد</th>
                                <th>عنوان قرارداد</th>
                                <th>نوع خدمت</th>
                                <th>شرح خدمت</th>
                                <th>واحد واگذار کننده</th>
                                <th>طرف قرارداد</th>
                                <th>روش واگذاری</th>
                                <th>تاریخ شروع قرارداد</th>
                                <th>تاریخ پایان</th>
                                <th>مبلغ دریافتی</th>
                                <th>مبلغ دریافتی (میلیون ریال)</th>
                                <th>مبلغ پرداختی</th>
                                <th>مبلغ پرداختی (میلیون ریال)</th>
                                <th>نوع قرارداد</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($warranties as $i=>$protocol)
                              <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $protocol->warranty_type }}</td>
                                <td>{{ $protocol->warranty_number }}</td>
                                <td>{{ $protocol->expire_date }}</td>
                                <td>{{ $protocol->warranty_bank }}</td>
                                <td>{{ $protocol->warranty_amount }}</td>
                                <td>{{ $protocol->protocol->id }}</td>
                                <td>{{ $protocol->protocol->title }}</td>
                                <td>{{ ($protocol->protocol->service)?$protocol->protocol->service->name:'' }}</td>
                                <td>{{ ($protocol->protocol->service_desc)?$protocol->protocol->service_desc->name:'' }}</td>
                                <td>{{ ($protocol->protocol->giving_unit)?$protocol->protocol->giving_unit->name:'' }}</td>
                                <td>{{ ($protocol->protocol->contractor)?$protocol->protocol->contractor->name:'' }}</td>
                                <td>{{ ($protocol->protocol->winner_select_way)?$protocol->protocol->winner_select_way->name:'' }}</td>
                                <td>{{ $protocol->protocol->start_date }}</td>
                                <td>{{ $protocol->protocol->end_date }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ ($protocol->protocol->type)?$protocol->protocol->type->name:'' }}</td>
                              </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                      </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection

@section('alerts')
  @foreach($msgs as $msg)
  <div class="alert alert-{{ $msg['type'] }} alert-dismissable" style="position: fixed;bottom: 10px;left: 10px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>	
          <i class="icon fa fa-{{ $msg['icon'] }}"></i>
      </h4>
      {{ $msg['msg'] }}
  </div>
  @endforeach
@endsection

@section('extra_script')
<!-- Select2 -->
<script src="/admin/plugins/select2/select2.min.js"></script>
<!-- DataTables -->
<script src="/admin/plugins/datatables-1.10.19/media/js/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-1.10.19/media/js/dataTables.bootstrap.min.js"></script>
<script>
  // $('#example2').DataTable({
      // "paging": true,
      // "lengthChange": false,
      // "searching": false,
      // "ordering": true,
      // "info": true,
      // "autoWidth": false,
  //     "responsive": true
  // });
  $(".btn-delete").click(function(event) {
    if(!confirm('آیا حذف انجام شود؟')){
      event.preventDefault();
    }
  });
  $(".selecttwo").select2();
  setTimeout(() => {
    $("a.sidebar-toggle").click();
  }, 1000);
</script>
@endsection