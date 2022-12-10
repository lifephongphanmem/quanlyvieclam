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
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">CHỈNH SỬA THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>


                <form method="POST" action="{{ '/tuyen_dung/khai_bao_nhu_cau/update' }}" accept-charset="UTF-8"
                    class="horizontal-form" id="frm_edit" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input id="matb" name="matb" value="{{ $model->matb }}" hidden>
                            <input id="mahs" name="mahs" value="{{ $model->mahs }}" hidden>
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Nội dung*</b></label>
                                    <textarea type="text" id="noidung" rows="2" name="noidung" class="form-control">{{ $model->noidung }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Người tạo*</b></label>
                                    <input type="text" id="ten" name="ten" class="form-control"
                                        value="{{ $model->ten }}" />

                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Số điện thoại*</b></label>
                                    <input type="text" id="sdt" name="sdt" class="form-control"
                                        value="{{ $model->sdt }}" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Email*</b></label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        value="{{ $model->email }}" />
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Yêu cầu*</b></label>
                                    <select id="yeucau" name="yeucau" class="form-control">
                                        <option value="tv" {{ $model->yeucau == 'tv' ? 'selected' : '' }}>Tư vấn</option>
                                        <option value="gtvl" {{ $model->yeucau == 'gtvl' ? 'selected' : '' }}>Giới thiệu việc
                                            làm</option>
                                        <option value="culd" {{ $model->yeucau == 'culd' ? 'selected' : '' }}>Cung ứng lao
                                            động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                @include('Caulaodong.khaibao.detail')

                <div class="card-footer">
                    <div class="col-lg-12" style="text-align: center">
                        <a href="{{ '/tuyen_dung/khai_bao_nhu_cau?matb=' . $matb }}" class="btn btn-danger"><i
                                class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        <button type="button"  onclick="valedate()" class="btn btn-primary mr-2"><i class="fa fa-check"></i>Hoàn
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
            $('#frm_edit').submit();
        }
    </script>
@endsection
