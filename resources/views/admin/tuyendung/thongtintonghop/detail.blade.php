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
                        <h3 class="card-label text-uppercase">DANH SÁCH THÔNG TIN NHU CẦU TUYỂN DỤNG</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2" width="5%"> STT </th>
                                    <th rowspan="2" >Nội dung</th>
                                    <th rowspan="2">Số lượng<br>tuyển</th>
                                    <th colspan="2">Thời điểm tuyển</th>
                                    <th rowspan="2">Đơn vị gửi</th>
                                    <th rowspan="2" width="6%">Thao tác</th>
                                </tr>
                                <tr class="text-center">
                                    <th width="6%">Từ</th>
                                    <th width="6%">Đến</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($model as $i => $item)
                                    <tr >
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td  width="40%">{{ $item->noidung }}</td>
                                        <td class="text-center">{{ $item->soluong }}</td>
                                        <td class="text-center">{{ $item->thoidiemtu }}</td>
                                        <td class="text-center">{{ $item->thoidiemden }}</td>
                                        <td>
                                            @foreach ($company as $item2)
                                                @if ($item2->masodn == $item->madn)
                                                    <span>{{ $item2->name }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a title="Xem thông tin" href="{{ '/tuyen_dung/khai_bao_tong_hop/xem?id=' .$item->id }}"
                                                type="button" class="btn btn-sm btn-clean btn-icon" target="_blank">
                                                <i class="icon-lg la flaticon-eye text-success"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-clean btn-icon"
                                                onclick="tralai('{{ $item->id }}')" title="Trả lại" data-toggle="modal"
                                                data-target="#tralai-modal">
                                                <i class="fa fa-reply text-danger "></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
              
                    </div>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            Tổng cộng {{ $count }} kết quả
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
            <div style="text-align: center">
                <a href="{{ '/tuyen_dung/thong_tin_tong_hop/' }}"
                    class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            </div>
        </div>
    </div>

    {{-- modal trả lại --}}
    <div id="tralai-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_tralai" method="post" action="/tuyen_dung/thong_tin_tong_hop/tralai" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý trả lại?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input id="id" name="id">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <div class="col-xl-12">
                                        <label><b>Lý do trả lại*</b></label>
                                        <textarea  id="lydo" name="lydo" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="button" onclick="submittl()" class="btn btn-primary">Đồng ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if (Session::has('success'))
        <script>
            toastr.success('{!! Session::get('success') !!}','Thành công');
        </script>
    @elseif (Session::has('error'))
        <script>
            toastr.error('{!! Session::get('error') !!}','Lỗi');
        </script>
    @endif
    <script>

        function tralai(id) {
            $('#frm_tralai').find("[name='id']").val(id);
        }

        function submittl() {
            if ($('#lydo').val().trim() == '') {
                toastr.error('Lý do trả lại không được để trống', 'Lỗi');
            } else {
                $('#frm_tralai').submit();
                // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // $.ajax({
                //     url: '/tuyen_dung/xet_duyet/tralai',
                //     type: 'POST',
                //     data: {
                //         _token: CSRF_TOKEN,
                //         id: $('#id').val(),
                //         lydo: $('#lydo').val()
                //     },
                //     dataType: 'JSON',
                //     success: function(data) {
                //         if (data == 'error') {
                //             location.reload();
                //             setInterval(toastr.error('thông tin chưa được trả lại', 'Lỗi'),5000);


                //         }
                //         if (data == 'success') {
                //             location.reload();
                //             setInterval(toastr.success('thông tin đã được trả lại', 'Thành công'),5000) ;
                //             // $('#tralai-modal').modal("hide");

                //         }
                //     }
                // })
            }
        }
    </script>
@endsection
