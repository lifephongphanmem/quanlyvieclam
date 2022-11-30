@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    {{-- <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script> --}}

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            // $('.select2me').select2();
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
                        <h3 class="card-label text-uppercase">Danh sách thông báo</h3>
                    </div>
                    <div class="card-toolbar">
                        {{-- <a href="{{ '/cungld/thongbao/create' }}" class="btn btn-sm btn-success mr-2"
                            title="Thêm mới tài khoản"><i class="fa fa-plus"></i></a> --}}
                            <button class="btn btn-xs btn-icon btn-success mr-2" onclick="add()" title="Thêm thông báo" data-target="#modify-modal" data-toggle="modal"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="2%"> STT </th>
                                <th width="5%">Năm thu thập</th>
                                <th width="15%"> Tiêu đề</th>
                                <th width="13%"> Nội dung</th>
                                <th width="13%">Thời gian gửi</th>
                                <th width="10%">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $th)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td name="nam"> {{ $th->nam }}</td>
                                    <td class="text-left" name="tieude"> {{ $th->tieude }}</td>
                                    <td class="text-left" name='noidung'>{{ $th->noidung }}</td>
                                    <td class="{{ $th->ngaygui == 0 ? 'text-danger' : '' }}">
                                        {{ $th->ngaygui == 0 ? 'Chưa gửi' : \Carbon\Carbon::parse($th->ngaygui)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        @if ($th->ngaygui == 0)
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ '/cungld/thongbao/update/' . $th->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#modify-modal-edit" data-toggle="modal">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/cungld/thongbao/delete/' . $th->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="icon-lg flaticon-delete text-danger"></i></button>
                                        
                                            <button type="button" onclick="sendData({{ $th->id }})"
                                                title="Gửi thông báo" data-target="#modify-modal-th" data-toggle="modal"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="fas fa-share-square text-success"></i>
                                            </button>
                                        {{-- @else
                                            <button type="button" onclick="sendData({{ $th->id }})"
                                                title="Gửi thông báo" data-target="#modify-modal-th" data-toggle="modal"
                                                class="btn btn-sm btn-clean btn-icon" disabled>
                                                <i class="fas fa-share-square text-success"></i>
                                            </button> --}}
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
    @include('includes.delete')
<!-- Modal thêm thông báo -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify">
        @csrf
        <div id="modify-modal" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body" >
                        <div class="form-horizontal">
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label class="control-label">Năm thu thập</label>
                                    {!! Form::select('nam',getNam(),$nam, array('id' => 'nam_add','class' => 'form-control'))!!}
                                </div>

                                <div class="col-lg-8">
                                    <label class="control-label">Tiêu đề<span class="require">*</span></label>
                                    <input class="form-control" required="required" name="tieude" type="text"
                                      id='tieude_add' readonly >
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Nội dung</label>
                                    <textarea name="noidung" rows="3" class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>
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
<!-- Modal sửa thông báo -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_edit">
        @csrf
        <div id="modify-modal-edit" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body" >
                        <div class="form-horizontal">
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label class="control-label">Năm thu thập</label>
                                    {!! Form::select('nam',getNam(),$nam, array('id' => 'nam', 'class' => 'form-control'))!!}
                                </div>

                                <div class="col-lg-8">
                                    <label class="control-label">Tiêu đề<span class="require">*</span></label>
                                    <input class="form-control" required="required" name="tieude" type="text"
                                        id="tieude">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <label class="control-label">Nội dung</label>
                                    <textarea name="noidung" rows="3" class="form-control" id='noidung'></textarea>
                                </div>
                            </div>
                        </div>
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

    <!-- modal gửi thông báo -->
    <form method="POST" action="" accept-charset="UTF-8" id="frm_modify_th">
        @csrf
        <div id="modify-modal-th" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý gửi thông báo</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Thông báo khi gửi đi sẽ không thể chỉnh sửa. Bạn hãy kiểm tra kỹ số liệu trước khi gửi.</b></label>
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
    <script>
        $(document).ready(function(){
            var nam=$('#nam_add').val();
                var html= 'Thông báo thu thập thông tin cung lao động năm '+ nam;
                $('#tieude_add').val(html)
            $('#nam_add').on('change',function(){
                
                var nam=$('#nam_add').val();
                var html= 'Thông báo thu thập thông tin cung lao động năm '+ nam;
                $('#tieude_add').val(html)
            });
        });
        $('#choose_all').on('click', function() {
            $('.choose').prop('checked', true);
        })

        function add(){
            var url='/cungld/thongbao/store';
            $('#frm_modify').attr('action', url);
        }

        function sendData(id) {
            var url = '/cungld/thongbao/send/' + id;

            $('#frm_modify_th').attr('action', url);
        }

        function edit(e,url) {
            var tr = $(e).closest('tr');
            var nam=$(tr).find('td[name=nam]').text();
            $('#nam').val(parseInt(nam));
            // $('#nam option[value=' + nam + ' ]').attr('selected', 'selected');
            $('#tieude').val($(tr).find('td[name=tieude]').text());
            $('#noidung').html($(tr).find('td[name=noidung]').text());
            // window.location.href = url;
            $('#frm_modify_edit').attr('action', url);
        }
    </script>
@endsection
