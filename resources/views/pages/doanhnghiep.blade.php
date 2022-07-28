
@extends('pages.layout')
@section('mainpanel')
@if($errors->has('import_file'))
	
	<div class="flash-message text-center">
	<p class="alert alert-danger ">{{ $errors->first('import_file') }}</p>
	</div>	
@endif


 <div class="row">
	<div class="col-sm-6 col-sm-offset-1"> 
	<div class="panel panel-info">
	<div class="panel-heading">
		<h3> Thông tin cơ bản</h3>
	</div>
	<div class="panel-body">
		<form role="form" method="POST" action="{{URL::to('doanhnghiep-fu')}}" enctype= 'multipart/form-data'>
									 {{ csrf_field() }}
		 <table>
			<tr>
				<td>Mã số doanh nghiệp </td>
				<td>
					<input type="text" size=5  name ="maso" value="44" readonly>
					<input type="text" size=20  name ="id" value="{{$info->id}}" readonly>
				
				</td>
			</tr>
			<tr>
				<td>Tên doanh nghiệp</td>
				<td><input type="text" class="form-control"   name="name" value="{{$info->name}}" required></td>
			</tr>
			<tr>
				<td>Mã số DKKD</td>
				<td><input type="text" class="form-control"  id="dkkd" name ="dkkd" value="{{$info->dkkd}}" readonly required></td>
			</tr>
			<tr>
				<td>Tình trạng hoạt động</td>
				<td>	
					Hoạt động <input type='radio' value='1' name= 'public' <?php if($info->public){echo "checked";}?>> 
					Dừng <input type='radio' value='0' name= 'public' <?php if(!$info->public){echo "checked";}?>>
				</td>
			</tr>
			<tr>
				<td>Số điện thoại </td>
				<td><input type="text" name="phone" class="form-control" value="{{$info->phone}}" required></td>
			</tr>
			<tr>
				<td>Fax</td>
				<td><input type="text"  name="fax" value="{{$info->fax}}"  class="form-control"> </td>
			</tr>
			<tr>
				<td>Website</td>
				<td><input type="text" name="website" value="{{$info->website}}" class="form-control"> </td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value="{{$info->email}}" class="form-control"required> </td>
			</tr>
			<tr>
				<td>Tỉnh</td>
				<td>
				<select class="form-control input-sm m-bot5" name ="tinh" id='tinh'>
				<option   value="44" > Quảng Bình </option>
				
				</select>
				</td>
			</tr>
			<tr>
				<td>Huyện/Thị xã/Thành phố </td>
				<td><select class="form-control input-sm m-bot5" name ="huyen" id='huyen'>
					<?php foreach ($dmhc as $dv){
						if ($dv->level == 'Huyện' || $dv->level == 'Thành phố'||$dv->level =="Thị xã"){
						?>	
						<option value='{{$dv->maquocgia}}' <?php if($dv->maquocgia == $info->huyen||$dv->name == $info->huyen){echo "selected";}?> >{{$dv->name}}</option>
					<?php  }}?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td>Xã/Phường</td>
				<td>
				<select class="form-control input-sm m-bot5" name ="xa" id="xa">
					<?php foreach ($dmhc as $dv){
						if ($dv->level =="Xã"||$dv->level =="Phường"||$dv->level =="Thị trấn"){
						?>	
						<option class="{{$dv->parent}}" value='{{$dv->maquocgia}}' <?php if($dv->maquocgia == $info->xa||$dv->name == $info->xa){echo "selected";}?>  >{{$dv->name}}</option>
						<?php } }?>
						
											
				</select>	
				<script>
					var xa = $("[name=xa] option").detach()
						$("[name=huyen]").change(function() {
						  var val = $(this).val()
						  $("[name=xa] option").detach()
						  xa.filter("." + val).clone().appendTo("[name=xa]")
						}).change()
				</script>
				
				Thành thị <input type='radio' value='1' name= 'khuvuc' <?php if($info->khuvuc){echo "checked";}?>> 
				Nông thôn <input type='radio' value='0' name= 'khuvuc' <?php if(!$info->khuvuc){echo "checked";}?>>
											</td>
			</tr>
			<tr>
				<td>Địa chỉ</td>
				<td>
				<textarea type="text" class="form-control" name="adress" required>{{$info->adress}}</textarea>
				</td>
			</tr>
			<tr>
				<td>Khu công nghiệp</td>
				<td><select class="form-control input-sm m-bot5" name ="khucn" >
					<option value=0 > Chọn khu công nghiệp </option>
					<?php foreach ($kcn as $dv){
					
						?>	
						<option value='{{$dv->id}}' <?php if($dv->id == $info->khucn){echo "selected";}?>  >{{$dv->name}}</option>
						<?php  }?>
					
					
				</select>
				</td>
			</tr>
			<tr>
				<td>Loại hình doanh nghiệp</td>
				<td><select class="form-control input-sm m-bot5" name ="loaihinh" >
					<?php foreach ($ctype as $dv){
					
						?>	
						<option value='{{$dv->id}}' <?php if($dv->id == $info->loaihinh){echo "selected";}?>  >{{$dv->name}}</option>
						<?php  }?>
					
					
				</select> </td>
			</tr>
			<tr>
				<td>Ngành nghề</td>
				<td> <select class="form-control input-sm m-bot5" name ="nganhnghe" >
					<?php foreach ($cfield as $dv){
					
						?>	
						<option value='{{$dv->id}}' <?php if($dv->id == $info->nganhnghe){echo "selected";}?>  >{{$dv->name}}</option>
						<?php  }?>
					
					
				</select> </td>
			</tr>
			
		</table>	
			
			
		
			<div><hr></div>
			<div>
				<input type='submit' value=" Cập nhật thông tin">
			</div>
		</form>
		</div>
		</div> 
		
	</div>
	
	<div class="col-sm-4 ">
		
		<div class="panel-group" id="accordion">
		  <div class="panel panel-info">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
				Thông tin khác </a>
			  </h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse in">
			  <div class="panel-body">
				
					<div>Tổng số lao động: {{$info->tonghop['slld']}}</div>
					<div>Số lao động ngoại tỉnh: {{$info->tonghop['slld']-$info->tonghop['trongtinh']}}</div>
				
					<div>Số lao động nữ :{{$info->tonghop['nu']}}</div>
					<div>Số lao động đã ký HĐLĐ (tổng/nữ): {{$info->tonghop['dakyhd']}}/ {{$info->tonghop['nudakyhd']}} </div>
					<div>Số lao động nước ngoài (tổng/nữ): {{$info->tonghop['nuocngoai']}}/ {{$info->tonghop['nunuocngoai']}} </div>
					<div>Số lao động đã tốt nghiệp phổ thông :{{$info->tonghop['tnpt']}}</div>
					
					<h3>Tiền lương</h3>
					<div>Lương bình quân :{{$info->tonghop['avgluong']}}</div>
					<div>Lương thấp nhất :{{$info->tonghop['minluong']}}</div>
					<div>Lương cao nhất  :{{$info->tonghop['maxluong']}}</div>
					
			  
			  </div>
			</div>
		  </div>
		  <div class="panel panel-info">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			   Phân bố LD theo trình độ CMKT</a>
			  </h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
			  <div class="panel-body">
		  
				<?php
				foreach($info->pbcmkt as $key =>$val) 
				{ ?> 
					<div>{{$key}} : {{$val}}</div> 
				<?php } ?>
				
					
			  
			  </div>
			</div>
		  </div>
		  <div class="panel panel-info">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			   Phân bố LD theo lĩnh vực GDĐT </a>
			  </h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
			  <div class="panel-body">
					<?php
					foreach($info->pblvdt as $key =>$val) 
					{ ?> 
						<div>{{$key}} : {{$val}}</div> 
					<?php } ?>
				</div>
			</div>
			</div>
		 <div class="panel panel-info">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
			   Phân bố LD theo lĩnh vực GDĐT </a>
			  </h4>
			</div>
			<div id="collapse4" class="panel-collapse collapse">
			  <div class="panel-body">
					<h3>Phân bố LD theo nhóm ngành nghề chính</h3>
					<?php
					foreach($info->pbnghenghiep as $key =>$val) 
					{ ?> 
						<div>{{$key}} : {{$val}}</div> 
					<?php } ?>
				</div>
			  </div>
			</div>

			
	
	</div>
