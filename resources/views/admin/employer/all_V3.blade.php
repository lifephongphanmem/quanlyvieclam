
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
        
	</div>
	
	<div class="col-sm-2 m-b-xs">
		 
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
			<th> STT </th>
            <th>Tên</th>
            <th>CMND</th>
            <th>Ngày sinh</th>
            <th>Công ty</th>
            <th>Tỉnh</th>
            
          </tr>
        </thead>
        <tbody>
    <?php 
		$i=($lds->currentPage()-1)*$lds->perPage();
		foreach ($lds as $ld ){
			$i++;
	?>
		  <tr>
			<td>{{ $i}} </td>
           
            <td><a href="{{URL::to('employer-be/'.$ld->id)}}">{{$ld->hoten }}</a></td>
            <td><span class="text-ellipsis"> </span> {{$ld->cmnd }}</td>
            <td><span class="text-ellipsis">  </span>{{$ld->ngaysinh }}</td>
            <td><span class="text-ellipsis">  </span>{{$ld->ctyname }}</td>
            
            <td><span class="text-ellipsis">  </span>{{$ld->tinh }}</td>
			</tr>
	<?php } ?>	  
 
         
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
	
       <div class="d-flex justify-content-center">
	     Tổng cộng {{$lds->total()}}  kết quả 
		{!! $lds->links('pagination::bootstrap-4') !!}
      </div>
	  </div>
    </footer>
  </div>
</div>

@endsection