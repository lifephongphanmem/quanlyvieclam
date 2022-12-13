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
                        <h3 class="card-label text-uppercase">Thông tin cung lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        @if (chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi'))
                            <button onclick="add()" class="btn btn-sm btn-success mr-2" title="Thêm mới tổng hợp"
                                data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i>Thêm mới</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="2%"> Năm thu thập </th>
                                <th width="15%">Nội dung</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $th->nam }}</td>
                                    <td class="text-left"> {{ $th->noidung }}</td>
                                    <td>
                                        {{-- <a title="Sửa thông tin" href="" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </a> --}}
                                        @if (chkPhanQuyen('tonghopcunglaodongxa', 'danhsach'))
                                            <a title="Tổng hợp danh sách"
                                                href="{{ '/cungld/danh_sach/don_vi/tonghop?math=' . $th->math }}"
                                                class="btn btn-sm btn-clean btn-icon" >
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                            </a>

                                            {{-- <a title="In tổng hợp"
                                            href="{{ '/cungld/danh_sach/don_vi/chi_tiet/' . $th->math }}"
                                            class="btn btn-sm btn-clean btn-icon" target="_blank">
                                            <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                        </a> --}}
                                        @endif
                                        @if (chkPhanQuyen('tonghopcunglaodongxa', 'hoanthanh'))
                                            @if ($th->trangthai == 'CHUAGUI' || $th->trangthai == 'TRALAI')
                                                <button type="button" onclick="sendData({{ $th->id }})"
                                                    title="Gửi danh sach" data-target="#modify-modal-th" data-toggle="modal"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="fas fa-share-square text-success"></i>
                                                </button>
                                            @else
                                                <button type="button" onclick="sendData({{ $th->id }})"
                                                    title="Gửi danh sách" data-target="#modify-modal-th" data-toggle="modal"
                                                    class="btn btn-sm btn-clean btn-icon" disabled>
                                                    <i class="fas fa-share-square text-dark"></i>
                                                </button>
                                            @endif

                                            {{-- <button type="button" onclick="tralai({{ $th->id }})"
                                            title="Trả lại" data-target="#modify-modal-tralai" data-toggle="modal"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="fas fa-share-square text-success"></i>
                                        </button> --}}
                                            @if ($th->trangthai == 'TRALAI')
                                                <button type="button" onclick="lydo({{ $th->id }})"
                                                    title="Lý do trả lại" data-target="#lydo-modal" data-toggle="modal"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="fas fa-question-circle text-primary"></i>
                                                </button>
                                            @endif
                                        @endif
                                        @if (chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi'))
                                            <button title="Xóa thông tin" type="button"
                                                onclick="cfDel('{{ '/cungld/danh_sach/don_vi/delete/' . $th->id }}')"
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

    <!-- modal gửi thông báo -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th">
        @csrf
        <div id="modify-modal-th" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý gửi dữ liệu</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Số liệu tổng hợp khi gửi đi sẽ không thể chỉnh sửa. Bạn hãy kiểm tra kỹ số liệu trước
                                    khi gửi.</b></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- modal gửi thông báo -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th">
        @csrf
        <div id="modify-modal-tralai" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Trả lại danh sách</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <textarea name="tralai" id="tralai" cols="" rows="3" class="col-md-12"></textarea>
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

    <!-- modal lý do -->
    <div id="lydo-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin lý do trả lại dữ liệu</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                </div>
                <div class="modal-body">
                    <label class="lable-control">Lý do</label>
                    <textarea name="" id="lydo" cols="" rows="3" class="col-md-12"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Đóng</button>
                </div>
            </div>
        </div>
    </div>

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
                            {!! Form::select('nam', getNam(), $nam, ['id' => 'nam', 'class' => 'form-control']) !!}
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
        function add() {
            var url = '/cungld/danh_sach/don_vi/store'
            $('#frm_modify').attr('action', url);
        }

        function sendData(id) {
            var url = '/cungld/danh_sach/don_vi/send/' + id;

            $('#frm_modify_th').attr('action', url);
        }

        function intonghop(math) {
            var url = '/cungld/danh_sach/don_vi/chi_tiet/' + math;
            window.location.href = url;
        }

        function lydo(id) {
            var url = '/cungld/danh_sach/don_vi/lydo/' + id;

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#lydo').val(data.lydo);
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }
    </script>
@endsection
