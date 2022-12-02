@extends('main')
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
                        <h3 class="card-label text-uppercase">Thông báo tình hình sử dụng lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        @if (chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi'))
                        <button onclick="add()" class="btn btn-sm btn-success mr-2" title="Thêm mới thông báo"
                            data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i>Thêm mới</button>
                            @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="2%">Năm</th>
                                <th width="10%" >Tiêu đề </th>
                                <th width="15%" >Nội dung</th>
                                <th width="5%">Hạn nộp</th>
                                <th width="5%">Ngày gửi</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tb)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td name="nam">{{$tb->nam }}</td>
                                    <td name="tieude" class="text-left">{{ $tb->tieude == 0?'Báo cáo tình hình sử dụng lao động định kỳ 6 tháng':'Báo cáo tình hình sử dụng lao động hằng năm' }} </td>
                                    <td name="noidung"> {{ $tb->noidung }}</td>
                                    <td> {{ $tb->hannop.'-'.$tb->nam }}</td>
                                    <td class="{{ $tb->ngaygui == 0 ? 'text-danger' : '' }}">
                                        {{ $tb->ngaygui == null ? 'Chưa gửi' : \Carbon\Carbon::parse($tb->ngaygui)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        @if (chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi'))
                                        <button type="button" onclick="chinhsua({{$tb->id}})" title="Sửa thông tin" href="" class="btn btn-sm btn-clean btn-icon" data-target="#modify-modal-edit" data-toggle="modal">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        @if ($tb->ngaygui == null)
                                            <button type="button" onclick="sendData({{ $tb->id }})"
                                                title="Gửi danh sach" data-target="#modify-modal-send" data-toggle="modal"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="fas fa-share-square text-success"></i>
                                            </button>
                                        @endif

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/tinhhinhsudungld/thongbao/delete/' . $tb->id }}')"
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
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_send">
        @csrf
        <div id="modify-modal-send" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Gửi thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="col-lg-8">
                                <label class="control-label">Chọn công ty</label>
                                <select id="" class="form-control select2me" name="masodn[]" multiple=true>
                                    <option value="all" selected>Chọn tất cả</option>
                                    @foreach ($model_cty as $ct)
                                        <option value="{{ $ct->masodn }}">{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="id_thongbao">
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
    <!-- modal add -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Tạo thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-8">
                                <label class="control-label">Tiêu đề</label>
                                <select id="tieude" class="form-control select2me" name="tieude">
                                    <option value="0">Báo cáo tình hình sử dụng lao động định kỳ 6 tháng</option>
                                    <option value="1">Báo cáo tình hình sử dụng lao động hằng năm</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-lable">Năm</label>
                                <select name="nam" class="form-control " id="nam">
                                    <option value="2021">2021</option>
                                    <option value="2022" selected>2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="control-label">Nội dung</label>
                            <textarea name="noidung" rows="5" class="form-control" id='noidung'></textarea>
                        </div>
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
<!-- Model edit -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_edit">
        @csrf
        <div id="modify-modal-edit" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Tạo thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="col-lg-8">
                                <label class="control-label">Tiêu đề</label>
                                <select id="tieude_edit" class="form-control" name="tieude">
                                    <option value="0">Báo cáo tình hình sử dụng lao động định kỳ 6 tháng</option>
                                    <option value="1">Báo cáo tình hình sử dụng lao động hằng năm</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="control-lable">Năm</label>
                                <select name="nam" class="form-control " id="nam_edit">
                                    <option value="2021">2021</option>
                                    <option value="2022" selected>2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label class="control-label">Nội dung</label>
                            <textarea name="noidung" rows="5" class="form-control" id='noidung_edit'></textarea>
                        </div>
                        
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
            var url = '/tinhhinhsudungld/thongbao/store'
            $('#frm_modify').attr('action', url);
        }

        function sendData(id) {
            var url = '/tinhhinhsudungld/thongbao/send/' + id;

            $('#frm_modify_send').attr('action', url);
        }

        function chinhsua(id){
            var  url = '/tinhhinhsudungld/thongbao/edit/' + id;
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

                    $('#noidung_edit').html(data.noidung);
                    $('#nam_edit option[value=' + data.nam + ' ]').attr('selected', 'selected');
                    $('#tieude_edit option[value=' + data.tieude + ' ]').attr('selected', 'selected');

                    var  url = '/tinhhinhsudungld/thongbao/update/' + id;
                    $("#frm_modify_edit").attr("action", url);
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            
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
