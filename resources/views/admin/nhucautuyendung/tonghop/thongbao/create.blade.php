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
                        <h3 class="card-label text-uppercase">THÊM MỚI THÔNG BÁO</h3>
                    </div>
                </div>

                <div class="row" style="margin-top: 4%;margin-left: 1%">
                    <div class="col-md-4">
                        <p style="font-weight: bold">Người gửi: {{ $nguoigui->name }}</p>
                    </div>
                </div>


                <form method="POST" action="{{ '/tuyen_dung/thong_tin_tong_hop/store' }}" accept-charset="UTF-8" class="horizontal-form"
                    id="frm_edit" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Tiêu đề*</b></label>
                                    <input type="text" id="matttd" name="matttd" class="form-control" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Nội dung*</b></label>
                                    <textarea type="text" id="noidung" rows="2" name="noidung" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-lg-12" style="text-align: center">
                            <a href="{{ '/tuyen_dung/thong_tin_tong_hop/dot_thu_thap' }}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check"></i>Hoàn
                                thành</button>
                        </div>
                    </div>
                </form>

            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
