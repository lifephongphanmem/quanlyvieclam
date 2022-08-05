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
                        <h3 class="card-label text-uppercase">Thông tin Người dùng</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ URL::to('/user-bn') }}" class="btn btn-xs btn-success mr-2">Tạo mới</a>
                    </div>
                </div>
                <div class="card-body">

                    <form class="form-inline" method="GET">
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <select class="input-sm form-control w-sm inline v-middle" name="cat_filter"
                                    onchange="this.form.submit()">
                                    <option value="0">Lọc theo nhóm</option>
                                    <?php foreach ($cats as $cat){ ?>
                                    <option value="{{ $cat->id }}" <?php if ($cat_filter == $cat->id) {
                                        echo 'selected';
                                    } ?>>{{ $cat->name }}</option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="col-sm-3 mr-2">
                                <select class="input-sm form-control w-sm inline v-middle" name="public_filter"
                                    onchange="this.form.submit()">
                                    <option value="0">Lọc theo tình trạng</option>
                                    <option value="1" <?php if ($public_filter == 1) {
                                        echo 'selected';
                                    } ?>>Hoạt động</option>
                                    <option value="2"<?php if ($public_filter == 2) {
                                        echo 'selected';
                                    } ?>>Không hoạt động</option>

                                </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control mr-2" placeholder="Search"
                                        name="search" value="{{ $search }}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </form>

                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Doanh nghiệp</th>
                                <th>Hoạt động</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($users)){
                    
                      
                    foreach ($users as $user) {     
                    
                    ?>
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td><a href="{{ URL::to('user-be') . '/' . $user->id }}">{{ $user->name }}</a></td>
                                <td><span class="text-ellipsis">{{ $user->email }} </span></td>
                                <td><span class="text-ellipsis">{{ $user->company }} </span></td>
                                <td><span class="text-ellipsis">
                                        <?php if ($user->public){ 
                      ?>
                                        <i class="fa fa-check text-success text-active"></i>
                                        <?php }else{ ?>
                                        <i class="fa fa-close text-success text-active" style="color:red"></i>

                                        <?php }?></span>
                                </td>
                                <td>

                                    <a href="{{ URL::to('user-bd') . '/' . $user->id }}"
                                        onclick="return confirm('Bạn muốn xóa người dùng?');"><i
                                            class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>

                            <?php 
                    } 
                 } 
                 ?>

                        </tbody>
                    </table>

                    <footer class="panel-footer">
                        <div class="row">

                            <div class="d-flex justify-content-center">
                                Tổng cộng {{ $users->total() }} kết quả
                                {!! $users->links('pagination::bootstrap-4') !!}
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