</div>

<div class="row ">	
	<div class="col-sm-10 col-sm-offset-1">
	 <div class="panel-group">
	  <div class="panel panel-info">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" href="#collapsenld">Danh sách người lao động</a>
		  </h4>
		</div>
		<div id="collapsenld" >
		  <div class="panel-body">
		  
					
					<div class="row ">	
						<div class="col-sm-12 col-sm-offset-0">

							<div class="function-menu pull-right">
								<ul class="nav navbar-nav">
									<li><a href="#"><i class="fa fa-user"></i> 
									<label> Nhập danh sách lao động ban đầu 
							
									<form class="form-inline" method="POST" action="{{URL::to('laodong-fi')}} " enctype= 'multipart/form-data'>
									<input type="file" name="import_file" onchange="this.form.submit()" style="display:none;">
									{{ csrf_field() }} 
									</form>
									</label></a>
									</li>								
															
															
									
									<li><a href="{{URL::to('/')}}/huongdan.xlsx" download><i class="fa fa-file"></i> <button class="  " type="button">Hướng dẫn điền dữ liệu</button></a></li>								
									
									<li><a href="{{URL::to('/')}}/maunhapnguoilaodong.xlsx" download ><i class="fa fa-file"></i> <button class="  " type="button">Tải mẫu</button></a></li>								
									<li><a href="{{URL::to('laodong-ex')}}"><i class="fa fa-file"></i> <button class="  " type="button">Tải danh sách NLĐ</button></a></li>	
															
																						
								</ul>
							</div>
						</div>
					</div>
					<form class="form-inline" id ="formnld" method="GET" action="#collapsenld">
					<div class="row ">	
						<div class="col-sm-6 col-sm-offset-0">
							<label>Lọc theo tình trạng</label>
							<select class="input-sm form-control w-sm inline v-middle" name="state_filter" onchange="this.form.submit()">
							  <option value="0">Tất cả</option>
							  <option value="1" <?php if($state_filter==1){echo "selected";}?>>Hoạt động</option>
							  <option value="2"<?php if($state_filter==2){echo "selected";}?>>Tạm dừng</option>
							  <option value="3"<?php if($state_filter==3){echo "selected";}?>>Đã báo giảm</option>
							  
							</select>
						</div>
						<div class="col-sm-3 ">
							<div class="function-search pull-right">
							
							<div class="input-group">
								  <input type="text" name="search" class="input-sm form-control" value="{{$search}}" placeholder="Tìm theo Tên hoặc CCCD/CMND"  >
								  <span class="input-group-btn">
									<button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
								  </span>
							</div>
							</div>
						</div>
					</div>
								 
					</form>
					<div class="row ">	
					<div class="col-sm-12 col-sm-offset-0">
					<br>	
					<div class="table-responsive">
						<table  class="table table-striped  table-bordered">
						<thead  >
							<td width="2%"> # </td>
							<td width="15%"> Họ và tên</td>
							<td width="13%"> Năm sinh</td>
							<td width="10%"> Giới tính</td>
							<td width="10%"> CMND/CCCD</td>
							<td width="30%"> Địa chỉ</td>
							<td width="10%"> Vị trí</td>
							<td width="10%"> <?php if($action){echo "Khai báo";}else{echo "Tình trạng";} ?></td>
							
						</thead>
						<tbody>
					<?php 
							$i=($lds->currentPage()-1)*$lds->perPage();
							foreach ($lds as $ld ){
								$i++;
						?>
						<tr>
							<td >{{$i}}</td>
							<td > {{ $ld->hoten}}</td>
							<td > {{ $ld->ngaysinh}}</td>
							<td > {{ ($ld->gioitinh=='nam'||$ld->gioitinh=='Nam')?"Nam":"Nữ"}}</td>
							<td > {{ $ld->cmnd}}</td>
							<td > {{ $ld->address }} {{ $ld->xa}} {{ $ld->huyen }} {{ $ld->tinh }}</td>
							<td > {{ $ld->vitri}}</td>
							<td >
								<a href="{{URL::to('laodong-fe').'/'.$ld->id.'/'.$action}}" <?php if(!$action){echo "class='btn disabled'";} ?>>
								<?php	
								switch($action){
								case "tamdung":echo "Tạm dừng"; break;
								case "kethuctamdung":echo "Kết thúc tạm dừng"; break;
								case "delete":echo "Báo giảm"; break;
								case "update":echo "Cập nhật"; break;
								
								default: 
										if($ld->state==1)echo "Đang hoạt động";
										if($ld->state==2)echo "Đã tạm dừng";
										if($ld->state==3)echo "Đã báo giảm";
									} ?>
								
								</a></td>
							
						</tr>
						<?php } ?>	  
						</tbody>
						</table>
					</div>
						
						 <div class="row">
								<div class="col-sm-10 col-sm-offset-1">
								   <div class="d-flex justify-content-center">
									 Tổng cộng {{$lds->total()}}  kết quả 
									{!! $lds->links('pagination::bootstrap-4') !!}
								  </div>
								 </div>
							</div>
						
					</div>
					</div>
		  </div>
		  <div class="panel-footer"></div>
		</div>
		 
		 </div>
	</div>
				
 

@endsection