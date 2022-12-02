@extends('HeThong.main')2x
@section('custom-style')
    <link href="{{url('assets/global/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    {{-- <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/> --}}
@stop
@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js') }}"></script>

    <script type="text/javascript" src="{{url('assets/admin/pages/scripts/form-wizard.js')}}"></script>

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            FormWizard.init();
            TableManaged.init();
            // $('.select2me').select2();
        });
    </script>
    {{-- @include('includes.script.scripts') --}}
@stop

@section('content')
<div class="row">
    <div class="col-md-12" style="background-color: #F3F6F9">
        <div class="portlet box blue" id="form_wizard_1" >
            <div class="portlet-title">
                <div class="caption text-uppercase">
                    THÊM MỚI THÔNG TIN NGƯỜI LAO ĐỘNG
                </div>
                <div class="tools hidden-xs">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>

            <div class="portlet-body form" id="form_wizard">
                {{-- {!! Form::open(['url'=>'/nghiep_vu/ho_so/store','method'=>'post' , 'files'=>true, 'id' => 'create_hscb','enctype'=>'multipart/form-data']) !!} --}}
                <form action="{{'/nguoilaodong/update/'.$model->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li><a href="#tab1" data-toggle="tab" class="step">
                                    <p class="description"><i class="glyphicon glyphicon-user"></i> Thông tin cơ bản</p></a>
                            </li>
                            <li><a href="#tab2" data-toggle="tab" class="step">
                                    <p class="description"><i class="glyphicon glyphicon-paperclip"></i> Khác</p></a>
                            </li>
                        </ul>

                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success">
                            </div>
                        </div>

                        <div class="tab-content">
                            @include('pages.nguoilaodong.include.coban')
                            @include('pages.nguoilaodong.include.khac')
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-12 text-center">
                                <button type="button" name="previous" value="Previous" class="btn btn-info button-previous">
                                    <i class="fa fa-arrow-circle-o-left mrx"></i>Quay lại
                                </button>

                                <button id="btnnext" type="button" name="next" value="Next" class="btn btn-info button-next mlm">
                                    Tiếp theo<i class="fa fa-arrow-circle-o-right mlx"></i></button>

                                <button type="submit" class="btn btn-success">Tạo hồ sơ</button>

                                <a href="{{url('/nguoilaodong')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
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