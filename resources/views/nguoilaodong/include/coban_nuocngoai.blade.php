<div id="tab1" class="tab-pane active">
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Họ tên <span class="require">*</span></label>
                    <input type="text" name="hoten" class="form-control" value="{{isset($model)?$model->hoten:''}}" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số hộ chiếu</label>
                    <input type="text" name="cmnd" class="form-control" value="{{isset($model)?$model->sohc:''}}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày cấp</label>
                    <input type="date" name="ngaycapsohc" class="form-control" value="{{isset($model)?$model->ngaycapsohc:''}}" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày sinh (*)</label>
                    <input type="date" name="ngaysinh" class="form-control" value="{{isset($model)?$model->ngaysinh:''}}" required>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Quốc tịch</label>
                <select class="form-control input-sm m-bot5 select2basic" name="nation">
                    <?php foreach ( $countries_list as $key => $value){ ?>
                    <option value='{{ $value }}' {{isset($model)?($model->nation==$value?'selected':''):''}}>{{ $value }}
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Giới tính</label>
                    <select class="form-control input-sm m-bot5 select2basic" name="gioitinh">
                        <option value='Nam' {{isset($model)?($model->gioitinh=='Nam'?'selected':''):''}}>Nam</option>
                        <option value='Nữ' {{isset($model)?($model->gioitinh=='Nữ'?'selected':''):''}}>Nữ</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Trình độ</label>
                    <select class=" form-control input-sm m-bot5 select2basic" name="trinhdo">
                        <option value='Chứng chỉ đào tạo'{{isset($model)?($model->trinhdo=='Chứng chỉ đào tạo'?'selected':''):''}}>Chứng chỉ đào tạo</option>
                        <option value='Chứng chỉ hành nghề'{{isset($model)?($model->trinhdo=='Chứng chỉ hành nghề'?'selected':''):''}}>Chứng chỉ hành nghề</option>
                        <option value='Đại học'{{isset($model)?($model->trinhdo=='Đại học'?'selected':''):''}}>Đại học</option>
                        <option value='Thạc sĩ'{{isset($model)?($model->trinhdo=='Thạc sĩ'?'selected':''):''}}>Thạc sĩ</option>
                        <option value='Tiến sĩ'{{isset($model)?($model->trinhdo=='Tiến sĩ'?'selected':''):''}}>Tiến sĩ</option>

                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Chuyên môn đào tạo</label>
                    <select class="form-control input-sm m-bot5 select2basic
                    " name="chuyenmondaotao">
                        @foreach ($dmchuyenmon as $cm )
                        <option value='{{$cm->id}}'{{isset($model)?($model->chuyenmondaotao==$cm->id?'selected':''):''}}>{{$cm->tendm}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

