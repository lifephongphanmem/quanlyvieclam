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
                        <h3 class="card-label text-uppercase">DANH SÁCH KHAI BÁO THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/tuyen_dung/khai_bao_tong_hop/them_moi?madn=' . $doanhnghiep->masodn . '&&manhom=' . $manhom }}"
                            class="btn btn-xs btn-icon btn-success mr-2" title="Thêm mới"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="row" style="margin-top: 4%;margin-left: 1%">
                    <div class="col-md-4">
                        <label style="font-weight: bold">Doanh nghiệp</label>
                        <select class="form-control" id="masodn">
                            @foreach ($company as $item)
                                <option {{ $item->masodn == $doanhnghiep->masodn ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2" width="5%"> STT </th>
                                    <th rowspan="2">Nội dung</th>
                                    <th rowspan="2">Số lượng<br>tuyển</th>
                                    <th colspan="2">Thời điểm tuyển</th>
                                    <th rowspan="2">Trạng thái</th>
                                    <th rowspan="2" width="14%">Thao tác</th>
                                </tr>
                                <tr class="text-center">
                                    <th width="6%">Từ</th>
                                    <th width="6%">Đến</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $i => $item)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $item->noidung }}</td>
                                        <td class="text-center">{{ $item->soluong }}</td>
                                        <td class="text-center">{{ $item->thoidiemtu }}</td>
                                        <td class="text-center">{{ $item->thoidiemden }}</td>
                                        <td class="text-center">
                                            @if ($item->trangthai == 'cht')
                                                <span class="badge badge-warning">Chưa hoàn thanh</span>
                                            @endif
                                            @if ($item->trangthai == 'ht')
                                                <span class="badge badge-primary">Hoàn thành</span>
                                            @endif
                                            @if ($item->trangthai == 'btl')
                                                <span class="badge badge-danger">Bị trả lại</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Xem thông tin"
                                                href="{{ '/tuyen_dung/khai_bao_tong_hop/xem?id=' . $item->id }}"
                                                type="button" class="btn btn-sm btn-clean btn-icon" target="_blank">
                                                <i class="icon-lg la flaticon-eye text-success"></i>
                                            </a>

                                            @if ($item->trangthai == 'cht' || $item->trangthai == 'btl')
                                                <a title="Sửa thông tin"
                                                    href="{{ '/tuyen_dung/khai_bao_tong_hop/chinh_sua?id=' . $item->id }}"
                                                    type="button" class="btn btn-sm btn-clean btn-icon">
                                                    <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                                </a>
                                                <button
                                                    onclick="chuyen( '{{ '/tuyen_dung/khai_bao_tong_hop/chuyen/' . $item->id }}')"
                                                    title="Hoàn thành" data-toggle="modal" data-target="#chuyen-modal"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="fa fa-check text-primary"></i>
                                                </button>
                                                <button title="Xóa thông tin" data-toggle="modal"
                                                    data-target="#delete-modal-confirm" type="button"
                                                    onclick="cfDel('{{ '/tuyen_dung/khai_bao_tong_hop/delete/' . $item->id }}')"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="icon-lg flaticon-delete text-danger"></i>
                                                </button>
                                            @endif

                                            @if ($item->trangthai == 'btl')
                                                <button type="button" class="btn btn-sm btn-clean btn-icon"
                                                    onclick="lydo( '{{ $item->lydo }}')" data-toggle="modal"
                                                    data-target="#showlydo-modal" title="Xem lý do">
                                                    <i class="fa fa-search text-warning "></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-center">
                            Tổng cộng {{ $count }} kết quả
                        </div>
                    </div>

                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
            <div style="text-align: center">
                <a href="{{ '/tuyen_dung/khai_bao_tong_hop/' }}" class="btn btn-danger"><i
                        class="fa fa-reply"></i>&nbsp;Quay lại</a>
            </div>
        </div>
    </div>
    <!--end::Row-->


    @include('includes.delete')

    <div id="chuyen-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_chuyen" method="GET" action="" accept-charset="UTF-8">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý hoàn thành?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" onclick="submit()" data-dismiss="modal" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="showlydo-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_lydo" method="GET" action="" accept-charset="UTF-8">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Lý do bị trả lại</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <div class="col-xl-12">
                                        <p id='lydo'></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="lydo" data-dismiss="modal" class="btn btn-primary">Ok</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if (Session::has('success'))
        <script>
            toastr.success('{!! Session::get('success') !!}', 'Thành công');
        </script>
    @endif
    <script>
        function chuyen(url) {
            $('#frm_chuyen').attr('action', url);
        }

        function submit() {
            $('#frm_chuyen').submit();
        }

        function lydo(lydo) {
            $('#frm_lydo').find('#lydo').html(lydo);
        }

        // function showlydo(id) {
        //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //     $.ajax({
        //         url: '/tuyen_dung/khai_bao/lydo',
        //         type: 'GET',
        //         data: {
        //             _token: CSRF_TOKEN,
        //             id: id
        //         },
        //         dataType: 'JSON',
        //         success: function (data) {
        //             if(data == 'success') {
        //                 $('#showlydo').replaceWith(data);
        //             }
        //         }
        //     })
        // }
    </script>
@endsection
