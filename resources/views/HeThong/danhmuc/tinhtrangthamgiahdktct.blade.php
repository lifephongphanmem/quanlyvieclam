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
                        <h3 class="card-label text-uppercase">DANH MỤC CHI TIẾT {{ $tennhom->tentgkt }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="create()" data-toggle="modal" data-target="#create_edit_modal"
                            class="btn btn-xs btn-icon btn-success mr-2" title="Thêm mới"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tên phân loại</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th width="20%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $item ){
                                ?>
                                <tr class="text-center">
                                    <td>{{ $item->stt }} </td>
                                    <td>{{ $item->tentgktct }}</td>
                                    <td>{{ $item->mota }}</td>
                                    <td>
                                        @if ($item->trangthai == 'kh')
                                            <span>kích hoạt</span>
                                        @elseif($item->trangthai == 'kkh')
                                            <span>không kích hoạt</span>
                                        @else
                                            <span></span>
                                        @endif
                                    </td>
                                    <td>
                                        <button title="Sửa thông tin" data-toggle="modal" data-target="#create_edit_modal"
                                            type="button" onclick="edit('{{ $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        <a href="{{ '/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet_2?manhom=' . $item->madmtgktct }}"
                                            class="btn btn-icon btn-clean btn-lg mb-1 position-relative" title="Danh sách">
                                            <span class="svg-icon svg-icon-xl">
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                            </span>
                                            <span
                                                class="label label-sm label-light-danger text-dark label-rounded font-weight-bolder position-absolute top-0 right-0">
                                                {{ count(App\Models\dmtinhtrangthamgiahdktct2::where('manhom2', $item->madmtgktct)->get()) }}
                                            </span>
                                        </a>
                                        <button title="Xóa thông tin" data-toggle="modal"
                                            data-target="#delete-modal-confirm" type="button"
                                            onclick="cfDel('{{ '/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet/delete/' . $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg flaticon-delete text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                Tổng cộng {{ $count }} kết quả
                            </div>
                        </div>
                    </footer>
                    <div style="text-align: center">
                        <a href="{{ '/danh_muc/dm_tinh_trang_tham_gia_hdkt' }}" class="btn btn-danger"><i
                                class="fa fa-reply"></i>&nbsp;Quay lại</a>
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
                        Thêm mới danh mục chi tiết {{ $tennhom->tentgkt }}
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                {!! Form::open([
                    'url' => '/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet/store_update',
                    'method' => 'post',
                    'id' => 'frm_create_edit',
                ]) !!}
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="number" id="id" name="id" hidden />
                        <input type="text" id="manhom" name="manhom" value="{{ $tennhom->madmtgkt }}" hidden />
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Số thứu tự*</b></label>
                                <input type="number" id="stt" name="stt" value="{{ $count + 1 }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Tên phân loại*</b></label>
                                <input type="text" id="tentgktct" name="tentgktct" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Mô tả*</b></label>
                                <textarea type="text" id="mota" name="mota" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trạng thái*</b></label>
                                <select type="text" id="trangthai" name="trangthai" class="form-control">
                                    <option value="kh">Kích hoạt</option>
                                    <option value="kkh">Không kích hoạt</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="validate()" class="btn btn-danger font-weight-bold">Đồng ý</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @include('includes.delete')
    <script>
        function validate() {
            if ($('#stt').val() <= 0) {
                toastr.error('số thứ tự phải là số tự nhiên và lớn hơn 0', 'Lỗi!');
            } else {
                $('#frm_create_edit').submit();

            }
        }

        function edit(id) {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet/edit/' + id,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    var form = $('#frm_create_edit');
                    form.find("[name='id']").val(data.id);
                    form.find("[name='tentgktct']").val(data.tentgktct);
                    form.find("[name='mota']").val(data.mota);
                    form.find("[name='trangthai']").val(data.trangthai).trigger('change');
                    form.find("[name='stt']").val(data.stt);
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
        }

        function create() {
            var form = $('#frm_create_edit');
            form.find("[name='id']").val(null);
            form.find("[name='tentgktct']").val('');
            form.find("[name='trangthai']").val('kh');
            form.find("[name='mota']").val('');
            form.find("[name='stt']").val('{{ $count + 1 }}');
        }
    </script>
@endsection
