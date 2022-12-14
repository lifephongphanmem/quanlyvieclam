@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

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
                        <h3 class="card-label text-uppercase">Danh sách người lao động nước ngoài</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                    <div class="card-toolbar">
                        @if (chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi'))

                            <a href="{{ '/nguoilaodong/nuoc_ngoai/create' }}" class="btn btn-sm btn-success mr-2"
                                title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a>
                                <button class="btn btn-sm btn-success mr-2 ml-2" title="Nhận dữ liệu từ file Excel"
                                data-target="#modal-nhanexcel" data-toggle="modal">
                                <i class="fas fa-file-import"></i>
                            </button>

                                <a href="{{ '/nguoilaodong/nuoc_ngoai/in' }}" class="btn btn-sm btn-clean mr-2"
                                title="In danh sách" target="_blank"><i
                                    class="icon-xl la flaticon2-print text-dark"></i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="15%"> Họ và tên</th>
                                <th width="10%"> Năm sinh</th>
                                <th width="13%">Quốc tịch</th>
                                <th width="5%"> Giới tính</th>
                                <th width="10%"> Số hộ chiếu</th>
                                <th width="25%"> Địa chỉ</th>
                                <th width="10%"> Vị trí</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ld)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td> {{ $ld->hoten }}</td>
                                    <td> {{ \Carbon\Carbon::parse($ld->ngaysinh)->format('d-m-Y') }}</td>
                                    <td> {{ $ld->nation }}</td>
                                    <td class="text-center"> {{ $ld->gioitinh == 'nam' || $ld->gioitinh == 'Nam' ? 'Nam' : 'Nữ' }}</td>
                                    <td> {{ $ld->cmnd }}</td>
                                    <td> {{ $ld->address }} {{ $ld->xa }} {{ $ld->huyen }}
                                        {{ $ld->tinh }}</td>
                                    <td> {{ $ld->vitri }}</td>
                                    <td>
                                        @if (chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi'))
                                            <a title="Sửa thông tin" href="{{ '/nguoilaodong/nuoc_ngoai/edit/' . $ld->id }}"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                            </a>
                                            <button title="Xóa thông tin" type="button"
                                                onclick="cfDel('{{ '/nguoilaodong/nuoc_ngoai/delete/' . $ld->id }}')"
                                                class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="icon-lg flaticon-delete text-danger"></i></button>
                                        @endif
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

    <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form action="{{ '/nguoilaodong/nuoc_ngoai/nhanexcel' }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Nhận danh sách người lao động từ file Excel</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="file" name="import_file" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <p class="float-left mr-3">Tải file excel mẫu </p><a href="{{asset('excel/maunhapnguoilaodongnuocngoai.xlsx')}}">tại đây</a>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </form>
    </div>
@endsection
