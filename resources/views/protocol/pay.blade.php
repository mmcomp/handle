@extends('layouts.admin')

@section('extra_css')
<style>
  #list_simple .row {
    border: solid 1px #eaeaea;
    padding: 10px;
  }
</style>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          ثبت پرداخت قرارداد
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">کاردکس قرارداد</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form method="post" id="main-form" enctype="multipart/form-data">
                  @csrf
                  @if($data['type']['calc_type']=='simple')
                  <div id="simple">                      
                    <div class="row">
                      <div class="col-md-6">
                        <label>
                        مبلغ
                        </label>
                        <input name="total" class="form-control" placeholder="مبلغ" />
                      </div>
                      <div class="col-md-6">
                        <label>
                        واحد ارزی
                        </label>
                        <select name="currency" class="form-control">
                          <option value="rial">ریال</option>
                          <option value="dollar">دلار</option>
                          <option value="euro">یورو</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  @elseif($data['type']['calc_type']=='list_simple')
                  <div id="list_simple">
                    @foreach($data['list_simples'] as $i=>$item)
                    <div class="row">
                      <div class="col-md-6">
                        <label>
                        {{ $item['item_name'] }}
                        </label>
                      </div>
                      <div class="col-md-6">
                        <input name="item_id_{{ $item['id'] }}" class="form-control" placeholder="تعداد" value="" />
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @endif
                  <button class="btn btn-danger pull-left" style="margin-top: 10px;">
                  ثبت
                  </button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div> 
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
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
  });
  $(document).ready(function() {
  });
</script>
@endsection