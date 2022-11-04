@extends('HeThong.main')
{{-- @section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop


@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
@stop --}}

@section('content')
<div class="row">
    <div class="col-xl-12">
    <h3 class="page-title text-uppercase">
        Báo cáo tổng hợp {{ session('admin')['a_chucnang']['giathuetscong'] ?? 'giá thuê tài sản công' }}
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ol>
                                <li><a data-target="#pl1-thoai-confirm" data-toggle="modal" data-href="">Báo cáo tổng hợp
                                        cung lao động</a> </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function ClickBC1(url) {
            $('#frm_bc1').attr('action', url);
            $('#frm_bc1').submit();
        }
    </script>

    <!--Modal Thoại PL1-->
    <div id="pl1-thoai-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open(['url' => '', 'target' => '_blank', 'id' => 'frm_bc1', 'class' => 'form-validate']) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Báo cáo tổng hợp</h4>
                </div>

                {{-- <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label style="font-weight: bold">Đơn vị</label>
                                <select class="form-control select2me" id="madv" name="madv" >
                                    @foreach ($m_diaban as $diaban)
                                        <optgroup label="{{$diaban->tendiaban}}">
                                           
                                            @foreach ($donvi as $ct)
                                                <option {{$ct->madv == $inputs['madv'] ? "selected":""}} value="{{$ct->madv}}">{{$ct->tendv}}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Từ ngày</label>
                                {!! Form::input('date', 'tungay', date('Y').'-01-01', array('id' => 'tungay', 'class' => 'form-control', 'required'))!!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Đến ngày</label>
                                {!! Form::input('date', 'denngay', date('Y').'-12-31', array('id' => 'denngay', 'class' => 'form-control', 'required'))!!}
                            </div>
                        </div>
                    </div>
            </div> --}}

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickBC1('')">Đồng
                        ý</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection
