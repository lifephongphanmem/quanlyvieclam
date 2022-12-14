{{-- <div id="tab1" class="tab-pane active"> --}}
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Họ tên <span class="require">*</span></label>
                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                    <input type="text" name="hoten" class="form-control" placeholder="Nhập đầy đủ Họ và Tên" value="{{isset($model)?$model->hoten:''}}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số CMND/CCCD (*)</label>
                    <input type="text" name="cmnd" class="form-control" placeholder="CMND/CCCD" value="{{isset($model)?$model->cmnd:''}}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày sinh (*)</label>
                    <input type="date" name="ngaysinh" class="form-control" value="{{isset($model)?$model->ngaysinh:''}}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Giới tính</label>
                    <select class="form-control input-sm m-bot5 select2basic" name="gioitinh">
                        <option value='Nam' {{isset($model)?($model->gioitinh=='Nam'?'selected':''):''}}>Nam</option>
                        <option value='Nữ'{{isset($model)?($model->gioitinh=='Nữ'?'selected':''):''}}>Nữ</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Dân tộc</label>
                    <input type="text" name="dantoc" placeholder="Tên dân tộc" class="form-control" value="{{isset($model)?$model->dantoc:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Đối tượng ưu tiên </label>
                    <select class="form-control input-sm m-bot15 select2basic" name="doituonguutien">
                        <option value=''>-- Chọn đối tượng --</option>
                        @foreach ($doituong_ut as $dt )
                            <option value="{{$dt->madmdt}}" {{isset($model)?($dt->madmdt == $model->doituonguutien?'selected':''):''}}>{{$dt->tendoituong}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Chức vụ </label>
                    <select class="form-control input-sm m-bot15 select2basic" name="chucvu">
                        <option value=''>-- Chọn chức vụ --</option>
                        @foreach ($chucvu as $cv )
                            <option value="{{$cv->id}}" {{isset($model)?($cv->id == $model->chucvu?'selected':''):''}}>{{$cv->tencv}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số điện thoại</label>
                    <input type="text" name="phone" placeholder="Số điện thoại" class="form-control" value="{{isset($model)?$model->phone:''}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Công ty</label>
                    @if (session('admin')->phanloaitk == 1)
                    <select class="form-control input-sm m-bot15 select2basic" name="company">
                        <option value=''>-- Chọn công ty --</option>
                        @foreach ($congty as $ct )
                            <option value="{{$ct->madv}}" {{isset($model)?($ct->madv == $model->company?'selected':''):''}}>{{$ct->name}}</option>
                        @endforeach
                    </select>
                    @else
                    <select class="form-control input-sm m-bot15 select2basic" name="company" disabled>
                        <option value=''>-- Chọn công ty --</option>
                        @foreach ($congty as $ct )
                            <option value="{{$ct->madv}}" {{isset($model)?($ct->madv == $model->company?'selected':''):''}}>{{$ct->name}}</option>
                        @endforeach
                    </select>
                    @endif

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Trình độ giáo dục </label>
                    <select class="form-control input-sm m-bot15 select2basic" name="trinhdogiaoduc">
                        <?php foreach ( $list_tdgd as $td){ ?>
                        <option value='{{ $td->madmgdpt }}' {{isset($model)?($td->madmgdpt == $model->trinhdogiaoduc?'selected':''):''}}>{{ $td->tengdpt }}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Trình độ CMKT </label>
                    <select class="form-control input-sm m-bot15 select2basic" name="trinhdocmkt">
                        <?php foreach ( $list_cmkt as $td){ ?>
                        <option value='{{ $td->madmtdkt }}' {{isset($model)?($td->madmtdkt == $model->trinhdocmkt?'selected':''):''}}>{{ $td->tentdkt }}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Chuyên ngành đào tạo</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="chuyenmondaotao">
                        <option value=''>-- Chọn chuyên ngành --</option>
                        @foreach ($list_linhvuc as $lv )
                            <option value="{{$lv->id}}" {{isset($model)?($lv->id == $model->chuyenmondaotao?'selected':''):''}}>{{$lv->tendm}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Nghề nghiệp</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="nghenghiep">
                        <option value=''>Chọn nghề nghiệp</option>
                        @foreach ($list_nghe as $lv )
                            <option value="{{$lv->id}}" {{isset($model)?($lv->id == $model->nghenghiep?'selected':''):''}}>{{$lv->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Tình trạng tham gia hoạt động kinh tế</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="tinhtrangvl" id='tinhtrangvl'>
                        <option value="">-- Chọn tình trạng --</option>
                        @foreach ($list_tinhtrangvl as $tt )
                        <option value="{{$tt->madmtgkt}}" {{isset($model)?($model->tinhtrangvl==$tt->madmtgkt?'selected':''):''}}>{{$tt->tentgkt}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Vị thế việc làm</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="vithevl" id='vithevl'>
                        <option value="">-- Chọn vị thế việc làm --</option>
                        @foreach ($a_vithevl as $vt )
                        <option value="{{$vt['madm']}}" {{isset($model)?($vt['madm'] == $model->vithevl?'selected':''):''}}>{{$vt['tendm']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Công việc đang làm</label>
                    <input type="text" class="form-control" name="cvhientai" value="{{isset($model)?$model->cvhientai:''}}">
                </div>
            </div> --}}
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Công việc hiện tại</label>
                        <input type="text" name='cvhientai' placeholder="Nhập công việc chính" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Vị trí việc làm</label>
                    {{-- <select class="form-control input-sm m-bot15 select2me" name="nghenghiep"> --}}
                    <select class="form-control input-sm m-bot15 select2basic" name="nghenghiep">
                        <option value=''>-- Chọn vi trí việc làm --</option>
                        @foreach ($list_vitri as $lv )
                            <option value="{{$lv->madmtgktct2}}" {{isset($model)?($lv->madmtgktct2 == $model->nghenghiep?'selected':''):''}}>{{$lv->tentgktct2}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Người thất nghiệp</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="thatnghiep" id='thatnghiep'>
                        <option value=''>-- Chọn  --</option>
                        @foreach ($a_nguoithatnghiep as $vt )
                        <option value="{{$vt['madm']}}" {{isset($model)?($vt['madm'] == $model->thatnghiep?'selected':''):''}}>{{$vt['tendm']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Thời gian thất nghiệp</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="thoigianthatnghiep" id='thoigianthatnghiep'>
                        <option value=''>-- Chọn thời gian --</option>
                        @foreach ($a_thoigianthatnghiep as $vt )
                        <option value="{{$vt['madm']}}" {{isset($model)?($vt['madm'] == $model->thoigianthatnghiep?'selected':''):''}}>{{$vt['tendm']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Lý do không tham gia HĐKT</label>
                    <select class="form-control input-sm m-bot15 select2basic" name="lydoktg" >
                        <option value=''>-- Chọn lý do --</option>
                        @foreach ($a_lydo_khongthamgia_hdkt as $vt )
                        <option value="{{$vt['madm']}}" {{isset($model)?($vt['madm'] == $model->lydoktg?'selected':''):''}}>{{$vt['tendm']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Thôn</label>
                        {{-- <textarea name="'thuongtru" rows="10" class="form-control">{{isset($model)?$model->thuongtru:''}}</textarea> --}}
                        {!! Form::text('address', isset($model)?$model->address:null, ['class' => 'form-control','placeholder'=>'Tổ dân phố/ Thôn/ Xóm']) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Xã</label>
                    {!! Form::select('xa', setArrayAll($a_xa, '-- Chọn xã --', ''), isset($model)?$model->xa:null, [
                        'class' => 'form-control select2basic',
                    ]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Địa chỉ tạm trú</label>
                    {!! Form::text('tamtru', isset($model)?$model->tamtru:null, ['class' => 'form-control','placeholder'=>'Thôn - Xã - Huyện']) !!}
                </div>
            </div>


        </div>
    </div>
    <input type="hidden" name='nation' value="VN">
{{-- </div> --}}
{{-- <script>
    $('#tinhtrangvl').on('change', function() {
        var tinhtrang = $(this).val();
        var html = '';
        if (tinhtrang == 0) {
            html += '<div class="col-md-3 ttvl"';
            html += '<div class="form-group">';
            html += '<label class="control-label">Vị thế việc làm</label>'
            html += '<select class="form-control input-sm m-bot15 select2basic" name="vithevl">';
            html += '<option value="1">Chủ cơ sở SXKD</option>';
            html += '<option value="2">Tự làm</option>';
            html += '<option value="3">Lao động gia đình</option>';
            html += '<option value="4">Làm công ăn lương</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Công việc đang làm</label>';
            html += '<input type="text" name="cvhientai" id="cvhientai" class="form-control" value="{{isset($model)?$model->cvhientai:''}}">';
            html += '</div>';
            html += '</div>';

            // html += '<div class="col-md-3 ttvl">';
            // html += '<div class="form-group">';
            // html += '<label class="control-label">Nơi làm việc</label>';
            // html += '<input type="text" name="company" id="noilv" class="form-control" value="{{isset($model)?$model->company:''}}">';
            // html += '</div>';
            // html += ' </div>';
        } else if(tinhtrang==1){
            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Người thất nghiệp</label>'
            html += '<select class="form-control input-sm m-bot15" name="thatnghiep">';
            html += '<option value="0">Chưa bao giờ làm việc</option>';
            html += '<option value="1">Đã từng làm việc</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';

            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Thời gian thất nghiệp</label>'
            html += '<select class="form-control input-sm m-bot15" name="thoigianthatnghiep">';
            html += '<option value="0">Dưới 3 tháng</option>';
            html += '<option value="1">Từ 3 tháng đến 1 năm</option>';
            html += '<option value="2">Trên 1 năm</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';
        }else if(tinhtrang == 2){
            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Lý do</label>'
            html += '<select class="form-control input-sm m-bot15" name="lydoktg">';
            html += '<option value="Đi học">Đi học</option>';
            html += '<option value="Hưu trí">Hưu trí</option>';
            html += '<option value="Nội trợ">Nội trợ</option>';
            html += '<option value="Khuyết tật">Khuyết tật</option>';
            html += '<option value="Khác">Khác</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';
        }
        $('#intinhtrang').find('.ttvl').remove()
        $('#intinhtrang').append(html)


    })
</script> --}}
