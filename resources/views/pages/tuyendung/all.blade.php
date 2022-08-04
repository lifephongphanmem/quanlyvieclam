@extends('HeThong.main')
@section('content')
    @if ($errors->has('import_file'))
        <div class="flash-message text-center">
            <p class="alert alert-danger ">{{ $errors->first('import_file') }}</p>
        </div>
    @endif

    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Các tuyển dụng gần đây</h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <div class="card-body">
                    <form class="form-inline" method="GET">
						<div class="row ">
							<div class="col-sm-12">
								<label>Lọc theo tình trạng</label>
								<select class="input-sm form-control w-sm inline v-middle" name="state_filter"
									onchange="this.form.submit()">
									<option value="0">Tất cả</option>
									<option value="1" <?php if ($state_filter == 1) {
										echo 'selected';
									} ?>>Đã xác nhận</option>
									<option value="2"<?php if ($state_filter == 2) {
										echo 'selected';
									} ?>>Đã báo cáo</option>
								</select>
							</div>
							<div class="col-sm-4 ">
							</div>
						</div>
			
					</form>
					<div class="row ">
						<div class="col-sm-12">
							<br>
							<div class="table-responsive">
								<table class="table table-striped  table-bordered">
									<thead class="text-center">
										<td width="5%"> # </td>
										<td width="20%"> Nội dung</td>
										<td width="25%"> Vị trí</td>
										<td width="10%"> Thời hạn</td>
										<td width="10%"> Ngày đăng</td>
										<td width="10%"> Tình trạng </td>
										<td width="10%"> Số LĐ đã tuyển</td>
										<td width="10%"> Chức năng </td>
			
									</thead>
									<tbody>
										<?php 
					$i=($tds->currentPage()-1)*$tds->perPage();
					foreach ($tds as $td ){
						$i++;
				?>
										<tr>
											<td>{{ $i }}</td>
											<td>
												<a href="{{ URL::to('tuyendung-fe') . '/' . $td->id }}">
													{{ $td->noidung }}
												</a>
											</td>
											<td> {!! $td->desc !!}</td>
											<td> {{ date('d-m-Y', strtotime($td->thoihan)) }}</td>
											<td> {{ date('d-m-Y', strtotime($td->created_at)) }}</td>
											<td>
												<?php
												switch ($td->state) {
													case '1':
														echo 'Đã xác nhận';
														break;
													case '2':
														echo 'Đã  báo cáo kết quả';
														break;
													default:
														echo 'Chưa xác nhận';
												} ?>
											</td>
											<td> {{ $td->datuyen ? $td->datuyen : 0 }}</td>
											<td>
												<a href="{{ URL::to('tuyendung-fr') . '/' . $td->id }}" <?php if ($td->state != 1) {
													echo "class='btn disabled'";
												} ?>>
													Báo cáo kết quả
												</a>
											</td>
			
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<div class="d-flex justify-content-center">
									Tổng cộng {{ $tds->total() }} kết quả
									{!! $tds->links('pagination::bootstrap-4') !!}
								</div>
							</div>
			
						</div>
					</div>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->

    
@endsection
