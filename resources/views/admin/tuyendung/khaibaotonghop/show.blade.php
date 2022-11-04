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
                        <h3 class="card-label text-uppercase">THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>

                <div class="row" style="margin-top: 4%;margin-left: 1%">
                    <div class="col-md-4">
                        <label style="font-weight: bold">Doanh nghiệp</label>
                        <select class="form-control" id="masodn">
                            @foreach ($company as $item)
                                <option >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <form method="POST" action="{{ '/tuyen_dung/khai_bao/store_update' }}" accept-charset="UTF-8"
                    class="horizontal-form" id="frm_edit" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Nội dung*</b></label>
                                    <textarea type="text" id="noidung" rows="2" name="noidung" class="form-control">{{ $model->noidung}}</textarea>                          
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Số lượng tuyển dụng*</b></label>
                                    <input type="number" id="soluong" name="soluong" value="{{$model->soluong}}" class="form-control" style="font-weight: bold;text-align: right"/>
                                   
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Thời điểm tuyển dụng từ*</b></label>
                                    <input type="date" id="thoidiemtu" name="thoidiemtu" value="{{ $model->thoidiemtu}}"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="form-group fv-plugins-icon-container">
                                    <label><b>Thời điểm tuyển dụng đến*</b></label>
                                    <input type="date" id="thoidiemden" name="thoidiemden"
                                        value="{{$model->thoidiemden}}" class="form-control" />
                                </div>
                            </div>
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
