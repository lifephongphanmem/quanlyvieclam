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
                        <h3 class="card-label text-uppercase">Danh sách người lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-xs btn-icon btn-danger mr-2">
                            <i class="flaticon2-drop"></i><label>Nhập
                                <form class="form-inline" method="POST"
                                    action="{{ URL::to('laodong-fi') }} "
                                    enctype='multipart/form-data'>
                                    <input type="file" name="import_file"
                                        onchange="this.form.submit()" style="display:none;">
                                    {{ csrf_field() }}
                                </form>
                            </label>
                        </a>
                        <a href="#" class="btn btn-xs btn-icon btn-success mr-2">
                            <i class="flaticon2-gear"></i>
                        </a>
                        <a href="#" class="btn btn-xs btn-icon btn-primary">
                            <i class="flaticon2-bell-2"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="panel-body">

                            <div class="row ">
                                <div class="col-sm-12 col-sm-offset-0">

                                    <div class="function-menu pull-right">
                                        <ul class="nav navbar-nav">
                                            <li><a href="#"><i class="fa fa-user"></i>
                                                    </a>
                                            </li>



                                            <li><a href="{{ URL::to('/') }}/huongdan.xlsx" download><i
                                                        class="fa fa-file"></i> <button class="  " type="button">Hướng
                                                        dẫn điền dữ liệu</button></a></li>

                                            <li><a href="{{ URL::to('/') }}/maunhapnguoilaodong.xlsx" download><i
                                                        class="fa fa-file"></i> <button class="  " type="button">Tải
                                                        mẫu</button></a></li>
                                            <li><a href="{{ URL::to('laodong-ex') }}"><i class="fa fa-file"></i>
                                                    <button class="  " type="button">Tải danh sách
                                                        NLĐ</button></a></li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <form class="form-inline" id="formnld" method="GET" action="#collapsenld">
                                <div class="row ">
                                    <div class="col-sm-6 col-sm-offset-0">
                                        <label>Lọc theo tình trạng</label>
                                        <select class="input-sm form-control w-sm inline v-middle" name="state_filter"
                                            onchange="this.form.submit()">
                                            <option value="0">Tất cả</option>
                                            <option value="1" <?php if ($state_filter == 1) {
                                                echo 'selected';
                                            } ?>>Hoạt động</option>
                                            <option value="2"<?php if ($state_filter == 2) {
                                                echo 'selected';
                                            } ?>>Tạm dừng</option>
                                            <option value="3"<?php if ($state_filter == 3) {
                                                echo 'selected';
                                            } ?>>Đã báo giảm</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-3 ">
                                        <div class="function-search pull-right">

                                            <div class="input-group">
                                                <input type="text" name="search" class="input-sm form-control"
                                                    value="{{ $search }}" placeholder="Tìm theo Tên hoặc CCCD/CMND">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-default" type="submit">Tìm
                                                        kiếm</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="row ">
                                <div class="col-sm-12 col-sm-offset-0">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped  table-bordered">
                                            <thead>
                                                <td width="2%"> # </td>
                                                <td width="15%"> Họ và tên</td>
                                                <td width="13%"> Năm sinh</td>
                                                <td width="10%"> Giới tính</td>
                                                <td width="10%"> CMND/CCCD</td>
                                                <td width="30%"> Địa chỉ</td>
                                                <td width="10%"> Vị trí</td>
                                                <td width="10%"> <?php if ($action) {
                                                    echo 'Khai báo';
                                                } else {
                                                    echo 'Tình trạng';
                                                } ?></td>

                                            </thead>
                                            <tbody>
                                                <?php 
							$i=($lds->currentPage()-1)*$lds->perPage();
							foreach ($lds as $ld ){
								$i++;
						?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td> {{ $ld->hoten }}</td>
                                                    <td> {{ $ld->ngaysinh }}</td>
                                                    <td> {{ $ld->gioitinh == 'nam' || $ld->gioitinh == 'Nam' ? 'Nam' : 'Nữ' }}
                                                    </td>
                                                    <td> {{ $ld->cmnd }}</td>
                                                    <td> {{ $ld->address }} {{ $ld->xa }} {{ $ld->huyen }}
                                                        {{ $ld->tinh }}</td>
                                                    <td> {{ $ld->vitri }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('laodong-fe') . '/' . $ld->id . '/' . $action }}"
                                                            <?php if (!$action) {
                                                                echo "class='btn disabled'";
                                                            } ?>>
                                                            <?php
                                                            switch ($action) {
                                                                case 'tamdung':
                                                                    echo 'Tạm dừng';
                                                                    break;
                                                                case 'kethuctamdung':
                                                                    echo 'Kết thúc tạm dừng';
                                                                    break;
                                                                case 'delete':
                                                                    echo 'Báo giảm';
                                                                    break;
                                                                case 'update':
                                                                    echo 'Cập nhật';
                                                                    break;
                                                            
                                                                default:
                                                                    if ($ld->state == 1) {
                                                                        echo 'Đang hoạt động';
                                                                    }
                                                                    if ($ld->state == 2) {
                                                                        echo 'Đã tạm dừng';
                                                                    }
                                                                    if ($ld->state == 3) {
                                                                        echo 'Đã báo giảm';
                                                                    }
                                                            } ?>

                                                        </a>
                                                    </td>

                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="d-flex justify-content-center">
                                                Tổng cộng {{ $lds->total() }} kết quả
                                                {!! $lds->links('pagination::bootstrap-4') !!}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer"></div>


                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
