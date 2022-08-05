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
                        <h3 class="card-label text-uppercase">Cập nhật người dùng</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ URL::to('user-bn') }}" class="btn btn-xs btn-success mr-2">Tạo mới </a>
                        <a href="{{ URL::to('user-ba') }}" class="btn btn-xs btn-info">Trở về </a>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{ URL::to('user-bu') }}" enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Họ Tên </label>
                            <input type="text" name="name" class="form-control" required value="{{ $user->name }}">

                        </div>
                        <div class="form-group">
                            <label> Email </label>

                            <input type="email" name="email" class="form-control" required value="{{ $user->email }}">

                        </div>
                        <div class="form-group">
                            <label>Mật khẩu </label>

                            <input class="form-control" type="password" id="password" name="password" onkeyup='check();'
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Phải chứa ít nhất 1 chữ viết hoa, 1 chữ số, 1 chữ thường và nhiều hơn 8 ký tự">

                        </div>
                        <div class="form-group">
                            <label>Xác nhận mật khẩu</label>
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password"
                                onkeyup='check();'>
                            <span id='message'></span>
                        </div>


                        <div class="form-group">
                            <label>Hoạt động</label>
                            <select class="form-control input-sm m-bot5" name="public">
                                <option value='1' <?php if ($user->public) {
                                    echo 'selected';
                                } ?>>Có</option>
                                <option value='0' <?php if (!$user->public) {
                                    echo 'selected';
                                } ?>>Không</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại người dùng</label>
                            <select class="form-control input-sm m-bot5" name="level">
                                <option value='2' <?php if ($user->level == 2) {
                                    echo 'selected';
                                } ?>>Quản trị</option>
                                <option value='3' <?php if ($user->level == 3) {
                                    echo 'selected';
                                } ?>>Doanh nghiệp</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nhóm</label>
                            <select class="form-control input-sm m-bot5" name="category">
                                <?php foreach ($cats as $cat){ ?>
                                <option value="{{ $cat->id }}" <?php if ($user->category == $cat->id) {
                                    echo 'selected';
                                } ?>>{{ $cat->name }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type='hidden' name='id' value="{{ $user->id }}">

                        <button type="submit" class="btn btn-info">Cập nhật người dùng</button>
                    </form>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = '';
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Không trùng';
            }
        }
    </script>
@endsection
