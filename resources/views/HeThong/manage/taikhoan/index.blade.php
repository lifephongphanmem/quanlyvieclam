@extends('HeThong.main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/global/plugins/select2/select2.css') }}" />
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}">
    </script>

    <script src="{{ url('assets/admin/pages/scripts/table-managed.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
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
                        <h3 class="card-label text-uppercase">Danh sách tài khoản</h3>
                    </div>
                    {{-- <div class="card-toolbar">
                        <a href="" class="btn btn-xs btn-success mr-2">Tạo mới</a>
                        <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer" style="background-color:rgba(27, 197, 189, 0.1)">
                        <thead>
                            <tr class="text-center odd">
                                <th style="width:10%">STT</th>
                                <th >Tên đơn vị</th>
                                <th style="width:10%">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0 ?>
                            @foreach ($model_hc as $diaban)
                            <tr>
                                <td class="text-center odd">{{convert2Roman(++$i)}}</td>
                                <td>{{$diaban->name}}</td>
                                <td></td>
                            </tr>
                            <?php $m_dv=$model_dv->where('madiaban',$diaban->id) ?>
                            @foreach ( $m_dv as $key=>$dv )
                            <tr>
                                <td class="text-right">{{ ++$key }}</td>
                                <td>{{ $dv->tendv }}</td>
                                    <td class="text-center">
                                        <a href="{{'/TaiKhoan/DanhSach?madv='.$dv->madv}}" class="btn btn-icon btn-clean btn-lg mb-1 position-relative" title="Danh sách tài khoản">
                                            <span class="svg-icon svg-icon-xl">
                                                <i class="icon-lg flaticon-user text-success icon-2x"></i>
                                            </span>
                                            <span class="label label-sm label-light-danger text-dark label-rounded font-weight-bolder position-absolute top-0 right-0">{{count(App\Models\User::where('madv',$dv->madv)->get())}}</span>
                                        </a>
                                    </td>
                            </tr>
                            @endforeach
                                
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
    <?php
    function menudiaban($model,$parent=0, $char=''){
        foreach ($model as $key => $item) {
                        //Nếu là chuyên mục con thì hiển thị
            if ($item->parent == $parent) {
                            echo '<tr>';
                                if($item->level== 'Tỉnh'){
                                    echo '<td>'.++$key.'</td>';
                                }else {
                                    echo '<td></td>';
                                }
                                if($item->level== 'Thành phố' || $item->level == 'Huyện' || $item->level == 'Thị xã'){

                                    echo '<td>'.++$key.'</td>';
                                }else {
                                    echo '<td></td>';
                                }

                                if($item->level== 'Phường' || $item->level == 'Xã' || $item->level == 'Thị trấn'){
                                    // $key=0;
                                    echo '<td>'.++$key.'</td>';
                                }else {
                                    echo '<td></td>';
                                }

                               echo '<td>'.$item->name.'</td>';
                               $tendvql=App\Models\dmdonvi::where('madv',$item->madvql)->first();
                               if(isset($tendvql)){
                                echo '<td>'.$tendvql->tendv.'</td>';
                               }else {
                                echo '<td></td>';
                               }

                               echo '<td>';
                                   echo '<a href="/dmdonvi/dvql/'.$item->id.'" class="btn btn-sm btn-clean btn-icon" title="Thay đổi đơn vị quản lý địa bàn">
                                        <i class="icon-lg la fa-edit text-primary icon-2x"></i></a>';
                                    echo '<a href="'.'/dmdonvi/danh_sach_don_vi/'.$item->id.'" class="btn btn-icon btn-clean btn-lg mb-1 position-relative" title="Danh sách đơn vị">
                                            <span class="svg-icon svg-icon-xl">
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                             </span>
                                            <span class="label label-sm label-light-danger text-dark label-rounded font-weight-bolder position-absolute top-0 right-0">'.count(App\Models\dmdonvi::where('madiaban',$item->id)->get()).'</span>
                                         </a>';
                               echo '</td>';
                           echo '</tr>';

                           //Xóa menu đã lặp
                        //    unset($model[$key]);

                           //đệ quy để lấy danh sách con
                           menudiaban($model,$item->maquocgia,$char.'---');
            };
        }            
    }
     ?>
@stop
