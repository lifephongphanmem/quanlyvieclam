@extends('main')
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">CHi TIẾT THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>


                <form method="POST" action="{{ '/tuyen_dung/khai_bao_nhu_cau/update' }}" accept-charset="UTF-8"
                    class="horizontal-form" id="frm_edit" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input id="matb" name="matb" value="{{$model->matb}}">
                            <input id="mahs" name="mahs" value="{{$model->mahs}}">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Nội dung*</b></label>
                                    <textarea type="text" id="noidung" rows="2" name="noidung" class="form-control">{{$model->noidung}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Người tạo*</b></label>
                                    <input type="text" id="ten" name="ten" class="form-control" value="{{$model->ten}}" />

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Số điện thoại*</b></label>
                                    <input type="text" id="sdt" name="sdt" class="form-control" value="{{$model->sdt}}"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Email*</b></label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{$model->email}}"/>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Yêu cầu*</b></label>
                                    <select id="yeucau" name="yeucau" class="form-control">
                                        <option value="tv" {{$model->yeucau == 'tv'?'selected':''}}>Tư vấn</option>
                                        <option value="gtvl" {{$model->yeucau == 'gtvl'?'selected':''}}>Giới thiệu việc làm</option>
                                        <option value="culd" {{$model->yeucau == 'culd'?'selected':''}}>Cung ứng lao động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="getdata">

                        <div class="col-xl-12">
                            <!--begin::Example-->
                            <!--begin::Card-->
                            <div class="card card-custom">
                                <div class="card-header card-header-tabs-line">
                                    <div class="card-title">
                                        <h5>Chi tiết vị trí tuyển dụng</h5>
                                    </div>
                      
                                </div>
                    
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%"> STT </th>
                                                    <th>Mã nghề cấp 2</th>
                                                    <th>Số lượng</th>
                                                    <th>Mô tả</th>
                                                    <th>Kinh nghiệm</th>
                                                    <th>nơi làm việc</th>
                                                    <th>Lương</th>
                                      
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($modelct != null) {
                                                
                                                  foreach ($modelct as $i => $item ){
                                                ?>
                                                <tr class="text-center">
                                                    <td>{{ ++$i }} </td>
                                                    <td>
                                                        @foreach ($dmmanghetrinhdo as $manghetd)
                                                            @if ($manghetd->madmmntd == $item->tencongviec)
                                                                <span>{{ $manghetd->tenmntd }}</span>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->soluong }}</td>
                                                    <td>{{ $item->mota }}</td>
                                                    <td>{{ $item->kinhnghiem }}</td>
                                                    <td>{{ $item->noilamviec }}</td>
                                                    <td>{{ $item->luong }}</td>

                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                    
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                            <!--end::Example-->
                        </div>
                    </div>

          
                </form>

            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>

@endsection
