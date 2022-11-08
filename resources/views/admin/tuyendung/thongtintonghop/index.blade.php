@extends('HeThong.main')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">TỔNG HỢP THÔNG TIN NHU CẦU TUYỂN DỤNG </h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="create()" data-toggle="modal" data-target="#create_edit_modal"
                            class="btn btn-xs btn-icon btn-success mr-2" title="Thêm mới"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover ">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th width="6%">Thời điểm <br>bắt đầu</th>
                                    <th width="6%">Thời điểm <br>kết thúc</th>
                                    <th width="6%">Trạng thái</th>
                                    <th width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr class="text-center">
                                    <td>{{ ++$i }} </td>
                                    <td>{{ $item->tieude }}</td>
                                    <td>{{ $item->mota }}</td>
                                    <td class="text-center">{{ $item->thoidiemtu }}</td>
                                    <td class="text-center">{{ $item->thoidiemden }}</td>
                                    <td class="text-center">
                                        @if ($item->trangthai == 'tat')
                                            <span class="badge badge-secondary">Đang tắt</span>
                                        @endif
                                        @if ($item->trangthai == 'mo')
                                            <span class="badge badge-success ">Đang mở</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button title="Sửa" data-toggle="modal" data-target="#create_edit_modal"
                                            type="button" onclick="edit('{{ $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        <button title="Xóa" data-toggle="modal" data-target="#delete-modal-confirm"
                                            type="button"
                                            onclick="cfDel('{{ '/tuyen_dung/thong_tin_tong_hop/delete/' . $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg flaticon-delete text-danger"></i>
                                        </button>
                                        <a href="{{ '/tuyen_dung/thong_tin_tong_hop/chi_tiet?manhom='.$item->matttd }}"  class="btn btn-icon btn-clean btn-lg mb-1 position-relative" title="Danh sách">
                                            <span class="svg-icon svg-icon-xl">
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                            </span>
                                            <span class="label label-sm label-light-danger text-dark label-rounded font-weight-bolder position-absolute top-0 right-0">
                                                {{count(App\Models\thongtintuyendungct::where('manhom',$item->matttd)->where('trangthai','ht')->get())}}
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->



    <!--create Modal-->
    <div class="modal fade" id="create_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="card-label">
                        Thêm mới nhóm thông tin tổng hợp
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                {!! Form::open([
                    'url' => '/tuyen_dung/thong_tin_tong_hop/store_update',
                    'method' => 'post',
                    'id' => 'frm_create_edit',
                ]) !!}
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="number" id="matttd" name="matttd" />
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Tiêu đề*</b></label>
                                <input type="text" id="tieude" name="tieude" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Mô tả*</b></label>
                                <textarea type="text" id="mota" name="mota" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Thời điểm bắt đầu*</b></label>
                                <input type="date" id="thoidiemtu" name="thoidiemtu" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Thời điểm kết thúc*</b></label>
                                <input type="date" id="thoidiemden" name="thoidiemden" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trạng thái*</b></label>
                                <select type="text" id="trangthai" name="trangthai" class="form-control">
                                    <option value="mo">Đang mở</option>
                                    <option value="tat">Đang tắt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Đóng</button>
                    <button type="submit" onclick="validate()" class="btn btn-danger font-weight-bold">Đồng ý</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @include('includes.delete')

    <script>
        // function validate() {
        //     if ($('#thoidiemtu').vol() == null || $('#thoidiemden').vol() == null) {
        //         toastr.error('Thời điểm không được để trống', 'Lỗi!');
        //     } else {
        //         if ($('#thoidiemtu').vol() > $('#thoidiemden').vol()) {
        //             toastr.error('Thời điểm bắt đầu phải nhỏ hơn thời điểm kết thúc', 'Lỗi!');
        //         } else {
        //             $('#frm_create_edit').submit();
        //         }
        //     }
        // }

        function edit(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/tuyen_dung/thong_tin_tong_hop/edit/' + id,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {

                    var form = $('#frm_create_edit');
                    form.find("[name='matttd']").val(data.matttd);
                    form.find("[name='tieude']").val(data.tieude);
                    form.find("[name='mota']").val(data.mota);
                    form.find("[name='thoidiemtu']").val(data.thoidiemtu);
                    form.find("[name='thoidiemden']").val(data.thoidiemden);
                    form.find("[name='trangthai']").val(data.trangthai).trigger('change');
                },
                error: function() {
                    $('#create_edit_modal').modal("hide");
                    toastr.error('không tìm thấy thông tin', 'Lỗi!');
                }
            });
        }

        function create() {
            var form = $('#frm_create_edit');
            form.find("[name='matttd']").val(null);
            form.find("[name='tieude']").val('');
            form.find("[name='mota']").val('');
            form.find("[name='thoidiemtu']").val('');
            form.find("[name='thoidiemden']").val(null);
            form.find("[name='trangthai']").val('tat').trigger('change');
        }
    </script>
@endsection
