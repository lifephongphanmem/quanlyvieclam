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
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase"> ĐỢT THU THẬP</h3>
                    </div>
        
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <td>Thời điểm gửi</td>
                                    <td>Người gửi</td>
                                    <th width="5%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr >
                                    <td class="text-center">{{ ++$i }} </td>
                                    <td>{{ $item->matttd }}</td>
                                    <td>{{ $item->noidung }}</td>
                                    <td class="text-center">{{ $item->thoidiem }}</td>
                                    <td class="text-center">
                                        @foreach ($user as $us)
                                            @if ($us->madv == $item->manguoigui)
                                                <span>{{ $us->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a  title="danh sách" href="{{ '/tuyen_dung/khai_bao_nhu_cau?matb='.$item->matb}}">
                                            <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
 
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->


   
@endsection
