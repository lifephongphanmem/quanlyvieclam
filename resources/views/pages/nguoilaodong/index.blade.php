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
            TableManaged.init();
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
                        <h3 class="card-label text-uppercase">Danh sách người lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/nguoilaodong/them_moi' }}" class="btn btn-sm btn-success mr-2"
                            title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="15%"> Họ và tên</th>
                                <th width="13%"> Năm sinh</th>
                                <th width="10%"> Giới tính</th>
                                <th width="10%"> CMND/CCCD</th>
                                <th width="30%"> Địa chỉ</th>
                                <th width="10%"> Vị trí</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ld)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td> {{ $ld->hoten }}</td>
                                    <td> {{ \Carbon\Carbon::parse($ld->ngaysinh)->format('d/m/Y') }}</td>
                                    <td> {{ $ld->gioitinh == 'nam' || $ld->gioitinh == 'Nam' ? 'Nam' : 'Nữ' }}</td>
                                    <td> {{ $ld->cmnd }}</td>
                                    <td> {{ $ld->address }} {{ $ld->xa }} {{ $ld->huyen }}
                                        {{ $ld->tinh }}</td>
                                    <td> {{ $ld->vitri }}</td>
                                    <td>
                                        <a title="Sửa thông tin" href="{{'/nguoilaodong/edit/'.$ld->id}}" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </a>
                                        <button title="Xóa thông tin" type="button" onclick="cfDel('{{'/nguoilaodong/delete/'.$ld->id}}')" class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="icon-lg flaticon-delete text-danger"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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
