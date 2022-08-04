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

                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div>
                                <h3>
                                    <?php switch ($action) {
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
                                    } ?>

                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="form-inline" method="GET">
                        <div class="row ">
                            <div class="col-sm-7 col-sm-offset-1">
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
                                </select>
                            </div>
                            <div class="col-sm-3 ">
                                <div class="function-search pull-right">
                                    <div class="input-group">
                                        <input type="text" name="search" class="input-sm form-control"
                                            value="{{ $search }}" placeholder="Tìm theo Tên hoặc CCCD/CMND">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="row ">
                        <div class="col-sm-12">
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
                                            <td> {{ $ld->gioitinh == 'nam' || $ld->gioitinh == 'Nam' ? 'Nam' : 'Nữ' }}</td>
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
                                    <tfoot>

                                    </tfoot>
                                </table>
                                <div class="d-flex justify-content-center">
                                    Tổng cộng {{ $lds->total() }} kết quả
                                    {!! $lds->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->

    
@endsection
