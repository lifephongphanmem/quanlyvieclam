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
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            $('.select2me').select2();
        });
    </script>
@stop
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">ĐỢT THÔNG BÁO</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/tuyen_dung/thong_tin_tong_hop/them_moi' }}"
                            class="btn btn-xs btn-icon btn-success mr-2" title="Thêm mới"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <td>Thời điểm gửi</td>
                                    <td>Người gửi</td>
                                    <td width="5%">trạng thái</td>
                                    <th width="5%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr>
                                    <td class="text-center">{{ ++$i }} </td>
                                    <td>{{ $item->matttd }}</td>
                                    <td>{{ $item->noidung }}</td>
                                    <td class="text-center">{{ $item->thoidiem }}</td>
                                    <td class="text-center">
                                        @foreach ($user as $us)
                                            @if ($us->madv == $item->manguoigui)
                                                <span>{{ $us->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if ($item->trangthai == 'cg')
                                            <span class="badge badge-warning">Chưa gửi</span>
                                        @endif
                                        @if ($item->trangthai == 'dg')
                                            <span class="badge badge-success ">Đã gửi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->trangthai == 'cg')
                                            <a href="{{ '/tuyen_dung/thong_tin_tong_hop/chinh_sua?matb=' . $item->matb }}"
                                                title="Sửa" type="button" class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                            </a>
                                            <button onclick="chuyen( '{{ $item->matb }}')" title="Gửi thông báo"
                                                data-toggle="modal" data-target="#chuyen-modal"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="fa fa-check text-primary"></i>
                                            </button>
                                            <button title="Xóa" data-toggle="modal" data-target="#delete-modal-confirm"
                                                type="button" onclick="cfDel('{{ '/thong_bao/delete/' . $item->id }}')"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg flaticon-delete text-danger"></i>
                                            </button>
                                        @endif
                                        <a title="danh sách"
                                            href="{{ '/tuyen_dung/thong_tin_tong_hop?matb=' . $item->matb }}"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
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

    <div id="chuyen-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_chuyen" method="post" accept-charset="UTF-8" action="{{ '/tuyen_dung/thong_tin_tong_hop/chuyen' }}">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Chọn doanh nghiệp gửi thông báo?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <div class="col-xl-12">
                            <input id="matb" name="matb">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Doanh nghiệp nhận*</b></label>
                                <select id="manguoinhan" name="manguoinhan[]" class="col-xl-12 select2me" multiple>
                                    <option  value="all" selected>chọn tất cả</option>
                                    @foreach ($company as $item)
                                        <option value="{{ $item->user }}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý gửi</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function chuyen(matb) {
            $('#frm_chuyen').find('#matb').val(matb);
        }

    </script>
    @include('includes.delete')
@endsection
