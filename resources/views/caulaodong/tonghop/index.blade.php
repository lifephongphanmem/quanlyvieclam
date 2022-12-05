@extends('main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">DANH SÁCH THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ 'khai_bao_nhu_cau/them_moi?matb=' . $matb }}" class="btn btn-xs btn-icon btn-success mr-2"
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
                                    <th>Doanh nghiệp</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr class="text-center">
                                    <td>{{ ++$i }} </td>
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

                                    <td>
                                        @foreach ($doanhnghiep as $dn)
                                            @if ($item->madn == $dn->user)
                                                <span>{{ $dn->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a title="xem chi tiết"
                                            href="{{ '/tuyen_dung/khai_bao_nhu_cau/xem?mahs=' . $item->mahs }}"
                                            type="button" target="_blank" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-eye text-success"></i>
                                        </a>
                                        <button onclick="tralai( '{{ $item->mahs }}')" title="trả lại" data-toggle="modal"
                                            data-target="#tralai-modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="fa fa-reply text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div style="text-align: center">
                    <a href="{{ '/tuyen_dung/thong_tin_tong_hop/dot_thu_thap' }}" class="btn btn-danger"><i
                            class="fa fa-reply"></i>&nbsp;Quay lại</a>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->

        </div>
    </div>
    <!--end::Row-->


    <div id="tralai-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_tralai" method="post" accept-charset="UTF-8" action="{{ '/tuyen_dung/thong_tin_tong_hop/tralai' }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Lý do trả lại thông tin?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xl-12">
                            <input id="mahs" name="mahs">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>lý do*</b></label>
                                <textarea id="lydo" name="lydo" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function tralai(mahs) {
            $('#frm_tralai').find('#mahs').val(mahs);

        }
    </script>
@endsection
