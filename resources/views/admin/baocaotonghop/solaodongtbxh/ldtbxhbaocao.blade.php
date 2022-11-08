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
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Báo cáo tổng hợp cung lao động</h3>
                    </div>
                </div>
                <form action="{{'/bao_cao/so_lao_dong_thuong_binh_xa_hoi/ldtbxh_tong_hop'}}" method="get" id="frm_tonghop">
                    @csrf
                    <div class="card-body" style="text-align: center ;margin-top: 5%">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Tổng hợp:</b></label>
                                    <select id="madb" name="madb" class="col-xl-6 select2me">
                                        @foreach ($tonghopcungld as $item)
                                            <option value="{{ $item->madv }}">{{ $item->noidung }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-lg-12" style="text-align: center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check"></i>ĐỒng ý</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
