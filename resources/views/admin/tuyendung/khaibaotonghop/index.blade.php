@extends('HeThong.main')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">KHAI BÁO THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th width="6%">Thời điểm <br>bắt đầu</th>
                                    <th width="6%">Thời điểm <br>kết thúc</th>
                                    <th width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $i => $item ){
                                ?>
                                <tr class="text-center">
                                    <td>{{ ++$i }} </td>
                                    <td>{{ $item->tieude }}</td>
                                    <td>{{ $item->mota }}</td>
                                    <td class="text-center">{{ $item->thoidiemtu }}</td>
                                    <td class="text-center">{{ $item->thoidiemden }}</td>
                                    <td>
                                        <a href="{{ '/tuyen_dung/khai_bao_tong_hop/chi_tiet?manhom='.$item->matttd }}"  class="btn btn-icon btn-clean btn-lg mb-1 position-relative" title="Danh sách">
                                            <span class="svg-icon svg-icon-xl">
                                                <i class="icon-lg la la-clipboard-list text-success icon-2x"></i>
                                            </span>
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
