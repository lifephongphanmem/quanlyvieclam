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
                        <h3 class="card-label text-uppercase">Danh sách Văn bản</h3>
                    </div>
                    <div class="card-toolbar">
						<a href="{{url('/messages/create')}}" class="btn btn-sm btn-success">Thêm mới</a>
                    </div>
                </div>
                <div class="card-body">
                    
					@include('pages.messenger.partials.flash')
					<table class="table table-striped  table-bordered">
						<thead>
							<td width="5%"> # </td>
							<td width="20%"> Tiêu đề</td>
							<td width="40%"> Nội dung</td>
							<td width="20%"> File đính kèm</td>
							<td width="15%"> Người gửi</td>	
						</thead>
						<tbody>
	
							@each('pages.messenger.partials.thread', $threads, 'thread', 'pages.messenger.partials.no-threads')
						</tbody>
					</table>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection