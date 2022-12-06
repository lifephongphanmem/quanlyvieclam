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
                        <h3 class="card-label text-uppercase">Kết quả tìm kiếm</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="inketqua()" class="btn btn-sm btn-clean mr-2" title="in kết quả"
                            data-target="#modify-modal" data-toggle="modal"><i class="icon-lg la flaticon2-print text-dark icon-2x"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="2%">Năm</th>
                                <th width="10%">Họ tên </th>
                                <th width="15%">CCCD/CMND</th>
                                <th width="5%">Giới tính</th>
                                <th width="5%">Chức vụ</th>
                                <th width="10%">Vị trí việc làm</th>
                                <th width="10%">Doanh nghiệp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tb)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td name="nam">{{ $tb->nam }}</td>
                                    <td name="tieude" class="text-left">{{ $tb->hoten }} </td>
                                    <td name="noidung"> {{ $tb->cmnd }}</td>
                                    <td> {{ $tb->gioitinh }}</td>
                                    <td>
                                        {{ $tb->chucvu != null?$a_chucvu[$tb->chucvu]:'' }}
                                    </td>
                                    <td>{{ $tb->vitrivl != null ? $a_vitrivl[$tb->vitrivl]:'' }}</td>
                                    <td>{{ $tb->madv != null ?$a_doanhnghiep[$tb->madv]:'' }}</td>
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

    <!-- modal gửi thông báo -->
    <form method="POST" action="{{'/TimKiem/TinhHinhSuDungLaoDong/InKetQua'}}" accept-charset="UTF-8" id="frm_modify_send" target="_blank">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">In thông tin dữ liệu</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>


                            <input type="hidden" name="hoten" value="{{$inputs['hoten']}}">
                            <input type="hidden" name="cmnd" value="{{$inputs['cmnd']}}">
                            <input type="hidden" name="gioitinh" value="{{$inputs['gioitinh']}}">
                            <input type="hidden" name="madv" value="{{$inputs['madv']}}">
                            <input type="hidden" name="nam" value="{{$inputs['nam']}}">
                            <input type="hidden" name="tieude" value="{{$inputs['tieude']}}">

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit"  id="submit" name="submit" value="submit" class="btn btn-primary" >Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
