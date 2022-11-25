@extends('HeThong.main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
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
                        <h3 class="card-label text-uppercase">Tổng hợp dữ liệu</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="2%"> Năm thu thập </th>
                                <th width="15%">Nội dung</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $th->nam }}</td>
                                    <td> {{ $th->tieude }}</td>
                                    <td>
                                        <a title="In tổng hợp"
                                        href="{{'/cungld/danh_sach/tinh/intonghop_tinh?matb='.$th->matb}}"
                                        class="btn btn-sm btn-clean btn-icon"  target="_blank">
                                        <i class="icon-lg la flaticon2-print text-dark"></i>
                                        </a>
                                        <a title="Tổng hợp danh sách"
                                            href="{{ '/cungld/danh_sach/tinh/tong_hop?matb=' . $th->matb .'&nam='.$th->nam}}"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                        </a>
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
                        <h4 id="modal-header-primary-label" class="modal-title">Gửi danh sách</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    {{-- <div class="modal-body">
                        <div class="form-horizontal">
                            <input type="hidden" name="id_thongbao">
                        </div>
                    </div> --}}
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
        <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th">
            @csrf
            <div id="lydo-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
                aria-hidden="true">
                <div class="modal-dialog modal-xs">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Thông tin lý do trả lại dữ liệu</h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                        </div>
                        <div class="modal-body">
                                <textarea name="lydo" id="lydo" cols=""  rows="3" class="col-md-12"></textarea>
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

    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý tổng hợp danh sách</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <label class="control-label">Thông báo thu thập</label>
                            <select class="form-control select2me" name="matb" id="matb">
                                {{-- @foreach ($model_cungld as $tb)
                                    <option value="{{ $tb->matb }}">{{ $tb->tieude }}</option>
                                @endforeach --}}
                            </select>
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
    <script>
        function add() {
            var url = '/cungld/danh_sach/store'
            $('#frm_modify').attr('action', url);
        }

        function sendData(matb) {
            var url = '/cungld/danh_sach/huyen/send?matb=' + matb;
            $('#frm_modify_th').attr('action', url);
        }

        function lydo(id)
        {
            var url='/cungld/danh_sach/huyen/lydo/'+id;

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // $.ajax({
            //     url: url,
            //     type: 'GET',
            //     data: {
            //         _token: CSRF_TOKEN,
            //         id: id
            //     },
            //     dataType: 'JSON',
            //     success: function(data) {
            //         console.log(data);
            //         $('#lydo').val(data.trangthai);
            //     },
            //     error: function(message) {
            //         toastr.error(message, 'Lỗi!');
            //     }
            // });
        }
    </script>
@endsection
