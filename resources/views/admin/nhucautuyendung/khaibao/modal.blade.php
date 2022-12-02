<!--create Modal-->
<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form id="frm_create" method="post">
        @csrf
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="card-label">
                        Thêm mới thông tin chi tiết
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="id" name="id">
                    <input type="text" id="mahs" name="mahs" value="{{ $mahs }}">
                    <input type="text" id="matb" name="matb" value="{{ $matb }}">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Mã nghề cấp 2*</b></label>
                                <select id="tencongviec" name="tencongviec" class="form-control">
                                    @foreach ($dmmanghetrinhdo as $item)
                                        <option value="{{ $item->madmmntd }}">{{ $item->tenmntd }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Số lượng*</b></label>
                                <input type="text" id="soluong" name="soluong" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Mô tả*</b></label>
                                <textarea type="text" id="mota" name="mota" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trình độ văn hóa*</b></label>
                                <select id="tdvanhoa" name="tdvanhoa" class="form-control">
                                    @foreach ($dmtrinhdogdpt as $item)
                                        <option value="{{ $item->madmgdpt }}">{{ $item->tengdpt }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trình độ kỹ thuật*</b></label>
                                <select id="tdkythuat" name="tdkythuat" class="form-control">
                                    @foreach ($dmtrinhdogdpt as $item)
                                        <option value="{{ $item->madmtdkt }}">{{ $item->tentdkt }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Chuyên ngành*</b></label>
                                <input type="text" id="chuyennganh" name="chuyennganh" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trình độ tin học*</b></label>
                                <input type="text" id="tdtinhoc" name="tdtinhoc" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Trình độ ngoại ngữ*</b></label>
                                <input type="text" id="tdngoaingu" name="tdngoaingu" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Kỹ năng mềm*</b></label>
                                <input type="text" id="kynangmem" name="kynangmem" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Kinh nghiệm*</b></label>
                                <input type="text" id="kinhnghiem" name="kinhnghiem" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Nơi làm việc*</b></label>
                                <input type="text" id="noilamviec" name="noilamviec" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Mức lương*</b></label>
                                <input type="text" id="luong" name="luong" class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Hỗ trợ ăn*</b></label>
                                <select id="hotroan" name="hotroan" class="form-control">
                                    <option value="0"> không </option>
                                    <option value="1"> 1 bữa </option>
                                    <option value="2"> 2 bữa </option>
                                    <option value="3"> 3 bữa </option>
                                    <option value="tien"> bằng tiền </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Phúc lợi khác*</b></label>
                                <textarea type="text" id="phucloikhac" name="phucloikhac" class="form-control"></textarea>
                            </div>
                        </div>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="store()" class="btn btn-danger font-weight-bold">Đồng ý</button>
                </div>

            </div>
        </div>
    </form>
</div>


<div id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <form id="frm_delete" method="post" accept-charset="UTF-8">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Bạn muốn xóa chi tiết vị trí?</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                </div>
                <div class="modal-footer">
                    <div class="col-xl-12">
                        <input id="id_delete" name="id_delete" hidden>
                    </div>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                    <button type="button" onclick="deletect()" class="btn btn-primary">Đồng ý</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    // function setcreate() {

    //     var form = $('#frm_create');
    //     // form.find("[name='id']").val(null);
    //     $('#id').val(null);
    //     // form.find("[name='mahs']").val('{{ $mahs }}');
    //     form.find("[name='tencongviec']").val('');
    //     form.find("[name='soluong']").val('');
    //     form.find("[name='mota']").val('');
    //     form.find("[name='tdvanhoa']").val('chua có');
    //     form.find("[name='tdkythuat']").val('');
    //     form.find("[name='chuyennganh']").val('');
    //     form.find("[name='tdtinhoc']").val('');
    //     form.find("[name='tdngoaingu']").val('');
    //     form.find("[name='kynangmem']").val('');
    //     form.find("[name='kinhnghiem']").val('');
    //     form.find("[name='noilamviec']").val('');
    //     form.find("[name='luong']").val('');
    //     form.find("[name='hotroan']").val('0');
    //     form.find("[name='phucloikhac']").val('');
    // }

    function setcreate() {

        $('#id').val(null);
        $('#tencongviec').val($manghefirst);
        $('#soluong').val('');
        $('#mota').val('');
        $('#tdvanhoa').val('chua có');
        $('#tdkythuat').val('');
        $('#chuyennganh').val('');
        $('#tdtinhoc').val('');
        $('#tdngoaingu').val('');
        $('#kynangmem').val('');
        $('#kinhnghiem').val('');
        $('#noilamviec').val('');
        $('#luong').val('');
        $('#hotroan').val('0');
        $('#phucloikhac').val('');
    }

    function store() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/tuyen_dung/khai_bao_nhu_cau/store_ct',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id: $('#id').val(),
                mahs: $('#mahs').val(),
                tencongviec: $('#tencongviec').val(),
                soluong: $('#soluong').val(),
                mota: $('#mota').val(),
                tdvanhoa: $('#tdvanhoa').val(),
                tdkythuat: $('#tdkythuat').val(),
                chuyennganh: $('#chuyennganh').val(),
                tdtinhoc: $('#tdtinhoc').val(),
                tdngoaingu: $('#tdngoaingu').val(),
                kynangmem: $('#kynangmem').val(),
                kinhnghiem: $('#kinhnghiem').val(),
                noilamviec: $('#noilamviec').val(),
                luong: $('#luong').val(),
                hotroan: $('#hotroan').val(),
                phucloikhac: $('#phucloikhac').val(),
            },

            dataType: 'JSON',
            success: function(result) {

                if (result.status == 'success') {

                    $('#getdata').replaceWith(result.message);
                    // location.reload();
                    $('#create_modal').modal("hide");
                }
            }
        })

    }


    function setdelete(id) {
        $('#frm_delete').find('#id_delete').val(id);
    }

    function deletect() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/tuyen_dung/khai_bao_nhu_cau/delete_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('#id_delete').val(),
            },
            dataType: 'JSON',
            success: function(result) {
                // console.log(result);
                if (result.status == 'success') {
                    $('#getdata').replaceWith(result.message);
                    // location.reload();
                    $('#delete-modal').modal("hide");
                }
            }
        })
    }

    // function setedit(id) {
    //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    //     $.ajax({
    //         url: '/tuyen_dung/khai_bao_nhu_cau/edit_ct',
    //         type: 'GET',
    //         data: {
    //             _token: CSRF_TOKEN,
    //             id: id
    //         },
    //         dataType: 'JSON',
    //         success: function(data) {
    //             console.log(data.id);
    //             var form = $('#frm_create');
    //             // form.find("[name='id']").val(data.id);
    //             $('#id').val(data.id);
    //             form.find("[name='mahs']").val(data.mahs);
    //             form.find("[name='tencongviec']").val(data.tencongviec);
    //             form.find("[name='soluong']").val(data.soluong);
    //             form.find("[name='mota']").val(data.mota);
    //             form.find("[name='tdvanhoa']").val(data.tdvanhoa);
    //             form.find("[name='tdkythuat']").val(data.tdkythuat);
    //             form.find("[name='chuyennganh']").val(data.chuyennganh);
    //             form.find("[name='tdtinhoc']").val(data.tdtinhoc);
    //             form.find("[name='tdngoaingu']").val(data.tdngoaingu);
    //             form.find("[name='kynangmem']").val(data.kynangmem);
    //             form.find("[name='kinhnghiem']").val(data.kinhnghiem);
    //             form.find("[name='noilamviec']").val(data.noilamviec);
    //             form.find("[name='luong']").val(data.luong);
    //             form.find("[name='hotroan']").val(data.hotroan);
    //             form.find("[name='phucloikhac']").val(data.phucloikhac);
    //         },
    //     });
    // }
    function setedit(id) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/tuyen_dung/khai_bao_nhu_cau/edit_ct',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data.id);

                $('#id').val(data.id);
                // $('#id').val(data.id);
                $('#tencongviec').val(data.tencongviec);
                $('#soluong').val(data.soluong);
                $('#mota').val(data.mota);
                $('#tdvanhoa').val(data.tdvanhoa);
                $('#tdkythuat').val(data.tdkythuat);
                $('#chuyennganh').val(data.chuyennganh);
                $('#tdtinhoc').val(data.tdtinhoc);
                $('#tdngoaingu').val(data.tdngoaingu);
                $('#kynangmem').val(data.kynangmem);
                $('#kinhnghiem').val(data.kinhnghiem);
                $('#noilamviec').val(data.noilamviec);
                $('#luong').val(data.luong);
                $('#hotroan').val(data.hotroan);
                $('#phucloikhac').val(data.phucloikhac);
            },
        });
    }
</script>
