@extends('pages.layout')
@section('mainpanel')
<section class="panel">
	<header class="panel-heading">
		<div class="row ">
			<div class="col-sm-8 col-sm-offset-2">


				<h3> Danh sách biến động</h3>


			</div>
		</div>
	</header>

	<form class="form-inline" method="GET">
		<div class="row ">
			<div class="col-sm-7 col-sm-offset-1">
				<label>Lọc theo kỳ</label>
				<select class="input-sm form-control w-sm inline v-middle" name="time_filter" onchange="this.form.submit()">
					<option value="1" <?php if ($time_filter == 1) {
											echo "selected";
										} ?>>Kì hiện tại</option>
					<option value="2" <?php if ($time_filter == 2) {
											echo "selected";
										} ?>>Kỳ trước</option>
					<option value="3" <?php if ($time_filter == 3) {
											echo "selected";
										} ?>>Năm hiện tại</option>

				</select>
			</div>
			<div class="col-sm-3 ">
				<div class="function-search pull-right">
					<div class="input-group">

					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="row ">
		<div class="col-sm-10 col-sm-offset-1">

			<br>
			<div class="table-responsive ">
				<table class="table table-striped  table-bordered">
					<thead>
						<td width="5%"> # </td>
						<td width="10%"> Loại</td>
						<td width="10%"> Đối tượng</td>
						<td width="5%"> Số lượng</td>
						<td width="50%"> Mô tả</td>
						<td width="20%"> Thời gian</td>
					</thead>
					<tbody>
						<?php
						$i = ($reports->currentPage() - 1) * $reports->perPage();
						foreach ($reports as $rp) {
							$i++;
						?>
							<tr>
								<td>{{$i}}</td>
								<td>
									<?php
									switch ($rp->type) {
										case "updateinfo":
											echo "Cập nhật thông tin";
											break;
										case "baogiam":
											echo "Báo giảm";
											break;
										case "baotang":
											echo "Báo tăng";
											break;
										case "tamdung":
											echo "Tạm dừng";
											break;
										case "kethuctamdung":
											echo "Kết thúc tạm dừng";
											break;
										case "nothing":
											echo "Không có biến động";
											break;
									} ?>
								</td>
								<td>
									<?php if ($rp->datatable == 'company') {
										echo "Thông tin công ty";
									} elseif ($rp->datatable == 'nguoilaodong') {
										echo "Người lao động";
									}
									?>
								</td>
								<td> {{ $rp->numrow}}</td>
								<td> {{ $rp->note}}</td>
								<td> {{ $rp->time}}</td>


							</tr>
						<?php } ?>
					</tbody>

				</table>

				<div class="d-flex justify-content-center">
					Tổng cộng {{$reports->total()}} kết quả
					{!! $reports->links('pagination::bootstrap-4') !!}

				</div>


			</div>

		</div>
	</div>
	@endsection