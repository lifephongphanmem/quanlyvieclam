<div id="tab1" class="tab-pane active">
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Họ tên <span class="require">*</span></label>
                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                    <input type="text" name="hoten" class="form-control" value="{{isset($model)?$model->hoten:''}}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số CMND/CCCD (*)</label>
                    <input type="text" name="cmnd" class="form-control" value="{{isset($model)?$model->cmnd:''}}" required>
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
                    <select class="form-control input-sm m-bot5" name="gioitinh">
                        <option value='Nam' selected>Nam</option>
                        <option value='Nữ'>Nữ</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Quốc tịch</label>
                <select class="form-control input-sm m-bot5" name="nation">
                    <?php foreach ( $countries_list as $key => $value){ ?>
                    <option value='{{ $key }}' <?php if ($key == 'VN') {
                        echo 'selected';
                    } ?>>{{ $value }}
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Dân tộc</label>
                    <input type="text" name="dantoc" class="form-control" value="{{isset($model)?$model->dantoc:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Chức vụ </label>
                    <input type="text" name="chucvu" id="chucvu" class="form-control" value="{{isset($model)?$model->chucvu:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Đối tượng ưu tiên </label>
                    <select class="form-control input-sm m-bot15" name="doituonguutien">
                        <option value=''>Chọn đối tượng</option>
                        <option value='Khuyết tật'>Người khuyết tật</option>
                        <option value='Hộ nghèo'>Thuộc hộ nghèo, cận nghèo</option>
                        <option value='dtts'>Dân tộc thiểu số</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Trình độ giáo dục </label>
                    <select class="form-control input-sm m-bot15" name="trinhdogiaoduc">
                        <?php foreach ( $list_tdgd as $td){ ?>
                        <option value='{{ $td->name }}'>{{ $td->name }}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Trình độ CMKT </label>
                    <select class="form-control input-sm m-bot15" name="trinhdocmkt">
                        <?php foreach ( $list_cmkt as $td){ ?>
                        <option value='{{ $td->name }}'>{{ $td->name }}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Chuyên ngành đào tạo</label>
                    <input type="text" name="chuyennganh" id="chuyennganh" class="form-control" value="{{isset($model)?$model->chuyennganh:''}}">
                </div>
            </div>


        </div>
        <div class="row" id='intinhtrang'>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Tình trạng tham gia hoạt động kinh tế</label>
                    <select class="form-control input-sm m-bot15" name="tinhtrangvl" id='tinhtrangvl'>
                        <option value="4">Chọn tình trạng</option>
                        <option value="0">Có việc làm</option>
                        <option value="1">Thất nghiệp</option>
                        <option value="2">Không tham gia</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Nơi đăng ký thường trú</label>
                    <textarea name="thuongtru" id="thuongtru" cols="" rows="3" class="form-control">{{isset($model)?$model->thuongtru:''}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Nơi ở hiện tại</label>
                    <textarea name="tamtru" id="tamtru" cols="" rows="3" class="form-control">{{isset($model)?$model->tamtru:''}}</textarea>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#tinhtrangvl').on('change', function() {
        var tinhtrang = $(this).val();
        console.log(1);
        var html = '';
        if (tinhtrang == 0) {
            html += '<div class="col-md-3 ttvl"';
            html += '<div class="form-group">';
            html += '<label class="control-label">Vị thế việc làm</label>'
            html += '<select class="form-control input-sm m-bot15 select2me" name="vithevl">';
            html += '<option value="">Chủ cơ sở SXKD</option>';
            html += '<option value="">Tự làm</option>';
            html += '<option value="">Lao động gia đình</option>';
            html += '<option value="">Làm công ăn lương</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Công việc đang làm</label>';
            html += '<input type="text" name="cvhientai" id="cvhientai" class="form-control" value="{{isset($model)?$model->cvhientai:''}}">';
            html += '</div>';
            html += '</div>';

            html += '<div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Nơi làm việc</label>';
            html += '<input type="text" name="company" id="noilv" class="form-control" value="{{isset($model)?$model->company:''}}">';
            html += '</div>';
            html += ' </div>';
        } else if(tinhtrang==1){
            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Người thất nghiệp</label>'
            html += '<select class="form-control input-sm m-bot15" name="thatnghiep">';
            html += '<option value="">Chưa bao giờ làm việc</option>';
            html += '<option value="">Đã từng làm việc</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';

            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Thời gian thất nghiệp</label>'
            html += '<select class="form-control input-sm m-bot15" name="thoigianthatnghiep">';
            html += '<option value="">Dưới 3 tháng</option>';
            html += '<option value="">Từ 3 tháng đến 1 năm</option>';
            html += '<option value="">Trên 1 năm</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';
        }else if(tinhtrang == 2){
            html += ' <div class="col-md-3 ttvl">';
            html += '<div class="form-group">';
            html += '<label class="control-label">Lý do</label>'
            html += '<select class="form-control input-sm m-bot15" name="lydoktg">';
            html += '<option value="">Đi học</option>';
            html += '<option value="">Hưu trí</option>';
            html += '<option value="">Nội trợ</option>';
            html += '<option value="">Khuyết tật</option>';
            html += '<option value="">Khác</option>';
            html += '</select>';
            html += '</div>';
            html += ' </div>';
        }
        $('#intinhtrang').find('.ttvl').remove()
        $('#intinhtrang').append(html)


    })
</script>
