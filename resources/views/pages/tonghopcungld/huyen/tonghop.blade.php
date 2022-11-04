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
            // TableManaged.init();
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
                        <h3 class="card-label text-uppercase">Danh sách người lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- <a href="{{ '/nguoilaodong/them_moi' }}" class="btn btn-sm btn-success mr-2"
                            title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="2%"> STT </th>
                                <th width="5%">Tên đơn vị</th>
                                <th width="13%">Nội dung</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($m_dv as $k => $dv)
                                <tr style="font-weight: bold">
                                    <td>{{++$k}}</td>
                                    <td>{{ $dv->tendv }}</td>
                                    <td>{{$dv->noidung}}</td>
                                    <td>
                                        @if ($dv->dv == null)
                                            <p class="text-danger">Đơn vị chưa gửi dữ liệu</p>
                                        @else
                                        <a title="In danh sách"
                                        href="{{'/cungld/danh_sach/huyen/in?matb='.$dv->matb.'&math='.$dv->math.'&madv='.$dv->madv}}"
                                        class="btn btn-sm btn-clean btn-icon"  target="_blank">
                                        <i class="icon-lg la flaticon2-print text-dark"></i>
                                        </a>
                                        <button type="button" onclick="tralai({{$dv->matb}},{{$dv->madv}})"
                                            title="Trả lại" data-target="#modify-modal-tralai" data-toggle="modal"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="fas fa-undo text-success"></i>
                                        </button>
                                        @endif

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
            <!-- modal trả lại -->
            <form method="POST" action="" accept-charset="UTF-8" id="tralai">
                @csrf
                <div id="modify-modal-tralai" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xs">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <h4 id="modal-header-primary-label" class="modal-title">Trả lại danh sách</h4>
                                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                            </div>
                            <div class="modal-body">
                                <label for="" class="control-label">Lý do trả lại</label>
                                <textarea name="tralai" id="tralai" cols=""  rows="3" class="col-md-12"></textarea>
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
                function tralai(matb,madv){
                    var url='/cungld/danh_sach/huyen/tralai?matb='+ matb + '&madv='+ madv;
                    $('#tralai').attr('action',url);
                }
            </script>
@endsection
