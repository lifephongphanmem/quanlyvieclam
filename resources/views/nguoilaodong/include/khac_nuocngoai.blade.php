<div id="tab2" class="tab-pane active">
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số giấy phép lao động</label>
                    <input type="text" name="sogpld"  class="form-control" value={{isset($model)?$model->sogpld:''}}>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày tháng năm cấp</label>
                    <input type="date" name="ngaycapsogpld" class="form-control" value={{isset($model)?$model->ngaycapsogpld:''}}>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Vị trí công việc</label>
                    <select class="form-control input-sm m-bot15 select2me" name="vitri">
                        <option value='Nhà quản lý' {{isset($model)?($model->vitri=='Nhà quản lý'?'selected':''):''}}>Nhà quản lý</option>
                        <option value='Giám đốc điều hành'{{isset($model)?($model->vitri=='Giám đốc điều hành'?'selected':''):''}}>Giám đốc điều hành</option>
                        <option value='Chuyên gia'{{isset($model)?($model->vitri=='Chuyên gia'?'selected':''):''}}>Chuyên gia</option>
                        <option value='Lao động kỹ thuật'{{isset($model)?($model->vitri=='Lao động kỹ thuật'?'selected':''):''}}>Lao động kỹ thuật</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Nghề công việc</label>
                    <select class="form-control input-sm m-bot15 select2me" name="nghecongviec">
                        @foreach ($dmnghecongviec as $cv)
                        <option value='{{$cv->id}}'>{{$cv->tendm}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Tên doanh nghiệp,tổ chức</label>
                <input type="text" name="tendn" class="form-control" value={{isset($model)?$model->tendn:''}}>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Mã số</label>
                    <input type="text" name="company" class="form-control" value={{isset($model)?$model->company:''}}>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Địa chỉ</label>
                    <input type="text" name="diachidn" class="form-control" value={{isset($model)?$model->diachidn:''}}>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Loại hình doanh nghiệp, tổ chức làm việc</label>
                    <select class="form-control input-sm m-bot15 select2me" name="loaidn">
                       
                        <option value='Doanh nghiệp nhà nước'>Doanh nghiệp nhà nước</option>
                        <option value='Doanh nghiệp có vốn đầu tư nước ngoài'>Doanh nghiệp có vốn đầu tư nước ngoài</option>
                        <option value='Doanh nghiệp ngoài nhà nước'>Doanh nghiệp ngoài nhà nước</option>
                       
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày bắt đầu công việc </label>
                    <input type="date" name="bdcv" class="form-control" value={{isset($model)?$model->bdcv:''}}>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày kết thúc công việc </label>
                    <input type="date" name="ktcv"  class="form-control" value={{isset($model)?$model->ktcv:''}}>
                </div>
            </div>
           
        </div>        
    </div>
</div>
