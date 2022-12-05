@extends('main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">KHAI BÁO THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ 'khai_bao_nhu_cau/them_moi?matb=' . $matb}}" class="btn btn-xs btn-icon btn-success mr-2"
                            title="Thêm mới"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Nội dung</th>
                                    <th>Yêu cầu</th>
                                    <th>Người tạo</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Trạng thái</th>
                                    <th width="15%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr>
                                    <td class="text-center">{{ ++$i }} </td>
                                    <td>{{ $item->noidung }}</td>
                                    <td>
                                        @if ($item->yeucau == 'tv')
                                            <span>Tư vấn</span>
                                        @endif
                                        @if ($item->yeucau == 'gtvl')
                                            <span>Giới thiệu việc làm</span>
                                        @endif
                                        @if ($item->yeucau == 'culd')
                                            <span>Cung ứng lao động</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->ten }}</td>
                                    <td class="text-center">{{ $item->sdt }}</td>
                                    <td class="text-center">{{ $item->email }}</td>
                                    <td class="text-center">
                                        @if ($item->trangthai == 'cc')
                                            <span class="badge badge-warning">chưa chuyển</span>
                                        @endif
                                        @if ($item->trangthai == 'dc')
                                            <span class="badge badge-primary">đã chuyển</span>
                                        @endif
                                        @if ($item->trangthai == 'btl')
                                            <span class="badge badge-danger">bị trả lại</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a title="xem chi tiết"
                                            href="{{ '/tuyen_dung/khai_bao_nhu_cau/xem?mahs=' . $item->mahs }}"
                                            type="button" target="_blank" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-eye text-success"></i>
                                        </a>
                                        @if ($item->trangthai == 'cc' || $item->trangthai == 'btl')
                                            <a title="Sửa thông tin"
                                                href="{{ '/tuyen_dung/khai_bao_nhu_cau/chinh_sua?mahs=' . $item->mahs }}"
                                                type="button" class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                            </a>
                                            <button onclick="chuyen( '{{ $item->mahs }}')" title="Chuyển thông tin"
                                                data-toggle="modal" data-target="#chuyen-modal"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="fa fa-check text-primary"></i>
                                            </button>
                                            <button title="Xóa" data-toggle="modal" data-target="#delete-modal-confirm"
                                                type="button"
                                                onclick="cfDel('{{ '/tuyen_dung/khai_bao_nhu_cau/delete/' . $item->id }}')"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg flaticon-delete text-danger"></i>
                                            </button>
                                            @if ($item->trangthai == 'btl')
                                                <button data-toggle="modal" data-target="#lydo-modal"
                                                    onclick="lydo('{{ $item->lydo }}')"
                                                    class="btn btn-sm btn-clean btn-icon" title="xem lý do">
                                                    <i class="fa fa-search text-warning "></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div style="text-align: center">
                    <a href="{{ '/tuyen_dung/khai_bao_nhu_cau/dot_thu_thap' }}" class="btn btn-danger"><i
                            class="fa fa-reply"></i>&nbsp;Quay lại</a>
                </div>

            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->

    <div id="chuyen-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_chuyen" method="post" accept-charset="UTF-8" action="{{ '/tuyen_dung/khai_bao_nhu_cau/chuyen' }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý chuyển thông tin?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xl-12">
                            <input id="mahs" name="mahs">

                            {{-- <div class="form-group fv-plugins-icon-container">
                                <label><b>Doanh nghiệp nhận*</b></label>
                                <select id="manguoinhan" name="manguoinhan[]" class="col-xl-12 select2me" multiple>
                                    @foreach ($company as $item)
                                        <option value="{{ $item->user }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="lydo-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_lydo" method="post" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Lý do bị trả lại?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xl-12">
                            <span id="lydo"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-primary">ok</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function chuyen(mahs) {
            $('#frm_chuyen').find('#mahs').val(mahs);

        }

        function lydo(lydo) {
            $('#frm_lydo').find('#lydo').html(lydo);

        }
    </script>
    @include('includes.delete')
@endsection
