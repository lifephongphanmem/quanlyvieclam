@extends('main')
@section('custom-style')
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    {{-- <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/> --}}
@stop
@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    {{-- <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js') }}"></script> --}}

    <script type="text/javascript" src="{{url('assets/admin/pages/scripts/form-wizard.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            FormWizard.init();
            $('.select2me').select2(); 
        });
    </script>
    {{-- @include('includes.script.scripts') --}}
@stop

@section('content')
<div class="row">
    <div class="col-md-12" style="background-color: #F3F6F9">
        <div class="portlet box blue" id="form_wizard_1" >
            <div class="portlet-title mb-5 mt-5">
                <div class="caption text-uppercase">
                    THÔNG TIN DOANH NGHIỆP
                </div>
                <div class="tools hidden-xs">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>

            <div class="portlet-body form" id="form_wizard">
                {{-- {!! Form::open(['url'=>'/nghiep_vu/ho_so/store','method'=>'post' , 'files'=>true, 'id' => 'create_hscb','enctype'=>'multipart/form-data']) !!} --}}
                <form action="{{'/doanh_nghiep/update/'.$model->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mã số doanh nghiệp <span class="require">*</span></label>
                                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                                    <input type="text" name="masodn" class="form-control" value="{{isset($model)?$model->masodn:''}}" required>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tên doanh nghiệp</label>
                                    <input type="text" name="name" class="form-control" value="{{isset($model)?$model->name:''}}" required>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mã số kinh doanh</label>
                                    <input type="text" name="dkkd" class="form-control" value="{{isset($model)?$model->dkkd:''}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tình trạng hoạt động</label>
                                    <select class="form-control input-sm m-bot5" name="public">
                                        <option value='1' {{$model->public==1?'selected':''}}>Hoạt động</option>
                                        <option value='0'{{$model->public==0?'selected':''}}>Dừng</option>
                                    </select>
                                </div>
                            </div>
                
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại <span class="require">*</span></label>
                                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                                    <input type="text" name="phone" class="form-control" value="{{isset($model)?$model->phone:''}}">
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Fax</label>
                                    <input type="text" name="fax" class="form-control" value="{{isset($model)?$model->fax:''}}">
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Website</label>
                                    <input type="text" name="website" class="form-control" value="{{isset($model)?$model->website:''}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{isset($model)?$model->email:''}}">
                                </div>
                            </div>                
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tỉnh<span class="require">*</span></label>
                                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                                    <input type="text" name="tinh" class="form-control" value="Quảng Bình" readonly>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Huyện/Thị xã/Thành phố</label>
                                    <?php $huyen=$dmhanhchinh->wherein('level',['Thành phố','Huyện','Thị xã'])?>
                                    <select name="huyen" class="form-control select2me" id="">
                                    @foreach ($huyen as $h )
                                        <option value="{{$h->id}}"{{$model->huyen==$h->id?'selected':''}}>{{$h->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Xã/Phường</label>
                                    <select name="xa" class="form-control select2me" id="">
                                    <?php $xa=$dmhanhchinh->wherein('level',['Phường','Xã','Thị trấn'])?>
                                    @foreach ($xa as $x )
                                    <option value="{{$x->id}}" {{$model->xa==$x->id?'selected':''}}>{{$x->name}}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Khu vực</label>
                                    <select class="form-control input-sm m-bot5" name="khuvuc">
                                        <option value='1' {{$model->khuvuc==1?'selected':''}}>Thành thị</option>
                                        <option value='0'  {{$model->khuvuc==0?'selected':''}}>Nông thôn</option>
                                    </select>
                                </div>
                            </div>                
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ</label>
                                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                                    <input type="text" name="adress" class="form-control" value="{{isset($model)?$model->adress:''}}">
                                    
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Khu công nghiệp</label>
                                    <select class="form-control input-sm m-bot5" name="khucn">
                                        <option value="">-- Chọn khu công nghiệp ---</option>
                                        @foreach ($kcn as $cn )
                                            <option value="{{$cn->id}}" {{$model->khucn==$cn->id?'selected':''}}>{{$cn->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Loại hình doanh nghiệp</label>
                                    <select class="form-control input-sm m-bot5" name="loaihinh">
                                        <option value="">-- Chọn loại hình doanh nghiệp ---</option>
                                        @foreach ($loaihinh as $dn )
                                            <option value="{{$dn->id}}" {{$model->loaihinh==$dn->id?'selected':''}}>{{$dn->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ngành nghề</label>
                                    <select class="form-control input-sm m-bot5" name="nganhnghe">
                                        <option value="">-- Chọn loại ngành nghề ---</option>
                                        @foreach ($nganhnghe as $dn )
                                            <option value="{{$dn->id}}" {{$model->nganhnghe==$dn->id?'selected':''}}>{{$dn->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>                
                        </div>
                    </div>
                    <input type="hidden" name='edit' value="{{$input}}">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-12 text-center">

                                <button type="submit" class="btn btn-success">Hoàn thành</button>

                                <a href="{{url($url)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                            </div>
                        </div>
                    </div>
                </form>
                    {{-- {!! Form::close() !!} --}}
            </div>
        </div>
    </div>
</div>
@stop
