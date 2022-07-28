
@extends ('admin.layout')

@section ('content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách doanh nghiệp
    </div>
<form class="form-inline" method="GET">
    <div class="row w3-res-tb">
      <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle" name="dm_filter" onchange="this.form.submit()">
          <option value="0">Tất cả huyện thị</option>
		<?php foreach ($dmhc_list as $dm) {?>
	   <option value="{{$dm->name}}" <?php if($dm_filter==$dm->name){echo "selected";}?> >{{$dm->name}}</option>
		<?php } ?>
          
        </select>
	</div>
	
	<div class="col-sm-2 m-b-xs">
		 <select class="input-sm form-control w-sm inline v-middle" name="public_filter" onchange="this.form.submit()">
          <option value="0">Tình trạng hoạt động</option>
          <option value="1" <?php if($public_filter==1){echo "selected";}?>>Hoạt động</option>
          <option value="2"<?php if($public_filter==2){echo "selected";}?>>Tạm dừng</option>
          
        </select>
    	</div>
	<div class="col-sm-2 m-b-xs">
			<select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Khai báo biến động</option>
          <option value="1">Đã khai báo</option>
          <option value="2">Chưa khai báo</option>
          
        </select>          
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
    <div class="row w3-res-tb">
		<div class="col-sm-2 m-b-xs">
			<span> Quy mô lao động		</span>
		</div>
		<div class="col-sm-5 m-b-xs">
				<div class="">
					<span> Min 		</span>
					<input type="text" class="input-sm form-control " value="{{$quymo_min_filter}}" name="quymo_min_filter"  >
					<span> Max		</span>
					<input type="text" class="input-sm form-control " value="{{$quymo_max_filter}}" name="quymo_max_filter"   >
				</div>
		</div>
		 <div class="col-sm-3 m-b-xs">
			 <button class="btn btn-sm btn-default" type="submit">Lọc</button>
		</div>
		 <div class="col-sm-2 m-b-xs">
			<button class="btn btn-sm btn-default" name="export" value="1" type="submit">Xuất Excel</button>
		 </div>
    </div>
</form>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
			<th> STT </th>
            <th>Mã DN</th>
            <th>Tên doanh nghiệp</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Quy mô</th>
            <th>Tình trạng</th>
            <th>Biến động</th>
            <th>Tuyển dụng </th>
       
          </tr>
        </thead>
        <tbody>
    <?php 
		$i=($ctys->currentPage()-1)*$ctys->perPage();
		foreach ($ctys as $cty ){
			$i++;
	?>
		  <tr>
			<td>{{ $i}} </td>
            <td>{{$cty->masodn }}</td>
            <td><a href="{{URL::to('doanhnghiep-be/'.$cty->id)}}">{{$cty->name }}</a></td>
            <td><span class="text-ellipsis"> </span> {{$cty->adress }} - {{$cty->xa }} - {{$cty->huyen }}</td>
            <td><span class="text-ellipsis">  </span>{{$cty->phone }}</td>
            <td><span class="text-ellipsis">  </span>{{$cty->employers_count }}</td>
            <td><span class="text-ellipsis">
			<?php if ($cty->public==1){ 
				?> 
				<i class="fa fa-check text-success text-active"></i>
				<?php }else{ ?> 
				<i class="fa fa-close text-success text-active" style="color:red"></i>
				
				<?php }?></span>
			</td>
            <td><span class="text-ellipsis">  </span>Khai báo</td>
			<td><span class="text-ellipsis">  </span><a href="{{URL::to('tuyendung-ba/'.$cty->id)}}">Tin tuyển dụng</a></td>
          </tr>
	<?php } ?>	  
 
         
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
	
       <div class="d-flex justify-content-center">
	     Tổng cộng {{$ctys->total()}}  kết quả 
		{!! $ctys->appends(['quymo_max_filter' => $quymo_max_filter ,
							'quymo_min_filter' => $quymo_min_filter ,
							'search' => $search ,
							'public_filter' => $public_filter ,
							'dm_filter' => $dm_filter  ])
				->links('pagination::bootstrap-4') !!}
      </div>
	  </div>
    </footer>
  </div>
</div>

@endsection