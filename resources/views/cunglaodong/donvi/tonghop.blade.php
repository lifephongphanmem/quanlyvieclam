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

    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Danh sách thu thập cung lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- @if (chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi'))
                            <button onclick="add()" class="btn btn-sm btn-success mr-2" title="Thêm mới tổng hợp"
                                data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i>Thêm mới</button>
                        @endif --}}
                        <button title="In danh sách" {{-- href="{{ '/cungld/danh_sach/huyen/intonghop?matb=' . $th->matb }}" --}} onclick="indanhsach('{{ $math }}')"
                            data-target="#in" data-toggle="modal" class="btn btn-sm btn-clean">
                            <i class="icon-lg la flaticon2-print text-primary"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="15%">Họ tên</th>
                                <th width="10%">Ngày sinh</th>
                                <th width="10%">Giới tính</th>
                                <th width="10%">CMND/CCCD</th>
                                <th width="10%">Đối tượng ưu tiên</th>
                                <th width="10%">Trình độ</br>giáo dục phổ thông</th>
                                <th width="10%">Trình độ</br>chuyên môn kỹ thuật</th>
                                <th width="10%">Tình trạng</br>tham gia</br>hoạt động kinh tế</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $th->hoten }}</td>
                                    <td> {{ $th->ngaysinh }}</td>
                                    <td> {{ $th->gioitinh }}</td>
                                    <td> {{ $th->cmnd }}</td>
                                    <td> {{ $th->doituonguutien != null ? $a_doituonguutien[$th->doituonguutien] : '' }}</td>
                                    <td> {{ $th->trinhdogiaoduc != null ? $a_trinhdogdpt[$th->trinhdogiaoduc] : '' }}</td>
                                    <td> {{ $th->trinhdocmkt != null ? $a_trinhdocmkt[$th->trinhdocmkt] : '' }}</td>
                                    <td> {{ $th->tinhtrangvl != null ? $a_tinhtrangvl[$th->tinhtrangvl] : '' }}</td>
                                    <td>
                                        <a title="Sửa thông tin" href="{{ '/nguoilaodong/SuaDanhSach/' . $th->id }}"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </a>

                                        {{-- @if (chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi')) --}}
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/cungld/danh_sach/don_vi/delete/' . $th->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="icon-lg flaticon-delete text-danger"></i></button>
                                        {{-- @endif --}}
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
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th" enctype="multipart/form-data" target="_blank">
        @csrf
        <div id="in" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">In danh sách</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="control-label">Tình trạng việc làm</label>
                                {{-- {!! Form::select('tinhtrangvl', $a_tinhtrangvl,null, ['id' => 'tinhtrangvl', 'class' => 'form-control select2basic']) !!} --}}
                                <select name="tinhtrangvl" id="" class="form-control select2basic" style="width:100%">
                                    <option value="">Tất cả</option>
                                    @foreach ($a_tinhtrangvl as $key=>$ct )
                                        <option value="{{$key}}">{{$ct}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name='math' id='math'>
                            </div>
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

    {{-- <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
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
    </form> --}}
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

        function indanhsach(math)
        {
            var url='/cungld/danh_sach/don_vi/chi_tiet/'+math;

            $('#math').val(math);
            $('#frm_modify_th').attr('action', url);
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
