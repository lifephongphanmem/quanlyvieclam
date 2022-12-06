{{-- <div id="tab2" class="tab-pane "> --}}
    <div class="form-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Phụ cấp chức vụ </label>
                    {{-- {!!Form::text('tencanbo', null, array('id' => 'tencanbo','class' => 'form-control', 'required'=>'required'))!!} --}}
                    <input type="text" name="pcchucvu"  class="form-control" value="{{isset($model)?$model->pcchucvu:''}}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Phụ cấp thâm niên</label>
                    <input type="text" name="pcthamnien" class="form-control" value="{{isset($model)?$model->pcthamnien:''}}">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Phụ cấp thâm niên nghề</label>
                    <input type="text" name="pcthamniennghe" class="form-control" value="{{isset($model)?$model->pcthamniennghe:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Phụ cấp lương</label>
                    <input type="text" name="pcluong" class="form-control" value="{{isset($model)?$model->pcluong:''}}">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Phụ cấp bổ sung</label>
                <input type="text" name="pcbosung" class="form-control" value="{{isset($model)?$model->pcbosung:''}}">
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày bắt đầu NN độc hại, nặng nhọc</label>
                    <input type="date" name="bddochai" class="form-control" value="{{isset($model)?$model->bddochai:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày kết thúc NN độc hại, nặng nhọc</label>
                    <input type="date" name="ktdochai" id="ktdochai" class="form-control" value="{{isset($model)?$model->ktdochai:''}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Loại HĐLĐ </label>
                    <select class="form-control input-sm m-bot15" name="loaihdld">
                            @foreach ($list_hdld as $hd )
                                <option value="{{$hd->madmlhl}}" {{isset($model)?($hd->madmlhl == $model->loaihdld?'selected':''):''}}>{{$hd->tenlhl}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày hiệu lực HĐLĐ </label>
                    <input type="date" name="bdhopdong" id="bdhopdong" class="form-control" value="{{isset($model)?$model->bdhopdong:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày kết thúc HĐLĐ </label>
                    <input type="date" name="kthopdong" id="kthopdong" class="form-control" value="{{isset($model)?$model->kthopdong:''}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Số sổ BHXH </label>
                    <input type="text" name="sobaohiem" id="sobaohiem" class="form-control" value="{{isset($model)?$model->sobaohiem:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày bắt đầu BHXH </label>
                    <input type="date" name="bdbhxh" id="bdbhxh" class="form-control" value="{{isset($model)?$model->bdbhxh:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Ngày kết thúc BHXH </label>
                    <input type="date" name="ktbhxh" id="ktbhxh" class="form-control" value="{{isset($model)?$model->ktbhxh:''}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Mức lương đóng BHXH </label>
                    <input type="text" name="luongbhxh" id="luongbhxh" class="form-control" value="{{isset($model)?$model->luongbhxh:''}}">
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
