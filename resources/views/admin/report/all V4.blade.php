
@extends ('admin.layout')

@section ('content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khai báo
    </div>
<form class="form-inline" method="GET">
    <div class="row w3-res-tb">
      <div class="col-sm-2 m-b-xs">
         <select class="input-sm form-control w-sm inline v-middle" name="time_filter" onchange="this.form.submit()">
          <option value="0">Loai</option>
          <option value="10" <?php if($time_filter==10){echo "selected";}?>>Tháng trước</option>
          <option value="11"<?php if($time_filter==11){echo "selected";}?>>Tháng này</option>
          
        </select>
	</div>
	
	<div class="col-sm-2 m-b-xs">
		 <select class="input-sm form-control w-sm inline v-middle" name="type_filter" onchange="this.form.submit()">
          <option value="0">Loai</option>
          <option value="baotang" <?php if($type_filter=="baotang"){echo "selected";}?>>Báo tăng</option>
          <option value="baogiam"<?php if($type_filter=="baogiam"){echo "selected";}?>>Báo giảm</option>
          <option value="tamdung"<?php if($type_filter=="tamdung"){echo "selected";}?>>Tạm dừng</option>
          <option value="ketthuctamdung"<?php if($type_filter=="kethuctamdung"){echo "selected";}?>>Kết thúc tạm dừng</option>
          <option value="updateinfo"<?php if($type_filter=="updateinfo"){echo "selected";}?>>Thay đổi thông tin</option>
          
        </select>
    	</div>
	<div class="col-sm-2 m-b-xs">
			        
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" id="search" name="search" value="{{$search}}">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
</form>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
			
            <td width="5%"> # </td>
		<td width="10%"> Loại</td>
		<td width="10%"> Đối tượng</td>
		<td width="5%"> Số lượng</td>
		<td width="50%"> Mô tả</td>
		<td width="20%"> Thời gian</td>
            <td>Công ty</td>
          
       
          </tr>
        </thead>
        <tbody>
    <?php 
		$i=($reports->currentPage()-1)*$reports->perPage();
		foreach ($reports as $rp ){
			$i++;
	?>
		 <td >{{$i}}</td>
		<td >
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
		<td >
		<?php if($rp->datatable=='company')
			{ echo "Thông tin công ty";}
			elseif($rp->datatable=='nguoilaodong')
			{ echo "Người lao động";}
		?>
		</td>
		<td > {{ $rp->numrow}}</td>
		<td > {{ $rp->note}}</td>
		<td > {{ $rp->time}}</td>
		<td > {{ $rp->ctyname}}</td>
		</tr>
	<?php } ?>	  
 
         
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
	
       <div class="d-flex justify-content-center">
	     Tổng cộng {{$reports->total()}}  kết quả 
		{!! $reports->links('pagination::bootstrap-4') !!}
      </div>
	  </div>
    </footer>
  </div>
</div>

@endsection