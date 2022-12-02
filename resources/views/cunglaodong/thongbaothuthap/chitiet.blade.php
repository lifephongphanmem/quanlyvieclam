@extends('main')
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
                        <h3 class="card-label text-uppercase">Chi tiết thông báo</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/thongbao/store' }}" class="btn btn-sm btn-success mr-2"
                            title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="15%"> Tiêu đề</th>
                                <th width="15%"> Nội dung</th>
                                <th width="13%"> Trạng thái</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td> {{ $th->subject }}</td>
                                    <td> {{ $th->body }}</td>
                                    <td></td>
                                    <td>
                                        <a title="Gửi thông báo" href="" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la fa-share text-primary icon-2x"></i>
                                        </a>
                                        <button title="Xóa thông tin" type="button" onclick="cfDel('{{'/nguoilaodong/delete/'.$th->id}}')" class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm" data-toggle="modal">
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
