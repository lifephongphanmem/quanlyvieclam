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
                        <h3 class="card-label text-uppercase">thông tin doanh nghiệp</h3>
                    </div>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_chung">Thông tin chung</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">Thống kê</a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="">
                                    <a class="dropdown-item" data-toggle="tab" href="#kt_tab_laodong">Theo lao động</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#kt_tab_cmkt">Theo trình độ
                                        CMKT</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#kt_tab_gddt">Theo lĩnh vực
                                        GDĐT</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#kt_tab_cmon">Theo lĩnh vực CM</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="kt_tab_chung" role="tabpanel">
                            <form role="form" method="POST" action="{{ URL::to('doanhnghiep-fu') }}"
                                enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                <table>
                                    <tr>
                                        <td>Mã số doanh nghiệp </td>
                                        <td>
                                            <input type="text" size=5 name="maso" value="44" readonly>
                                            <input type="text" size=20 name="id" value="{{ $info->id }}"
                                                readonly>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tên doanh nghiệp</td>
                                        <td><input type="text" class="form-control" name="name"
                                                value="{{ $info->name }}" required></td>
                                    </tr>
                                    <tr>
                                        <td>Mã số DKKD</td>
                                        <td><input type="text" class="form-control" id="dkkd" name="dkkd"
                                                value="{{ $info->dkkd }}" readonly required></td>
                                    </tr>
                                    <tr>
                                        <td>Tình trạng hoạt động</td>
                                        <td>
                                            Hoạt động <input type='radio' value='1' name='public'
                                                <?php if ($info->public) {
                                                    echo 'checked';
                                                } ?>>
                                            Dừng <input type='radio' value='0' name='public' <?php if (!$info->public) {
                                                echo 'checked';
                                            } ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại </td>
                                        <td><input type="text" name="phone" class="form-control"
                                                value="{{ $info->phone }}" required></td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td><input type="text" name="fax" value="{{ $info->fax }}"
                                                class="form-control"> </td>
                                    </tr>
                                    <tr>
                                        <td>Website</td>
                                        <td><input type="text" name="website" value="{{ $info->website }}"
                                                class="form-control"> </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><input type="email" name="email" value="{{ $info->email }}"
                                                class="form-control"required> </td>
                                    </tr>
                                    <tr>
                                        <td>Tỉnh</td>
                                        <td>
                                            <select class="form-control input-sm m-bot5" name="tinh" id='tinh'>
                                                <option value="44"> Quảng Bình </option>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Huyện/Thị xã/Thành phố </td>
                                        <td><select class="form-control input-sm m-bot5" name="huyen" id='huyen'>
                                                <?php foreach ($dmhc as $dv){
							if ($dv->level == 'Huyện' || $dv->level == 'Thành phố'||$dv->level =="Thị xã"){
							?>
                                                <option value='{{ $dv->maquocgia }}' <?php if ($dv->maquocgia == $info->huyen || $dv->name == $info->huyen) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $dv->name }}
                                                </option>
                                                <?php  }}?>

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Xã/Phường</td>
                                        <td>
                                            <select class="form-control input-sm m-bot5" name="xa" id="xa">
                                                <?php foreach ($dmhc as $dv){
							if ($dv->level =="Xã"||$dv->level =="Phường"||$dv->level =="Thị trấn"){
							?>
                                                <option class="{{ $dv->parent }}" value='{{ $dv->maquocgia }}'
                                                    <?php if ($dv->maquocgia == $info->xa || $dv->name == $info->xa) {
                                                        echo 'selected';
                                                    } ?>>{{ $dv->name }}</option>
                                                <?php } }?>


                                            </select>
                                            

                                            Thành thị <input type='radio' value='1' name='khuvuc'
                                                <?php if ($info->khuvuc) {
                                                    echo 'checked';
                                                } ?>>
                                            Nông thôn <input type='radio' value='0' name='khuvuc'
                                                <?php if (!$info->khuvuc) {
                                                    echo 'checked';
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td>
                                            <textarea type="text" class="form-control" name="adress" required>{{ $info->adress }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Khu công nghiệp</td>
                                        <td><select class="form-control input-sm m-bot5" name="khucn">
                                                <option value=0> Chọn khu công nghiệp </option>
                                                <?php foreach ($kcn as $dv){
						
							?>
                                                <option value='{{ $dv->id }}' <?php if ($dv->id == $info->khucn) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $dv->name }}
                                                </option>
                                                <?php  }?>


                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Loại hình doanh nghiệp</td>
                                        <td><select class="form-control input-sm m-bot5" name="loaihinh">
                                                <?php foreach ($ctype as $dv){
						
							?>
                                                <option value='{{ $dv->id }}' <?php if ($dv->id == $info->loaihinh) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $dv->name }}
                                                </option>
                                                <?php  }?>


                                            </select> </td>
                                    </tr>
                                    <tr>
                                        <td>Ngành nghề</td>
                                        <td> <select class="form-control input-sm m-bot5" name="nganhnghe">
                                                <?php foreach ($cfield as $dv){
						
							?>
                                                <option value='{{ $dv->id }}' <?php if ($dv->id == $info->nganhnghe) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $dv->name }}
                                                </option>
                                                <?php  }?>


                                            </select> </td>
                                    </tr>

                                </table>



                                <div>
                                    <hr>
                                </div>
                                <div>
                                    <input type='submit' value=" Cập nhật thông tin">
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_laodong" role="tabpanel">
                            <div>Tổng số lao động: {{ $info->tonghop['slld'] }}</div>
                            <div>Số lao động ngoại tỉnh: {{ $info->tonghop['slld'] - $info->tonghop['trongtinh'] }}</div>

                            <div>Số lao động nữ :{{ $info->tonghop['nu'] }}</div>
                            <div>Số lao động đã ký HĐLĐ (tổng/nữ): {{ $info->tonghop['dakyhd'] }}/
                                {{ $info->tonghop['nudakyhd'] }} </div>
                            <div>Số lao động nước ngoài (tổng/nữ): {{ $info->tonghop['nuocngoai'] }}/
                                {{ $info->tonghop['nunuocngoai'] }} </div>
                            <div>Số lao động đã tốt nghiệp phổ thông :{{ $info->tonghop['tnpt'] }}</div>

                            <h3>Tiền lương</h3>
                            <div>Lương bình quân :{{ $info->tonghop['avgluong'] }}</div>
                            <div>Lương thấp nhất :{{ $info->tonghop['minluong'] }}</div>
                            <div>Lương cao nhất :{{ $info->tonghop['maxluong'] }}</div>

                        </div>
                        <div class="tab-pane fade" id="kt_tab_cmkt" role="tabpanel">
                            <?php
							foreach($info->pbcmkt as $key =>$val) 
							{ ?>
                            <div>{{ $key }} : {{ $val }}</div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_gddt" role="tabpanel">
                            <?php
							foreach($info->pblvdt as $key =>$val) 
							{ ?>
                            <div>{{ $key }} : {{ $val }}</div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_cmon" role="tabpanel">
                            <?php
							foreach($info->pbnghenghiep as $key =>$val) 
							{ ?>
                            <div>{{ $key }} : {{ $val }}</div>
                            <?php } ?>
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
