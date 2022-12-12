@extends('HeThong.main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/pages/dataTables.bootstrap.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('assets/css/pages/select2.css') }}" /> --}}
@stop

@section('custom-script-footer')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/assets/js/pages/select2.js"></script>
    <script src="/assets/js/pages/jquery.dataTables.min.js"></script>
    <script src="/assets/js/pages/dataTables.bootstrap.js"></script>
    <script src="/assets/js/pages/table-lifesc.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            TableManaged4.init();
            TableManaged5.init();
            TableManagedclass.init();
        });
    </script>
@stop

@section('content')
    <!--begin::Card-->

    <div class="card card-custom" style="min-height: 600px">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label text-uppercase">Thông tin dự báo nhu cầu lao động</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>

        {!! Form::model($model, [
            'method' => 'POST',
            'url' => $inputs['url'] . 'Sua',
            'class' => 'form',
            'id' => 'frm_ThayDoi',
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!}
        {{ Form::hidden('madv', null, ['id' => 'madv']) }}
        <div class="card-body">
            <h4 class="text-dark font-weight-bold mb-5">Thông tin chung</h4>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Tên đơn vị</label>
                    {!! Form::text('tendonvi', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>

                <div class="col-lg-3">
                    <label>Số tờ trình</label>
                    {!! Form::text('sototrinh', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-3">
                    <label>Ngày tháng trình<span class="require">*</span></label>
                    {!! Form::input('date', 'ngayhoso', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Chức vụ người ký tờ trình</label>
                    {!! Form::text('chucvunguoiky', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-lg-6">
                    <label>Họ tên người ký tờ trình</label>
                    {!! Form::text('nguoikytotrinh', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Mô tả hồ sơ</label>
                    {!! Form::textarea('noidung', null, ['class' => 'form-control', 'rows' => 2]) !!}
                </div>
            </div>          
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom">
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_cung">
                                            <span class="nav-icon">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <span class="nav-text">Thông tin cung</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_cau">
                                            <span class="nav-icon">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <span class="nav-text">Thông tin cầu</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_khac">
                                            <span class="nav-icon">
                                                <i class="far fa-user"></i>
                                            </span>
                                            <span class="nav-text">Thông tin khác</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-toolbar">
            
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="kt_cung" role="tabpanel" aria-labelledby="kt_cung">
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-right">
                                            <div class="btn-group" role="group">
                                                <button type="button" onclick="setTapThe()" data-target="#modal-create-tapthe"
                                                    data-toggle="modal" class="btn btn-light-dark btn-icon btn-sm">
                                                    <i class="fa fa-plus"></i></button>
                                                <button onclick="setNhanExcel('{{ $model->mahosotdkt }}')"
                                                    title="Nhận từ file Excel" data-target="#modal-nhanexcel" data-toggle="modal"
                                                    type="button" class="btn btn-info btn-icon btn-sm"><i
                                                        class="fas fa-file-import"></i></button>
                                                <a target="_blank" title="Tải file mẫu" href="/data/download/MauTDKT.xlsx"
                                                    class="btn btn-primary btn-icon btn-sm"><i class="fa flaticon-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row" id="dskhenthuongtapthe">
                                        <div class="col-md-12">
                                            <table id="sample_4" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">STT</th>
                                                        <th>Tên tập thể</th>
                                                        <th>Phân loại<br>đối tượng</th>
                                                        <th>Danh hiệu thi đua/<br>Hình thức khen thưởng </th>
                                                        <th>Loại hình khen thưởng</th>
                                                        <th width="10%">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($model_cung as $key => $tt)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center">{{ $i++ }}</td>
                                                            <td>{{ $tt->tentapthe }}</td>
                                                            <td>{{ $a_tapthe[$tt->maphanloaitapthe] ?? '' }}</td>
                                                            <td class="text-center">
                                                                {{ $a_dhkt_tapthe[$tt->madanhhieukhenthuong] ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $a_loaihinhkt[$model->maloaihinhkt] ?? '' }}
                                                            </td>
            
                                                            <td class="text-center">
                                                                <button title="Sửa thông tin" type="button"
                                                                    onclick="getTapThe('{{ $tt->id }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-create-tapthe" data-toggle="modal">
                                                                    <i class="icon-lg la fa-edit text-primary"></i>
                                                                </button>
                                                                <button title="Xóa" type="button"
                                                                    onclick="delKhenThuong('{{ $tt->id }}',  '{{ $inputs['url'] . 'XoaTapThe' }}', 'TAPTHE')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-delete-khenthuong" data-toggle="modal">
                                                                    <i class="icon-lg la fa-trash text-danger"></i>
                                                                </button>
                                                                {{-- <button title="Tiêu chuẩn" type="button"
                                                                    onclick="getTieuChuan('{{ $tt->id }}','TAPTHE','{{ $tt->tentapthe }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-tieuchuan" data-toggle="modal">
                                                                    <i class="icon-lg la fa-list text-dark"></i>
                                                                </button> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="tab-pane fade" id="kt_cau" role="tabpanel" aria-labelledby="kt_cau">
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-right">
                                            <div class="btn-group" role="group">
                                                <button type="button" onclick="setHoGiaDinh()"
                                                    data-target="#modal-create-hogiadinh" data-toggle="modal"
                                                    class="btn btn-light-dark btn-icon btn-sm">
                                                    <i class="fa fa-plus"></i></button>
                                                <button title="Nhận từ file Excel" data-target="#modal-nhanexcel"
                                                    data-toggle="modal" type="button" class="btn btn-info btn-icon btn-sm"><i
                                                        class="fas fa-file-import"></i></button>
                                                <a target="_blank" title="Tải file mẫu" href="/data/download/MauTDKT.xlsx"
                                                    class="btn btn-primary btn-icon btn-sm"><i class="fa flaticon-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row" id="dskhenthuonghogiadinh">
                                        <div class="col-md-12">
                                            <table id="sample_5" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="5%">STT</th>
                                                        <th>Tên hộ gia đình</th>
                                                        {{-- <th>Phân loại<br>đối tượng</th> --}}
                                                        <th>Danh hiệu thi đua/<br>Hình thức khen thưởng </th>
                                                        <th>Loại hình khen thưởng</th>
                                                        <th width="10%">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($model_hogiadinh as $key => $tt)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center">{{ $i++ }}</td>
                                                            <td>{{ $tt->tentapthe }}</td>
                                                            {{-- <td>{{ $a_hogiadinh[$tt->maphanloaitapthe] ?? '' }}</td> --}}
                                                            <td class="text-center">
                                                                {{ $a_dhkt_hogiadinh[$tt->madanhhieukhenthuong] ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $a_loaihinhkt[$model->maloaihinhkt] ?? '' }}
                                                            </td>
            
                                                            <td class="text-center">
                                                                <button title="Sửa thông tin" type="button"
                                                                    onclick="getHoGiaDinh('{{ $tt->id }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-create-hogiadinh" data-toggle="modal">
                                                                    <i class="icon-lg la fa-edit text-primary"></i>
                                                                </button>
                                                                <button title="Xóa" type="button"
                                                                    onclick="delKhenThuong('{{ $tt->id }}',  '{{ $inputs['url'] . 'XoaHoGiaDinh' }}', 'HOGIADINH')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-delete-khenthuong" data-toggle="modal">
                                                                    <i class="icon-lg la fa-trash text-danger"></i>
                                                                </button>
                                                                {{-- <button title="Tiêu chuẩn" type="button"
                                                                    onclick="getTieuChuan('{{ $tt->id }}','TAPTHE','{{ $tt->tentapthe }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-tieuchuan" data-toggle="modal">
                                                                    <i class="icon-lg la fa-list text-dark"></i>
                                                                </button> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="tab-pane fade" id="kt_khac" role="tabpanel" aria-labelledby="kt_khac">
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-right">
                                            <div class="btn-group" role="group">
                                                <button title="Thêm đối tượng" type="button" data-target="#modal-create"
                                                    data-toggle="modal" class="btn btn-light-dark btn-icon btn-sm"
                                                    onclick="setCaNhan()">
                                                    <i class="fa fa-plus"></i></button>
            
                                                <button title="Nhận từ file Excel" data-target="#modal-nhanexcel"
                                                    data-toggle="modal" type="button" class="btn btn-info btn-icon btn-sm"><i
                                                        class="fas fa-file-import"></i></button>
            
                                                <a target="_blank" title="Tải file mẫu" href="/data/download/MauTDKT.xlsx"
                                                    class="btn btn-primary btn-icon btn-sm"><i class="fa flaticon-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row" id="dskhenthuongcanhan">
                                        <div class="col-md-12">
                                            <table id="sample_3" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="2%">STT</th>
                                                        <th>Tên đối tượng</th>
                                                        {{-- <th width="8%">Ngày sinh</th> --}}
                                                        <th width="5%">Giới</br>tính</th>
                                                        <th width="15%">Phân loại cán bộ</th>
                                                        <th>Thông tin công tác</th>
                                                        <th>Hình thức khen thưởng /<br>Danh hiệu thi đua</th>
                                                        <th>Loại hình khen thưởng</th>
                                                        <th width="10%">Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($model_canhan as $key => $tt)
                                                        <tr class="odd gradeX">
                                                            <td class="text-center">{{ $i++ }}</td>
                                                            <td>{{ $tt->tendoituong }}</td>
                                                            {{-- <td class="text-center">{{ getDayVn($tt->ngaysinh) }}</td> --}}
                                                            <td>{{ $tt->gioitinh }}</td>
                                                            <td>{{ $a_canhan[$tt->maphanloaicanbo] ?? '' }}</td>
                                                            <td class="text-center">
                                                                {{ $tt->chucvu . ',' . $tt->tenphongban . ',' . $tt->tencoquan }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $a_dhkt_canhan[$tt->madanhhieukhenthuong] ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $a_loaihinhkt[$model->maloaihinhkt] ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                <button title="Sửa thông tin" type="button"
                                                                    onclick="getCaNhan('{{ $tt->id }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-create" data-toggle="modal">
                                                                    <i class="icon-lg la fa-edit text-primary"></i>
                                                                </button>
                                                                <button title="Xóa" type="button"
                                                                    onclick="delKhenThuong('{{ $tt->id }}',  '{{ $inputs['url'] . 'XoaCaNhan' }}', 'CANHAN')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-delete-khenthuong" data-toggle="modal">
                                                                    <i class="icon-lg la fa-trash text-danger"></i>
                                                                </button>
                                                                {{-- <button title="Tiêu chuẩn" type="button"
                                                                    onclick="getTieuChuan('{{ $tt->id }}','CANHAN','{{ $tt->tendoituong }}')"
                                                                    class="btn btn-sm btn-clean btn-icon"
                                                                    data-target="#modal-tieuchuan" data-toggle="modal">
                                                                    <i class="icon-lg la fa-list text-dark"></i>
                                                                </button> --}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
        <div class="card-footer">
            <div class="row text-center">
                <div class="col-lg-12">
                    <a href="{{ url($inputs['url_hs'] . 'ThongTin?madonvi=' . $model->madonvi) }}"
                        class="btn btn-danger mr-5"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Hoàn thành</button>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!--end::Card-->
   

@stop
