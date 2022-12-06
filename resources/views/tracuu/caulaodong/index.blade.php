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
        'url' => '/TimKiem/CauLaoDong/KetQua',
        'class' => 'form',
        'id' => 'frm_ThayDoi',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!}
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label text-uppercase">Thông tin tìm kiếm nhu cầu lao động</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">

            <div class="form-group row">
                <div class="col-6">
                    <label class="form-control-label">Doanh nghiệp</label>
                    {!! Form::select('madv', setArrayAll($a_doanhnghiep, 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>

                {{-- <div class="col-3">
                    <label class="form-control-label">Số hộ chiếu</label>
                    {!! Form::text('cmnd', null, ['class' => 'form-control']) !!}
                </div> --}}

                <div class="col-6">
                    <label class="form-control-label">Năm</label>
                    {!! Form::select('nam', setArrayAll(getNam(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>
                {{-- <div class="col-3">
                    <label class="form-control-label">Quốc Tịch</label>
                    {!! Form::select('nation', setArrayAll(getCountries(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div> --}}

            </div>

            {{-- <div class="form-group row">
                <div class="col-4">
                    <label class="form-control-label">Quốc Tịch</label>
                    {!! Form::select('nation', setArrayAll(getCountries(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>



                <div class="col-4">
                    <label class="form-control-label">Năm thu thập</label>
                    {!! Form::select('nam',setArrayAll(getNam(), 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>


                <div class="col-4">
                    <label class="form-control-label">Loại báo cáo</label>
                    {!! Form::select('tieude', setArrayAll($loaibaocao, 'Tất cả', 'ALL'), null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>

            </div> --}}
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
