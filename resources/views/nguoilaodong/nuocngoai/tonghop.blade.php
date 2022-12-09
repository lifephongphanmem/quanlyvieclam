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
                        <h3 class="card-label text-uppercase">Tổng hợp dữ liệu</h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- @if (chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) --}}
                            <button onclick="tonghop()" class="btn btn-xs btn-success mr-2"
                                title="Tổng hợp danh sách" data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i>Tổng hợp</button>

                            {{-- <button class="btn btn-xs btn-success mr-2 ml-2" title="Nhận dữ liệu từ file Excel"
                                data-target="#modal-nhanexcel" data-toggle="modal">
                                <i class="fas fa-file-import">Nhận Excel</i>
                            </button>
                            <a href="{{asset('excel/maunhapnguoilaodong.xlsx')}}" class="btn btn-xs btn-success mr-2 ml-2" title="Nhận dữ liệu từ file Excel">                            
                                <i class="fa fa-file-download"></i> Tải File Excel mẫu</i>
                        </a> --}}
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="5%">Năm </th>
                                <th width="13%"> Nội dung</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key=>$ct )
                                <td>{{++$key}}</td>
                                <td>{{$ct->nam}}</td>
                                <td>{{$ct->noidung}}</td>
                                <td>
                                    <a title="In tổng hợp"
                                    href="{{'/nguoilaodong/nuoc_ngoai/InTongHop?math='.$ct->math}}"
                                    class="btn btn-sm btn-clean btn-icon" target="_blank">
                                    <i class="icon-lg la flaticon2-print text-primary"></i>
                                </a>
                                <button title="Xóa thông tin" type="button"
                                onclick="cfDel('{{'/nguoilaodong/nuoc_ngoai/XoaTongHop/'.$ct->id}}')"
                                class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                data-toggle="modal">
                                <i class="icon-lg flaticon-delete text-danger"></i></button>
                                </td>
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

    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý tổng hợp danh sách</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label class="control-label">Năm thu thập</label>
                            {!! Form::select('nam', getNam(), null, ['id' => 'nam', 'class' => 'form-control']) !!}
                        </div>
                        <div class="row form-group">
                            <label class="control-label">Nội dung</label>
                            {!! Form::text('noidung',null, ['id' => 'nam', 'class' => 'form-control']) !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" id="submit" name="submit" value="submit"
                                class="btn btn-primary">Đồng
                                ý</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <script>
        function tonghop(){
            var url='/nguoilaodong/nuoc_ngoai/tonghop'
            $('#frm_modify').attr('action', url);
        }
    </script>
@endsection
