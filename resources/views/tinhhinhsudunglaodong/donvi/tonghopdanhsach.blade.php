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
                        <h3 class="card-label text-uppercase">Tổng hợp tình hình sử dụng lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        @if (chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'thaydoi'))
                                            <a title="In" href="{{'/tinhhinhsudungld/don_vi/intonghop?matb='.$inputs['matb'].'&madv='.$inputs['madv'].'&nam='.$inputs['nam'].'&capdo='.$inputs['capdo']}}" class="btn btn-sm btn-clean btn-icon"
                                                target="_blank">
                                                <i class="icon-lg la flaticon2-print text-dark"></i>
                                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">

                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr style="padding-left: 2px;padding-right: 2px;text-align: center">
                                <th style="width: 3%;" rowspan="3">S</br>T</br>T</th>
                                <th style="width: 10%;" rowspan="3">Họ và tên</th>
                                <th rowspan="3" style="width:8%">Mã số</br>BHXH</th>
                                <th rowspan="3" style="width:8%">Ngày sinh</th>
                                <th rowspan="3" style="width: 3%;">Giới tính</th>
                                <th rowspan="3">CCCD/</br>CMND</th>
                                <th style="width: 5%;" rowspan="3">Chức vụ</th>
                                <th style="width: 10%;" rowspan="3">Vị trí việc làm</th>
                                <th colspan="6">Tiền lương</th>
                                <th colspan="2" rowspan="2">Ngành nghề nặng nhọc, độc hại</th>
                                <th rowspan="3">Loại và hiệu lực hợp đồng lao động</th>
                                <th rowspan="3">Ghi chú</th>
                            </tr>
                            <tr class="text-center">
                                <th rowspan="2" style="width: 3%;">Hệ số</br>mức lương</th>
                                <th colspan="5" style="width: 3%;">Phụ cấp</th>
                            </tr>
                            <tr>
                                <th style="width: 3%;">Chức vụ</th>
                                <th style="width: 3%;">Thâm</br>niên</br>vượt</br>khung</th>
                                <th style="width: 3%;">Thâm</br>niên</br>nghề</th>
                                <th style="width: 3%;">Phụ</br>cấp</br>lương</th>
                                <th style="width: 3%;">Các</br>khoản</br>bổ</br>sung</th>
                                <th style="width: 3%;">Ngày</br>bắt</br>đầu</th>
                                <th style="width: 3%;">Ngày</br>kết</br>thúc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ct)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $ct->hoten }}</td>
                                    <td>{{ $ct->sobhxh }}</td>
                                    <td>{{ $ct->ngaysinh }}</td>
                                    <td>{{ $ct->gioitinh }}</td>
                                    <td>{{ $ct->cmnd }}</td>
                                    <td>{{$ct->chucvu != null? $a_chucvu[$ct->chucvu]:'' }}</td>
                                    <td>{{$ct->vitrivl != null?$a_vitri[$ct->vitrivl]:''}}</td>
                                    <td></td>
                                    <td>{{ $ct->pcchucvu }}</td>
                                    <td>{{ $ct->pcthamnien }}</td>
                                    <td>{{ $ct->pcthamniennghe }}</td>
                                    <td>{{ $ct->pcluong }}</td>
                                    <td>{{ $ct->pcbosung }}</td>
                                    <td>{{ $ct->bddochai }}</td>
                                    <td>{{ $ct->ktdochai }}</td>
                                    <td>{{$ct->bdhdld != null? $a_loaihdld[$ct->loaihdld]   : '' }}</td> 
                                    <td></td>
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
    <!-- modal add -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Tạo báo cáo</h4>
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

                        {{-- <div class="col-lg-12">
                            <label class="control-label">Nội dung</label>
                            <textarea name="noidung" rows="5" class="form-control" id='noidung'></textarea>
                        </div> --}}
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
            var url = '/tinhhinhsudungld/don_vi/store'
            $('#frm_modify').attr('action', url);
        }

        function sendData(id) {
            var url = '/tinhhinhsudungld/don_vi/send/' + id;

            $('#frm_modify_send').attr('action', url);
        }

        function chinhsua(id) {
            var url = '/tinhhinhsudungld/thongbao/edit/' + id;
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

                    var url = '/tinhhinhsudungld/thongbao/update/' + id;
                    $("#frm_modify_edit").attr("action", url);
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });

        }

    </script>
@endsection
