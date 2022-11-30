@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>


    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
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
                        <h3 class="card-label text-uppercase">Danh sách doanh nghiệp</h3>
                    </div>
                    <div class="card-toolbar">
                       
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/doanh_nghiep/in' }}" class="btn btn-sm btn-clean btn-icon mr-2"
                        title="In danh sách" target="_blank"><i class="icon-lg la flaticon2-print text-dark"></i></a>
                        <a href="{{ '/doanh_nghiep/them_moi' }}" class="btn btn-xs btn-icon btn-success mr-2"
                            title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="10%">Tên doanh nghiệp</th>
                                <th width="5%">Mã số doanh nghiệp</th>
                                <th width="5%">Mã số kinh doanh</th>
                                <th width="15%">Địa chỉ</th>
                                <th width="10%">Khu công nghiệp</th>
                                <th width="5%">Tình trạng hoạt động</th>
                                <th width="5%">Loại hình doanh nghiệp</th>
                                <th width="5%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $dn)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td> {{ $dn->name }}</td>
                                    <td> {{ $dn->masodn }}</td>
                                    <td> {{ $dn->dkkd}}</td>
                                    <td> {{ $dn->adress }}</td>
                                    <td>
                                        @foreach ($kcn as $cn )
                                            {{$cn->id==$dn->khucn?$cn->name:''}}
                                        @endforeach
                                    </td>
                                    <td> {{ $dn->public==1?'Hoạt động':'Dừng hoạt động' }}</td>
                                    <td>
                                        @foreach ($loaihinh as $ldn )
                                            {{$ldn->id==$dn->loaihinh?$ldn->name:''}}
                                        @endforeach
                                        </td>
                                    <td>
                                        <a title="Sửa thông tin" href="{{'/doanh_nghiep/cap_nhat/'.$dn->id}}" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </a>
                                        <a title="Thông tin công ty" href="{{'/doanh_nghiep/in/'.$dn->id}}" class="btn btn-sm btn-clean btn-icon" target="_blank">
                                            <i class="icon-lg la flaticon2-print text-dark"></i>
                                        </a>
                                        <button title="Xóa thông tin" type="button" onclick="cfDel('{{'/doanh_nghiep/delete/'.$dn->id}}')" class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm" data-toggle="modal">
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
