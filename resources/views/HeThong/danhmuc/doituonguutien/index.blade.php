@extends('HeThong.main')
@section('content')

<script>
    function delete_doituong(id){
        $('#frm_delete').find("[id='id_delete']").val(id);
    }
    function edit_doituong(){
        $('#frm_edit').submit();
    }
</script>

    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">DANH MỤC ĐỐI TƯỢNG ƯU TIÊN</h3>
                    </div>
                </div>
   
                <button style="" data-toggle="modal" data-target="#create_modal" class="btn btn-xs btn-icon btn-success mr-2" title="Thêm mới"><i class="fa fa-plus"></i></button>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th>Tên đối tượng</th>
                                    <th>Trạng thái</th>
                                    <th width="20%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($doituong as $dt ){
                                ?>
                                <tr class="text-center">
                                    <td>{{ $dt->stt }} </td>
                                    <td><span class="text-ellipsis"> </span> {{ $dt->tendoituong}}</td>
                                    <td><span class="text-ellipsis"> </span>{{$dt->trangthai}}</td>

                                    <td>
                                        <button title="Sửa thông tin" data-toggle="modal" data-target="#edit_modal" type="button" onclick="edit_doituong('{{$dt->id}}')" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        <button title="Xóa thông tin" data-toggle="modal" data-target="#delete_modal" type="button"  onclick="delete_doituong('{{$dt->id}}')"  class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm" data-toggle="modal">
                                            <i class="icon-lg flaticon-delete text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                Tổng cộng {{ $count }} kết quả
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



<!--create Modal-->
<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog  modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h3 class="card-label">
                   Thêm mới đối tượng
               </h3>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <i aria-hidden="true" class="ki ki-close"></i>
               </button>
           </div>
           <form action="{{'/danh_muc/dm_doi_tuong/store'}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group fv-plugins-icon-container">
                            <label><b>Tên danh mục đối tượng ưu tiên*</b></label>
                            <input type="text" id="tendoituong" name="tendoituong" class="form-control" />
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group fv-plugins-icon-container">
                            <label><b>Trạng thái*</b></label>
                           <select type="text" id="trangthai" name="trangthai" class="form-control">
                            <option value="kh">Kích hoạt</option>
                            <option value="kkh">Không kích hoạt</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="form-group fv-plugins-icon-container">
                            <label><b>STT*</b></label>
                            <input type="text" id="stt" name="stt" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-danger font-weight-bold">Thêm mới</button>
            </div>
        </form>

       </div>
   </div>
</div>



<!--Delete Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h3 class="card-label text-dark">
                   Đồng ý xóa thông tin???
               </h3>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <i aria-hidden="true" class="ki ki-close"></i>
               </button>
           </div>
           
        {!! Form::open(['/danh_muc/dm_doi_tuong/delete','id' => 'frm_delete'])!!}
            @csrf
           <div class="modal-body">
               <div class="row text-left">
                   <input id="id_delete" name="id_delete" type="" />
               </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Đóng</button>
               <button type="button" class="btn btn-primary font-weight-bold" >Đồng ý</button>
           </div>
        {!! Form::close() !!}
        
       </div>
   </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog  modal-lg" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h3 class="card-label text-dark">
                   Chỉnh sửa danh mục sản phẩm dịch vụ công ích
               </h3>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <i aria-hidden="true" class="ki ki-close"></i>
               </button>
           </div>
           <div class="modal-body" id="edit_thongtin">
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Hủy thao tác</button>
               <button type="button" class="btn btn-primary font-weight-bold" onclick="GetEdit()">Cập nhật</button>
           </div>
       </div>
   </div>
</div>

@endsection

