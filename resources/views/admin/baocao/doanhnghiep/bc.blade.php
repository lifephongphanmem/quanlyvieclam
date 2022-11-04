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

                <div class="card-body"  style="text-align: center ;margin-top: 5%">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label style="font-weight: bold">Đơn vị:  </label>
                                <select class="col-md-6 select2me" id="madv" name="madv">
                                    @foreach ($company as $com)
                                        <option value="{{$com->id}}" {{$nguoidung->id == $com->id ? 'selected':''}}>{{$com->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Tổng hợp:</b></label>
                                <select  id="matttd" name="matttd" class="col-xl-6 select2me">
                                    @foreach ($tonghopcungld as $item)
                                        <option value="{{ $item->madb }}">{{ $item->noidung }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
