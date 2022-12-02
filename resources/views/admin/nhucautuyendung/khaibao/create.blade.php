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
                        <h3 class="card-label text-uppercase">THÊM MỚI THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>

                {{-- <div class="row" style="margin-top: 4%;margin-left: 1%">
                    <div class="col-md-4">
                        <label style="font-weight: bold">Doanh nghiệp</label>
                        <select class="form-control" id="masodn">
                            @foreach ($company as $item)
                                <option>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}


                <form method="POST" action="{{ '/tuyen_dung/khai_bao_nhu_cau/store' }}" accept-charset="UTF-8"
                    class="horizontal-form" id="frm_create" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input id="matb" name="matb" value="{{ $matb }}" hidden>
                            <input id="mahs" name="mahs" value="{{ $mahs }}" hidden>
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Nội dung*</b></label>
                                    <textarea type="text" id="noidung" rows="2" name="noidung" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Người tạo*</b></label>
                                    <input type="text" id="ten" name="ten" class="form-control" />

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Số điện thoại*</b></label>
                                    <input type="text" id="sdt" name="sdt" class="form-control" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Email*</b></label>
                                    <input type="text" id="email" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Yêu cầu*</b></label>
                                    <select id="yeucau" name="yeucau" class="form-control">
                                        <option value="tv">Tư vấn</option>
                                        <option value="gtvl">Giới thiệu việc làm</option>
                                        <option value="culd">Cung ứng lao động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                @include('admin.nhucautuyendung.khaibao.detail')

                <div class="card-footer">
                    <div class="col-lg-12" style="text-align: center">
                        <a href="{{ '/tuyen_dung/khai_bao_nhu_cau?matb=' . $matb }}" class="btn btn-danger"><i
                                class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        <button type="button" onclick="valedate()" class="btn btn-primary mr-2"><i class="fa fa-check"></i>Hoàn
                            thành</button>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <script>
        function valedate() {
            $('#frm_create').submit();

        }

    </script>
    
@endsection
