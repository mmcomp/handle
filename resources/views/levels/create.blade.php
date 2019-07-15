@extends('layouts.admin')

@section('extra_css')

@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
            @if($level->id)
            ویرایش 
            @else
            ثبت
            @endif
            سطح شهروندی
          </h1>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">سطح</h3>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">نام</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="نام" value="{{ ($level && $level->name)?$level->name:'' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="max_exp">حداکثر امتیاز تجربه</label>
                                        <input type="text" class="form-control" id="max_exp" name="max_exp" placeholder="حداکثر امتیاز تجربه" value="{{ ($level && $level->max_exp)?$level->max_exp:'0' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="resident_property_fields_id">امتیاز اختصاصی</label>
                                        <select class="form-control" id="resident_property_fields_id" name="resident_property_fields_id">
                                            <option disabled>امتیاز اختصاصی</option>
                                            <option value="-1">هیچکدام</option>
                                            @foreach($residentPropertyFields as $residentPropertyField)
                                            <option value="{{ $residentPropertyField->id }}" {{ ($residentPropertyField->id==$level->resident_property_fields_id)?'selected':'' }}>{{ $residentPropertyField->field_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="min_exp">حداقل امتیاز تجربه</label>
                                        <input type="text" class="form-control" id="min_exp" name="min_exp" placeholder="حداقل امتیاز تجربه" value="{{ ($level && $level->min_exp)?$level->min_exp:'0' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="coin">سکه</label>
                                        <input type="text" class="form-control" id="coin" name="coin" placeholder="سکه" value="{{ ($level && $level->coin)?$level->coin:'0' }}">
                                    </div>   
                                    
                                    <div class="form-group">
                                        <label for="resident_property_fields_value">مقدار امتیاز اختصاصی</label>
                                        <input type="text" class="form-control" id="resident_property_fields_value" name="resident_property_fields_value" placeholder="مقدار امتیاز اختصاصی" value="{{ ($level && $level->resident_property_fields_value)?$level->resident_property_fields_value:'0' }}">
                                    </div>                                
                                </div>
                                <div class="col-xs-12">
                                    <button class="btn btn-primary pull-left">
                                    ذخیره
                                    </button>
                                </div>
                            </div>
                        </form>
                      </div><!-- /.box-body -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection

@section('extra_script')
<script>

</script>
@endsection