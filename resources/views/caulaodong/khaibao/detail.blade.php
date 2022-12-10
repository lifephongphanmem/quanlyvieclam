<div class="row" id="getdata">

    <div class="col-xl-12">
        <!--begin::Example-->
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header card-header-tabs-line">
                <div class="card-title">
                    <h5>Chi tiết vị trí tuyển dụng</h5>
                </div>
                <div class="card-toolbar">
                    <a onclick="setcreate()" data-toggle="modal" data-target="#create_modal" class="btn btn-success"
                        title="Thêm mới chi tiết"><i class="fa fa-plus"></i>thêm mới</a>
                </div>
            </div>

            <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th width="5%"> STT </th>
                                <th>Mã nghề cấp 2</th>
                                <th>Số lượng</th>
                                <th>Mô tả</th>
                                <th>Kinh nghiệm</th>
                                <th>nơi làm việc</th>
                                <th>Lương</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($modelct != null) {
                            
                              foreach ($modelct as $i => $item ){
                            ?>
                            <tr class="text-center">
                                <td>{{ ++$i }} </td>
                                <td>
                                    @foreach ($dmmanghetrinhdo as $manghetd)
                                        @if ($manghetd->madmmntd == $item->tencongviec)
                                            <span>{{ $manghetd->tenmntd }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->soluong }}</td>
                                <td>{{ $item->mota }}</td>
                                <td>{{ $item->kinhnghiem }}</td>
                                <td>{{ $item->noilamviec }}</td>
                                <td>{{ $item->luong }}</td>
                                <td>
                                    <a title="Sửa chi tiết" onclick="setedit({{ $item->id }})" data-toggle="modal"
                                        data-target="#create_modal" type="button"
                                        class="btn btn-sm btn-clean btn-icon">
                                        <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                    </a>
                                    <button title="Xóa" onclick="setdelete('{{ $item->id }}')"
                                        data-toggle="modal" data-target="#delete-modal"
                                        class="btn btn-sm btn-clean btn-icon">
                                        <i class="icon-lg flaticon-delete text-danger"></i>
                                    </button>

                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>

                    </table>
                
            </div>
        </div>
        <!--end::Card-->
        <!--end::Example-->
    </div>
</div>
@include('Caulaodong.khaibao.modal')
