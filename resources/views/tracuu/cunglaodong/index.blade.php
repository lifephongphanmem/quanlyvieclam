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
    <!--begin::Card-->
    {!! Form::open([
        'method' => 'POST',
        'url' => '/TimKiem/CungLaoDong/KetQua',
        'class' => 'form',
        'id' => 'frm_ThayDoi',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label text-uppercase">Thông tin tìm kiếm cung lao động</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <div class="col-4">
                    <label class="form-control-label">Tên người lao động</label>
                    {!! Form::text('hoten', null, ['class' => 'form-control']) !!}
                </div>

                <div class="col-4">
                    <label class="form-control-label">CCCD/CMND</label>
                    {!! Form::text('cmnd', null, ['class' => 'form-control']) !!}
                </div>

                <div class="col-4">
                    <label class="form-control-label">Giới tính</label>
                    {!! Form::select('gioitinh', setArrayAll(getGioiTinh(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>


            </div>

            <div class="form-group row">
                <div class="col-4">
                    <label class="form-control-label">Xã</label>
                    {!! Form::select('xa', setArrayAll($a_xa, 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>
                <div class="col-4">
                    <label class="form-control-label">Huyện</label>
                    {!! Form::select('huyen', setArrayAll($a_huyen, 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>

                <div class="col-4">
                    <label class="form-control-label">Năm thu thập</label>
                    {!! Form::select('nam', setArrayAll(getNam(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>
            </div>
            
        </div>
        <div class="card-footer">
            <div class="row text-center">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Tìm
                        kiếm</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!--end::Card-->
@stop