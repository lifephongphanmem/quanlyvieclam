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
                        <h3 class="card-label text-uppercase">DANH SÁCH NGƯỜI LAO ĐỘNG</h3>
                    </div>
                    <div class="card-toolbar">
                      <button class="btn btn-sm btn-success" name="export" value="1" type="submit">Xuất
                        Excel</button>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-inline" method="GET">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <select name="gioitinh_filter" class="input-sm form-control w-sm inline v-middle"
                                    onchange="this.form.submit()">
                                    <option value="0"> Chọn giới tính </option>
                                    <option value="Nam" <?php if ($gioitinh_filter == 'Nam') {
                                        echo 'selected';
                                    } ?>>Nam</option>
                                    <option value="Nữ" <?php if ($gioitinh_filter == 'Nữ') {
                                        echo 'selected';
                                    } ?>>Nữ</option>

                                </select>
                            </div>

                            <div class="col-sm-3">
                                <select name="state_filter" class="input-sm form-control w-sm inline v-middle"
                                    onchange="this.form.submit()">
                                    <option value="0" <?php if ($state_filter == '0') {
                                        echo 'selected';
                                    } ?>> Chọn tình trạng </option>
                                    <option value="1" <?php if ($state_filter == '1') {
                                        echo 'selected';
                                    } ?>> Hoạt động </option>
                                    <option value="2" <?php if ($state_filter == '2') {
                                        echo 'selected';
                                    } ?>> Tạm dừng </option>
                                    <option value="3" <?php if ($state_filter == '3') {
                                        echo 'selected';
                                    } ?>> Đang thất nghiệp </option>

                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="age_filter" class="input-sm form-control w-sm inline v-middle"
                                    onchange="this.form.submit()">
                                    <option value="0"> Lọc theo độ tuổi </option>
                                    <option value="35"<?php if ($age_filter == '35') {
                                        echo 'selected';
                                    } ?>> 35 tuổi trở lên </option>


                                </select>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="search" name="search"
                                        value="{{ $search }}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-info" type="submit">Tìm kiếm</button>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th width="5%"> STT </th>
                                    <th>Tên</th>
                                    <th>CMND</th>
                                    <th>Ngày sinh</th>
                                    <th>Công ty</th>
                                    <th>Tỉnh</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  $i=($lds->currentPage()-1)*$lds->perPage();
                                  foreach ($lds as $ld ){
                                    $i++;
                                ?>
                                <tr>
                                    <td>{{ $i }} </td>

                                    <td><a href="{{ URL::to('employer-be/' . $ld->id) }}">{{ $ld->hoten }}</a></td>
                                    <td><span class="text-ellipsis"> </span> {{ $ld->cmnd }}</td>
                                    <td><span class="text-ellipsis"> </span>{{ $ld->ngaysinh }}</td>
                                    <td><span class="text-ellipsis"> </span>{{ $ld->ctyname }}</td>
                                    <td><span class="text-ellipsis"> </span>{{ $ld->tinh }}</td>
                                </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">

                            <div class="d-flex justify-content-center">
                                Tổng cộng {{ $lds->total() }} kết quả
                                {!! $lds->appends([
                                        'age_filter' => $age_filter,
                                        'search' => $search,
                                        'state_filter' => $state_filter,
                                        'gioitinh_filter' => $gioitinh_filter,
                                    ])->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
