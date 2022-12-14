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
                        <h3 class="card-label text-uppercase">Tổng hợp cung lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- <button onclick="add()" class="btn btn-sm btn-success mr-2" title="Thêm mới tổng hợp"
                            data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i></button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="2%"> Năm thu thập </th>
                                <th width="15%">Nội dung</th>
                                <th width="5%">Thời gian gửi</th>
                                <th width="5%">Trạng thái</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $th->nam }}</td>
                                    <td class="text-left"> {{ $th->tieude }}</td>
                                    <td>{{isset($th->ngaygui)?$th->ngaygui:'Dữ liệu chờ gửi'}}</td>
                                    <td>{{$th->trangthai != null?getStatus()[$th->trangthai]:''}}</td>
                                    <td>
                                        @if (chkPhanQuyen('tonghopcunglaodonghuyen', 'danhsach'))
                                            <a title="In tổng hợp"
                                                {{-- href="{{ '/cungld/danh_sach/huyen/intonghop?matb=' . $th->matb }}" --}}
                                                onclick="intonghop('{{$th->matb}}',{{$th->nam}})" data-target="#modify-modal-in" data-toggle="modal"
                                                class="btn btn-sm btn-clean btn-icon" >
                                                <i class="icon-lg la flaticon2-print text-primary"></i>
                                            </a>
                                            <a title="Xem chi tiết"
                                                href="{{ '/cungld/danh_sach/huyen/tong_hop?matb=' . $th->matb }}"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                            </a>
                                        @endif
                                        @if (chkPhanQuyen('tonghopcunglaodonghuyen', 'hoanthanh'))
                                            @if ($th->trangthai == 'TRALAI' || $th->mathh == null)
                                                <button type="button"
                                                    onclick="sendData('{{ $th->matb }}','{{ $th->nam }}')"
                                                    title="Gửi danh sách" data-target="#modify-modal-th" data-toggle="modal"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="fas fa-share-square text-success"></i>
                                                </button>
                                            @endif
                                            @if ($th->trangthai == 'TRALAI')
                                                <button type="button"
                                                    onclick="lydo({{ $th->matb }},{{ $th->madv }})"
                                                    title="Lý do trả lại" data-target="#lydo-modal" data-toggle="modal"
                                                    class="btn btn-sm btn-clean btn-icon">
                                                    <i class="fas fa-question-circle text-primary"></i>
                                                </button>
                                            @endif
                                        @endif
                                        {{-- @if (chkPhanQuyen('tonghopcunglaodonghuyen', 'thaydoi'))
                                            <button title="Xóa thông tin" type="button"
                                                onclick="cfDel('{{ '/cungld/danh_sach/delete/' . $th->id }}')"
                                                class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="icon-lg flaticon-delete text-danger"></i></button>
                                        @endif --}}
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
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th">
        @csrf
        <div id="modify-modal-th" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý gửi dữ liệu</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Số liệu tổng hợp khi gửi đi sẽ không thể chỉnh sửa. Bạn hãy kiểm tra kỹ số liệu trước
                                    khi gửi.</b></label>
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

    
    <!-- modal in tổng hợp -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_in" target="_blank">
        @csrf
        <div id="modify-modal-in" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">In tổng hợp</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <label class="control-label">Đơn vị</label>
                            {{-- {!! Form::select('tinhtrangvl', setArray($a_tinhtrangvl,'Tất cả',null), ['id' => 'tinhtrangvl', 'class' => 'form-control select2basic']) !!} --}}
                            <select name="madv" id="" class="form-control select2basic" style="width:100%">
                                <option value="">Tất cả</option>
                                @foreach ($a_donvi as $key=>$ct )
                                    <option value="{{$key}}">{{$ct}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name='math' id='math'>
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

    <!-- modal lý do -->

    <div id="lydo-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin lý do trả lại dữ liệu</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                </div>
                <div class="modal-body">
                    <textarea name="lydo" id="lydo" cols="" rows="3" class="col-md-12"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function add() {
            var url = '/cungld/danh_sach/store'
            $('#frm_modify').attr('action', url);
        }

        function intonghop(matb,nam)
        {
            var url='/cungld/danh_sach/huyen/intonghop?matb='+matb+'&nam='+nam;
            $('#frm_modify_in').attr('action', url);
        }

        function sendData(matb, nam) {
            var url = '/cungld/danh_sach/huyen/send?matb=' + matb + '&nam=' + nam;
            $('#frm_modify_th').attr('action', url);
        }

        function lydo(matb, madv) {
            var url = '/cungld/danh_sach/huyen/lydo';

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    matb: matb,
                    madv: madv
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
