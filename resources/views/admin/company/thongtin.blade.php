@extends('HeThong.main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}">
    </script>

    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            // TableManaged.init();
        });
    </script>
@stop
@section('content')
    @if ($errors->has('import_file'))
        <div class="flash-message text-center">
            <p class="alert alert-danger ">{{ $errors->first('import_file') }}</p>
        </div>
    @endif

    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Thông tin doanh nghiệp</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/doanh_nghiep/cap_nhat/'.$model->id.'?edit=1' }}" class="btn btn-sm btn-success mr-2"
                            title="Thêm mới tài khoản">Chỉnh sửa</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <tr>
                            <td>Mã số doanh nghiệp</td>
                            <td>{{$model->masodn}}</td>
                        </tr>
                        <tr>
                            <td>Tên doanh nghiệp</td>
                            <td>{{$model->name}}</td>
                        </tr>
                        <tr>
                            <td>Mã số DKKD</td>
                            <td>{{$model->dkkd}}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>{{$model->phone}}</td>
                        </tr>
                        <tr>
                            <td>Fax</td>
                            <td>{{$model->fax}}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>{{$model->website}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$model->email}}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>{{$model->adress}}</td>
                        </tr>
                        <tr>
                            <td>Khu công nghiệp</td>
                            <td>{{$model->khucn!='0'??''}}</td>
                        </tr>
                        <tr>
                            <td>Loại hình doanh nghiệp</td>
                            <td>{{$model->loaihinh}}</td>
                        </tr>
                        <tr>
                            <td>Ngành nghề</td>
                            <td>{{$model->nganhnghe}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
    @include('includes.delete')
@endsection