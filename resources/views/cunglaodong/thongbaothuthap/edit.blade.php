@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>

    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
    </script>
@stop
@section('content')
<form method="POST" action="{{'/cungld/thongbao/update/'.$model->id}}" accept-charset="UTF-8"  class="horizontal-form" id="them_thongbao" enctype="multipart/form-data">
    @csrf
    <div class="card card-custom wave wave-animate-slow wave-primary" style="min-height: 600px">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label text-uppercase">Thông tin thông báo</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-lg-6">
                    <label class="control-label">Tiêu đề<span class="require">*</span></label>
                    <input class="form-control" required="" autofocus="" value="{{$model->tieude}}" name="tieude" type="text">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-lg-12">
                    <label class="control-label">Nội dung</label>
                   <textarea name="noidung" id="" cols="" rows="5" class="form-control" >{{$model->noidung}}</textarea>
                </div>                
            </div>
        </div>
        <div class="card-footer">
            <div class="row text-center">
                <div class="col-lg-12">
                    <a href="{{'/cungld/thongbao'}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-check"></i>Hoàn thành</button>                    
                </div>
            </div>
        </div>
    </div>
    </form>
@stop