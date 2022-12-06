@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
@stop
@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}">
    </script>
    <script src="/assets/js/pages/select2.js"></script>
    <script type="text/javascript" src="{{ url('assets/admin/pages/scripts/form-wizard.js') }}"></script>
@stop

@section('content')
<form action="{{'/nguoilaodong/nuoc_ngoai/store'}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tapthe">
                                    <span class="nav-icon">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <span class="nav-text">Thông tin cơ bản</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_canhan">
                                    <span class="nav-icon">
                                        <i class="far fa-user"></i>
                                    </span>
                                    <span class="nav-text">Thông tin công việc</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="kt_tapthe" role="tabpanel" aria-labelledby="kt_tapthe">

                            <div class="row" id="dskhenthuongtapthe">
                                <div class="col-md-12">
                                    @include('nguoilaodong.include.coban_nuocngoai')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_canhan" role="tabpanel" aria-labelledby="kt_canhan">
                            <div class="row" id="dskhenthuongcanhan">
                                <div class="col-md-12">
                                    @include('nguoilaodong.include.khac_nuocngoai')
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade" id="kt_detai" role="tabpanel" aria-labelledby="kt_detai">
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row text-center">
            <div class="col-lg-12">
                <a href="{{url('/nguoilaodong/nuoc_ngoai')}}" class="btn btn-danger mr-5"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Hoàn thành</button>

            </div>
        </div>
    </div>
</form>
@stop
