
@extends ('admin.layout')

@section ('content')
 

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách tuyển dụng
    </div>
<form class="form-inline" method="GET">  
  <div class="row w3-res-tb">
      <div class="col-sm-2 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle" name="dm_filter" onchange="this.form.submit()">
          <option value="0">Huyện thị</option>
		<?php foreach ($dmhc_list as $dm) {?>
	   <option value="{{$dm->id}}" <?php if($dm_filter==$dm->id){echo "selected";}?> >{{$dm->name}}</option>
		<?php } ?>
          
        </select>
	</div>
	<div class="col-sm-2 m-b-xs">
		  <select class="input-sm form-control w-sm inline v-middle" name="public_filter" onchange="this.form.submit()">
          <option value="0">Tình trạng </option>
          <option value="1" <?php if($public_filter==1){echo "selected";}?>>Đã duyệt</option>
          <option value="2"<?php if($public_filter==2){echo "selected";}?>>Đã báo cáo</option>
          
		 </select>
		</div>
	
	<div class="col-sm-2 m-b-xs">
			     
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" name="search"  value="{{$search}}" placeholder="Search">
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
            <th style="width:20px;">
              STT
            </th>
			<th>Doanh nghiệp</th>
            <th>Tên công việc</th>
            <th>Vị trí</th>
            <th>Số lượng</th>
            <th>Ngày đăng</th>
            <th>Hạn cuối</th>
			<th  >Duyệt</th>
          </tr>
        </thead>
        <tbody>
    <?php 
		$i=($tds->currentPage()-1)*$tds->perPage();
		foreach ($tds as $td ){
			$i++;
	?>
		  <tr>
            <td>{{$i}}</td>
			<td>{{$td->name}}</td>
            <td><a href="{{URL::to('tuyendung-be').'/'.$td->id}}">{{$td->noidung}} </a></td>
            <td>{{$td->desc}}</td>
            <td><span class="text-ellipsis">{{$td->datuyentutt."/".$td->datuyen."/".$td->sltuyen}}</span></td>
            <td><span class="text-ellipsis">{{ date('d-m-Y', strtotime($td->created_at))}}</span></td>
            <td><span class="text-ellipsis">{{ date('d-m-Y', strtotime($td->thoihan))}} </span></td>
            <td><span class="text-ellipsis">
			<?php if ($td->state==0){ 
				?> 
				<a href="{{URL::to('tuyendung-bu').'/'.$td->id}}"  ui-toggle-class="">
				<i class="fa fa-check text-success text-active"></i>
					Duyệt
				</a>
				<?php }elseif($td->state==1){ echo "Đã duyệt"; }
					else { echo "Đã báo cáo";}
					?>
					
					</span>
			</td>
            
          </tr>
        	<?php } ?>	   
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
       <div class="row">
	
       <div class="d-flex justify-content-center">
	     Tổng cộng {{$tds->total()}}  kết quả 
		{!! $tds->links('pagination::bootstrap-4') !!}
      </div>
	  </div>
    </footer>
  </div>
</div>

@endsection