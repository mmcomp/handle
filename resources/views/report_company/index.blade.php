@extends('layouts.admin')

@php
$status = [
  'registered'=>'ثبت شده',
  'paying'=>'درحال اجرا',
  'payed'=>'تسویه شده',
  'finish'=>'اتمام',
];
@endphp

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
            لیست پیمانکاران
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
                          <!-- <h3 class="box-title">پیمانکاران</h3> -->
                          <div>
                            <form method="post">
                              @csrf
                              <div class="row">
                                <div class="col-md-6">
                                  <label>
                                    نام شرکت
                                  </label>
                                  <input name="name" placeholder="نام" class="form-control" value="{{ isset($req['name'])?$req['name']:'' }}" />
                                </div>
                                <div class="col-md-6">
                                  <label>
                                    نام مدیر
                                  </label>
                                  <input name="ceo_fname" placeholder="نام" class="form-control" value="{{ isset($req['ceo_fname'])?$req['ceo_fname']:'' }}" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <label>
                                    نام خانوادگی مدیر
                                  </label>
                                  <input name="ceo_lname" placeholder="نام" class="form-control" value="{{ isset($req['ceo_lname'])?$req['ceo_lname']:'' }}" />
                                </div>
                                <div class="col-md-6">
                                  <label>
                                    شخصیت طرف قرارداد
                                  </label>
                                  <select name="ownership" placeholder="شخصیت" class="form-control selecttwo" >
                                    <option value="">همه</option>
                                  @foreach($ownerships as $i=>$ownership)
                                    @if(isset($req['ownership']) && $req['ownership']==$ownership->id)
                                    <option selected value="{{ $ownership->id }}">{{ $ownership->name }}</option>
                                    @else
                                    <option value="{{ $ownership->id }}">{{ $ownership->name }}</option>
                                    @endif
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <label>
                                    نوع فعالیت
                                  </label>
                                  <select name="service" placeholder="قعالیت" class="form-control selecttwo" >
                                    <option value="">همه</option>
                                  @foreach($services as $i=>$service)
                                    @if(isset($req['service']) && $req['service']==$service->id)
                                    <option selected value="{{ $service->id }}">{{ $service->name }}</option>
                                    @else
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endif
                                  @endforeach
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label>
                                    استان
                                  </label>
                                  <select name="province" placeholder="استان" class="form-control selecttwo" >
                                    <option value="">همه</option>
                                  @foreach($provinces as $i=>$province)
                                    @if(isset($req['province']) && $req['province']==$province->id)
                                    <option selected value="{{ $province->id }}">{{ $province->name }}</option>
                                    @else
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endif
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <label>
                                    شهر
                                  </label>
                                  <select name="city" placeholder="شهر" class="form-control selecttwo" >
                                    <option value="">همه</option>
                                  @foreach($cities as $i=>$city)
                                    @if(isset($req['city']) && $req['city']==$city->id)
                                    <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                    @else
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endif
                                  @endforeach
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label>
                                    تاریخ شروع قرارداد
                                  </label>
                                  <input name="start_date" placeholder="شروع" class="form-control pdate" value="{{ isset($req['start_date'])?$req['start_date']:'' }}" />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <label>
                                    تاریخ پایان قرارداد
                                  </label>
                                  <input name="end_date" placeholder="پایان" class="form-control pdate" value="{{ isset($req['end_date'])?$req['end_date']:'' }}" />
                                </div>
                                <div class="col-md-6" style="padding-top: 30px;">
                                  <label>
                                    دارای قرارداد فعال
                                  </label>
                                  <input type="checkbox" name="has_protocol" value="has_protocol" {{ isset($req['has_protocol'])?'checked':'' }} />
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-md-push-6" style="margin-top: 10px;">
                                  <button class="btn btn-success">
                                  فیلتر
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
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
                                <th>ضخصیت</th>
                                <th>نوع فعالیت</th>
                                <th>نام شرکت</th>
                                <th>نام مدیرعامل</th>
                                <th>نام خانوادگی مدیرعامل</th>
                                <th>کدملی</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>تلفن</th>
                                <th>موبایل</th>
                                <th>عنوان قرارداد</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>مبلغ پرداختی(میلیون ریال)</th>
                                <th>مبلغ دریافتی(میلیون ریال)</th>
                                <th>وضعیت قرارداد</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $i=>$company)
                              <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ ($company->ownership)?$company->ownership->name:'' }}</td>
                                <td>{{ ($company->service)?$company->service->name:'' }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ ($company->ceo)?$company->ceo->fname:'' }}</td>
                                <td>{{ ($company->ceo)?$company->ceo->lname:'' }}</td>
                                <td>{{ $company->national_id }}</td>
                                <td>{{ ($company->city && $company->city->province)?$company->city->province->name:'' }}</td>
                                <td>{{ ($company->city)?$company->city->name:'' }}</td>
                                <td>{{ $company->tells }}</td>
                                <td>{{ $company->mobile }}</td>
                                @if(count($company->protocols)>0)
                                <td>{{ $company->protocols[0]->title }}</td>
                                <td>{{ $company->protocols[0]->start_date }}</td>
                                <td>{{ $company->protocols[0]->end_date }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ 0 }}</td>
                                <td>{{ $status[$company->protocols[0]->status] }}</td>
                                @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endif
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