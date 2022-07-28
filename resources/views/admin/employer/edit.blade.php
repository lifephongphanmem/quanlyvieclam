@extends ('admin.layout')

@section ('content')
 

<section class="panel">
	<header class="panel-heading">
	   Chi tiết người lao động
	</header>
	<div class="panel-body">
	<div class="row ">	
	<div class="col-sm-2  pull-right">
		<div class="top-menu">
		   <button  class="btn" > <i class="fa fa-undo"> <a href="{{URL::to('employer-ba')}}">Trở về </a></i></button>
	
		</div>
	</div>
	</div>
	<form role="form" method="POST" action="#" enctype= 'multipart/form-data'>
									 {{ csrf_field() }}
		   <div class="panel-body" id='dynamicTable'>
		
		<div class="row" >
			<fieldset class="col-sm-12 col-sm-offset-0" >
			<legend class="w-auto px-3">		
				<button type="button"   class="btn btn-success">Thông tin cơ bản</button>            
			</legend>
			<div class="col-sm-4 col-sm-offset-0">
			  
			   <div class="form-group">
					<label >Họ và Tên</label>

						<input type="text" name ="hoten" value="{{$ld->hoten}}" class="form-control" required >
				
				</div>
				<div class="form-group">
					<label >Số CMND/CCCD</label>

						<input type="text" name ="cmnd" value="{{$ld->cmnd}}" class="form-control" required >
				
				</div>
				<div class="form-group">
					<label > Giới tính  </label>
					<select class="form-control input-sm m-bot5" name ="gioitinh" >
							<option value='nu' >Nữ</option>
							<option value='nam' <?php if($ld->gioitinh=="nam"||$ld->gioitinh=="Nam") echo "selected"; ?> >Nam</option>
							
						</select></div>
				<div class="form-group">
					<label >Ngày tháng năm sinh</label>
						<input type="date" name ="ngaysinh" value="{{$ld->ngaysinh}}" class="form-control" required >						
				</div>	
				<div class="form-group">
					<label >Dân tộc</label>
						<input type="text" name ="dantoc" value="{{$ld->dantoc}}" class="form-control" required >						
				</div>	
				
				
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label >Quốc tịch</label>
						<select class="form-control input-sm m-bot5" name ="nation" >
						<?php foreach ( $countries_list as $key => $value){ ?>
							<option value='{{$key}}' <?php if($key==$ld->nation) echo"selected" ;?>>{{$value}}</option>
						<?php } ?>	
						</select>
				</div>
				<div class="form-group">
					<label >Tỉnh</label>
						<input type="text" name ="tinh" value="{{$ld->tinh}}" class="form-control" required >					
				</div>
				<div class="form-group">
					<label >Huyện Thị</label>
						<input type="text" name ="huyen" value="{{$ld->huyen}}" class="form-control"  >					
				</div>
				
				<div class="form-group">
					<label >Phường xã</label>
						<input type="text" name ="xa" value="{{$ld->xa}}" class="form-control"  >					
				</div>	
				<div class="form-group">
					<label >Địa chỉ</label>
						<input type="text" name ="address" value="{{$ld->address}}" class="form-control"  >						
				</div>
			</div>
			<div class="col-sm-4">
				
				<div class="form-group">
					<label >Trình độ Giáo dục</label>
						<select class="form-control input-sm m-bot15" name ="trinhdogiaoduc" >
							<?php foreach ( $list_tdgd as $td){ ?>
							<option value='{{$td->name}}'  <?php if($td->id==$ld->trinhdogiaoduc||$td->name==$ld->trinhdogiaoduc) echo"selected" ;?> >{{$td->name}}</option>
							<?php } ?>	
							
							
						</select>
				</div>
				<div class="form-group">
					<label >Trình độ CMKT</label>
						<select class="form-control input-sm m-bot15" name ="trinhdocmkt" >
							
							<?php foreach ( $list_cmkt as $td){ ?>
							<option value='{{$td->name}}'  <?php if($td->id==$ld->trinhdocmkt||$td->name==$ld->trinhdocmkt) echo"selected" ;?> >{{$td->name}}</option>
							<?php } ?>	
							
						</select>
				</div>
				<div class="form-group">
					<label >Ngành nghề </label>
						<select class="form-control input-sm m-bot15" name ="nghenghiep" >
							
							<?php foreach ( $list_nghe as $td){ ?>
							<option value='{{$td->name}}'  <?php if($td->id==$ld->nghenghiep||$td->name==$ld->nghenghiep) echo"selected" ;?> >{{$td->name}}</option>
							<?php } ?>	
						</select>
				</div>
				
				<div class="form-group">
					<label >Lĩnh vực đào tạo </label>
						<select class="form-control input-sm m-bot15" name ="linhvucdaotao" >
							
							<?php foreach ( $list_linhvuc as $td){ ?>
							<option value='{{$td->name}}'  <?php if($td->id==$ld->linhvucdaotao||$td->name==$ld->linhvucdaotao) echo"selected" ;?>>{{$td->name}}</option>
							<?php } ?>	
						</select>
				</div>
				<div class="form-group">
					<label >Số sổ bảo hiểm</label>
						<input type="text" name ="sobaohiem" value="{{$ld->sobaohiem}}"  class="form-control"  >						
				</div>
		</div>
			
				
			</fieldset>		
		 </div>  
		<?php if ($ld->state != 3){ ?> 		
		<div class="row" >
			<fieldset class="col-sm-12 col-sm-offset-0" >
			<legend class="w-auto px-3">		
				<button type="button"   class="btn btn-success">Đang làm việc tại {{$ld->ctyname}}</button>            
			</legend>
			</fieldset>	
			<div class="col-sm-4 col-sm-offset-0">
				<div class="form-group">
					<label >Vị trí</label>
						<input type="text" name ="vitri" value="{{$ld->vitri}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Chức vụ</label>
						<input type="text" name ="chucvu" value="{{$ld->chucvu}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Loại HĐLĐ</label>
						<select class="form-control input-sm m-bot15" name ="loaihdld" >
							
							<?php foreach ( $list_hdld as $td){ ?>
							<option value='{{$td->name}}' <?php if($ld->loaihdld==$td->id||$ld->loaihdld==$td->name) echo"selected" ;?> >{{$td->name}}</option>
							<?php } ?>	
						</select>
				</div>
				<div class="form-group">
					<label >Ngày hiệu lực HĐLD</label>
						<input type="date" name ="bdhopdong" value="{{$ld->bdhopdong}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày hết hiệu lực HĐLD</label>
						<input type="date" name ="kthopdong" value="{{$ld->kthopdong}}"  class="form-control"  >						
				</div>
				
				<div class="form-group">
					<label >Ngày bắt đầu BHXH</label>
						<input type="date" name ="bdbhxh" value="{{$ld->bdbhxh}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày kết thúc BHXH</label>
						<input type="date" name ="ktbhxh" value="{{$ld->ktbhxh}}" class="form-control"  >						
				</div>
			</div>
			<div class="col-sm-4 col-sm-offset-0">
				<div class="form-group">
					<label >Mức lương</label>
						<input type="text" name ="luong" value="{{$ld->luong}}"  class="form-control" required >						
				</div>
				<div class="form-group">
					<label >Mức lương đóng BHXH</label>
						<input type="text" name ="luongbhxh" value="{{$ld->luongbhxh}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp chức vụ</label>
						<input type="text" name ="pcchucvu" value="{{$ld->pcchucvu}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp thâm niên</label>
						<input type="text" name ="pcthamnien" value="{{$ld->pcthamnien}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp thâm niên nghề</label>
						<input type="text" name ="pcthamniennghe" value="{{$ld->pcthamniennghe}}" class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp lương</label>
						<input type="text" name ="pcluong" value="{{$ld->pcluong}}" class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp bổ sung</label>
						<input type="text" name ="pcbosung" value="{{$ld->pcbosung}}" class="form-control"  >						
				</div>
				
			</div>
			<div class="col-sm-4">
				
				<div class="form-group">
					<label >Ngày bắt đầu NN độc hại, nặng nhọc </label>
						<input type="date" name ="bddochai" value="{{$ld->bddochai}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày kết thúc NN độc hại, nặng nhọc </label>
						<input type="date" name ="ktdochai" value="{{$ld->ktdochai}}"  class="form-control"  >						
				</div>
				
				
			
				
				<div class="form-group">
					<label >Tuyển dụng từ TTDVVL</label>
						<select class="form-control input-sm m-bot5" name ="fromttdvvl" >
							<option value='1' >Đúng</option>
							<option value='0'<?php if($ld->fromttdvvl==0) echo"selected" ;?> >Sai</option>
							
						</select>				
				</div>
				
				<div class="form-group">
					<label >Ghi chú</label>
					<textarea   name ="ghichu" class="form-control"rows='4' >{{$ld->ghichu}} </textarea>						
				</div>
			</div>
		 </div> 
		<?php } ?> 		
		 <?php 
		if($hosos){
		foreach ($hosos as $hoso){	
		?>	
			
		<div class="row" >
			<fieldset class="col-sm-12 col-sm-offset-0" >
			<legend class="w-auto px-3">		
				<button type="button"   class="btn btn-success">Đã làm việc tại {{$hoso->ctyname}}</button>            
			</legend>
			</fieldset>	
			<div class="col-sm-4 col-sm-offset-0">
				<div class="form-group">
					<label >Vị trí</label>
						<input type="text" name ="vitri" value="{{$hoso->vitri}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Chức vụ</label>
						<input type="text" name ="chucvu" value="{{$hoso->chucvu}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Loại HĐLĐ</label>
						<select class="form-control input-sm m-bot15" name ="loaihdld" >
							
							<?php foreach ( $list_hdld as $td){ ?>
							<option value='{{$td->name}}' <?php if($hoso->loaihdld==$td->id||$hoso->loaihdld==$td->name) echo"selected" ;?> >{{$td->name}}</option>
							<?php } ?>	
						</select>
				</div>
				<div class="form-group">
					<label >Ngày hiệu lực HĐLD</label>
						<input type="date" name ="bdhopdong" value="{{$hoso->bdhopdong}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày hết hiệu lực HĐLD</label>
						<input type="date" name ="kthopdong" value="{{$hoso->kthopdong}}"  class="form-control"  >						
				</div>
				
				<div class="form-group">
					<label >Ngày bắt đầu BHXH</label>
						<input type="date" name ="bdbhxh" value="{{$hoso->bdbhxh}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày kết thúc BHXH</label>
						<input type="date" name ="ktbhxh" value="{{$hoso->ktbhxh}}" class="form-control"  >						
				</div>
			</div>
			<div class="col-sm-4 col-sm-offset-0">
				<div class="form-group">
					<label >Mức lương</label>
						<input type="text" name ="luong" value="{{$hoso->luong}}"  class="form-control" required >						
				</div>
				<div class="form-group">
					<label >Mức lương đóng BHXH</label>
						<input type="text" name ="luongbhxh" value="{{$hoso->luongbhxh}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp chức vụ</label>
						<input type="text" name ="pcchucvu" value="{{$hoso->pcchucvu}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp thâm niên</label>
						<input type="text" name ="pcthamnien" value="{{$hoso->pcthamnien}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp thâm niên nghề</label>
						<input type="text" name ="pcthamniennghe" value="{{$hoso->pcthamniennghe}}" class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp lương</label>
						<input type="text" name ="pcluong" value="{{$hoso->pcluong}}" class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Phụ cấp bổ sung</label>
						<input type="text" name ="pcbosung" value="{{$hoso->pcbosung}}" class="form-control"  >						
				</div>
				
			</div>
			<div class="col-sm-4">
				
				<div class="form-group">
					<label >Ngày bắt đầu NN độc hại, nặng nhọc </label>
						<input type="date" name ="bddochai" value="{{$hoso->bddochai}}"  class="form-control"  >						
				</div>
				<div class="form-group">
					<label >Ngày kết thúc NN độc hại, nặng nhọc </label>
						<input type="date" name ="ktdochai" value="{{$hoso->ktdochai}}"  class="form-control"  >						
				</div>
				
				
			
				
				<div class="form-group">
					<label >Tuyển dụng từ TTDVVL</label>
						<select class="form-control input-sm m-bot5" name ="fromttdvvl" >
							<option value='1' >Đúng</option>
							<option value='0'<?php if($hoso->fromttdvvl==0) echo"selected" ;?> >Sai</option>
							
						</select>				
				</div>
				
				<div class="form-group">
					<label >Ghi chú</label>
					<textarea   name ="ghichu" class="form-control"rows='4' >{{$hoso->ghichu}} </textarea>						
				</div>
			</div>
		 </div> 	
			
		<?php	
		}
		}
		?>
		 
		</form>
		
		</div>

</section>
@endsection