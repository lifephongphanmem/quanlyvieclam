@extends('HeThong.main')
@section('content')
    @if ($errors->has('import_file'))
        <div class="flash-message text-center">
            <p class="alert alert-danger ">{{ $errors->first('import_file') }}</p>
        </div>
    @endif

    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Báo tăng lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ URL::to('laodong-fs') }}" enctype='multipart/form-data'>
                        {{ csrf_field() }}

                        <div class="row ">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Nội dung (*)</label>
                                    <textarea name="note" class="form-control"rows='8'> </textarea>
                                </div>
                            </div>
                            <div class="col-sm-2 ">
                                <div class="form-group">
                                    <label>Người khai báo</label>
                                    <input type="text" name="username" class="form-control" readonly
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Ngày khai báo</label>
                                    <input type="text" name="date_create" class="form-control" readonly
                                        value="{{ date('d/m/Y') }}">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control" readonly
                                        value="1">
                                </div>
                            </div>

                        </div>

                        <div class="panel-body" id='dynamicTable'>

                            <div class="row" id="1stld">
                                <fieldset class="col-lg-12">
                                    <legend class="w-auto px-3">
                                        <button type="button" class="btn btn-success">Người lao động</button>
                                    </legend>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Họ và Tên (*)</label>
                                            <input type="text" name="hoten[]" class="form-control" required>
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Số CMND/CCCD (*)</label>
                                            <input type="text" name="cmnd[]" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label> Giới tính (*) </label>
                                            <select class="form-control input-sm m-bot5" name="gioitinh[]">
                                                <option value='nam' selected>Nam</option>
                                                <option value='nu'>Nữ</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Ngày tháng năm sinh (*)</label>
                                            <input type="date" name="ngaysinh[]" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Quốc tịch (*)</label>
                                            <select class="form-control input-sm m-bot5" name="nation[]">
                                                <?php foreach ( $countries_list as $key => $value){ ?>
                                                <option value='{{ $key }}' <?php if ($key == 'VN') {
                                                    echo 'selected';
                                                } ?>>{{ $value }}
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Dân tộc (*)</label>
                                            <input type="text" name="dantoc[]" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Tỉnh (*)</label>
                                            <input type="text" name="tinh[]" class="form-control" required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Huyện Thị (*)</label>
                                            <input type="text" name="huyen[]" class="form-control">
                                        </div>
                                    </div>

                                    

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Phường xã (*)</label>
                                            <input type="text" name="xa[]" class="form-control">
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Địa chỉ (*)</label>
                                            <input type="text" name="address[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Vị trí </label>
                                            <input type="text" name="vitri[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Chức vụ</label>
                                            <input type="text" name="chucvu[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Trình độ Giáo dục</label>
                                            <select class="form-control input-sm m-bot15" name="trinhdogiaoduc[]">
                                                <?php foreach ( $list_tdgd as $td){ ?>
                                                <option value='{{ $td->name }}'>{{ $td->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Trình độ CMKT</label>
                                            <select class="form-control input-sm m-bot15" name="trinhdocmkt[]">
                                                <?php foreach ( $list_cmkt as $td){ ?>
                                                <option value='{{ $td->name }}'>{{ $td->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Ngành nghề </label>
                                            <select class="form-control input-sm m-bot15" name="nghenghiep[]">

                                                <?php foreach ( $list_nghe as $td){ ?>
                                                <option value='{{ $td->name }}'>{{ $td->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Lĩnh vực đào tạo </label>
                                            <select class="form-control input-sm m-bot15" name="linhvucdaotao[]">

                                                <?php foreach ( $list_linhvuc as $td){ ?>
                                                <option value='{{ $td->name }}'>{{ $td->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Mức lương (*)</label>
                                            <input type="text" name="luong[]" data-type="currency"
                                                class="form-control" required>
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Phụ cấp chức vụ</label>
                                            <input type="text" name="pcchucvu[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Phụ cấp thâm niên</label>
                                            <input type="text" name="pcthamnien[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Phụ cấp thâm niên nghề</label>
                                            <input type="text" name="pcthamniennghe[]" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Phụ cấp lương</label>
                                            <input type="text" name="pcluong[]" class="form-control">
                                        </div>
                        
                                        <div class="col-lg-3">
                                            <label>Phụ cấp bổ sung</label>
                                            <input type="text" name="pcbosung[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Ngày bắt đầu NN độc hại, nặng nhọc </label>
                                            <input type="date" name="bddochai[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Ngày kết thúc NN độc hại, nặng nhọc </label>
                                            <input type="date" name="ktdochai[]" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Loại HĐLĐ</label>
                                            <select class="form-control input-sm m-bot15" name="loaihdld[]">

                                                <?php foreach ( $list_hdld as $td){ ?>
                                                <option value='{{ $td->name }}'>{{ $td->name }}</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ngày hiệu lực HĐLD</label>
                                            <input type="date" name="bdhopdong[]" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ngày hết hiệu lực HĐLD</label>
                                            <input type="date" name="kthopdong[]" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Số sổ bảo hiểm</label>
                                            <input type="text" name="sobaohiem[]" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Ngày bắt đầu BHXH</label>
                                            <input type="date" name="bdbhxh[]" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Ngày kết thúc BHXH</label>
                                            <input type="date" name="ktbhxh[]" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Mức lương đóng BHXH</label>
                                            <input type="text" name="luongbhxh[]" class="form-control">
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Tuyển dụng từ TTDVVL</label>
                                            <select class="form-control input-sm m-bot5" name="fromttdvvl[]">
                                                <option value='1' selected>Đúng</option>
                                                <option value='0'>Sai</option>

                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label>Ghi chú</label>
                                            <textarea name="ghichu[]" class="form-control"rows='2'> </textarea>
                                        </div>
                                    </div>

                                </fieldset>


                            </div>

                        </div>

                        <input type="hidden" name="isnew" value='1'>
                        <input type="hidden" name="id[]" value='0'>
                        <div class="row ">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button type="button" name="add" id="add" class="btn btn-success">
                                    <h4> Thêm người lao động </h4>
                                </button>
                                <button type="button" class="btn btn-danger" id='remove'>
                                    <h4> Giảm </h4>
                                </button>
                                <button type="submit" class="btn btn-info btn-lg pull-right">
                                    <h4>Khai báo</h4>
                                </button>



                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->

    <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open([
            'url' => '/laodong-fi',
            'method' => 'post',
            'id' => 'thoai_nhanexcel',
            'class' => 'form-horizontal form-validate',
        ]) !!}
        <div class="modal-dialog modal-content">
            <div class="modal-header modal-header-primary">
                <h4 id="modal-header-primary-label" class="modal-title">Nhận danh sách cán bộ từ file Excel</h4>
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="file" name="import_file" onchange="this.form.submit()">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
