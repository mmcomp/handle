@extends('layouts.admin')

@section('extra_css')
<!-- DataTables -->
<link rel="stylesheet" href="/admin/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url('/admin/dist/img/mashhad.png');">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1 style="background-color: #ffffff;padding: 10px;">
            گزارش مقایسه ای
              <small></small>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-header">
                        <form method="post">
                          @csrf
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="name">واحد</label>
                                    <select class="form-control" id="units_id" name="units_id[]" multiple >
                                      <option value="">همه</option>
                                    @foreach($units as $unit)
                                      @if(in_array($unit->id, $units_ids))
                                      <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                                      @else
                                      <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                      @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="name">خدمت</label>
                                    <select class="form-control" id="services_id" name="services_id">
                                    @foreach($services as $service)
                                      @if($services_id == $service->id)
                                      <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                                      @else
                                      <option value="{{ $service->id }}">{{ $service->name }}</option>
                                      @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                              <button class="btn btn-success pull-left">
                              نمایش
                              </button>
                            </div>
                          </div>
                        </form>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                          <table id="example2" class="table table-bordered table-hover table-striped" data-page-length='20'>
                              <thead>
                                <tr>
                                    <th></th>
                                    @if(count($results)>0)
                                    @foreach($results['units'] as $unit)
                                    <th>
                                      {{ $unit->name }}
                                    </th>
                                    @endforeach
                                    @endif
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>عنوان قرارداد</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    @if(count($results['protocols'][$unit->id])>0)
                                    {{ $results['protocols'][$unit->id][0]->title }}
                                    @endif
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                                <tr>
                                  <td>شماره قرارداد</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    @if(count($results['protocols'][$unit->id])>0)
                                    {{ $results['protocols'][$unit->id][0]->number }}
                                    @endif
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                                <tr>
                                  <td>نام پیمانکار</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    @if(count($results['protocols'][$unit->id])>0)
                                    {{ ($results['protocols'][$unit->id][0]->contractor)? $results['protocols'][$unit->id][0]->contractor->name:''}}
                                    @endif
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                                <tr>
                                  <td>مبلغ کل دریافتی از طرف قرارداد</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    0
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                                <tr>
                                  <td>مبلغ کل پرداختی به طرف قرارداد</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    0
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                                <tr>
                                  <td>مدت قرارداد(روز)</td>
                                  @if(count($results)>0)
                                  @foreach($results['units'] as $unit)
                                  <td>
                                    @if(count($results['protocols'][$unit->id])>0)
                                    {{ $results['protocols'][$unit->id][0]->duration }}
                                    @endif
                                  </td>
                                  @endforeach
                                  @endif
                                </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th>#</th>
                                </tr>
                              </tfoot>
                          </table>
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
<!-- DataTables -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false
  });
  $(".btn-delete").click(function(event) {
    if(!confirm('آیا حذف انجام شود؟')){
      event.preventDefault();
    }
  });
</script>
@endsection