@extends('pages.layout')
@section('mainpanel')

<section class="panel">
				<header class="panel-heading">
				<div class="row ">
					<div class="col-sm-8 col-sm-offset-2">                   
					<div>
					  <h3> Báo tăng lao động</h3>
					</div>
					</div>
				</div>
				</header>
	<form role="form" method="POST" action="{{URL::to('laodong-fs')}}" enctype= 'multipart/form-data'>
									 {{ csrf_field() }}
	
	<div class="row ">	
		<div class="col-sm-6 col-sm-offset-2">	
			<div class="form-group">
			<label >Nội dung (*)</label>
				<textarea   name ="note" class="form-control"rows='8' > </textarea>						
			</div>
		</div>
		<div class="col-sm-2 ">	
			<div class="form-group">
				<label >Người khai báo</label>
			<input type="text" name ="username" class="form-control" readonly value="{{Auth::user()->name}}" >
			</div>
			<div class="form-group">
				<label >Ngày khai báo</label>
			<input type="text" name ="date_create" class="form-control" readonly value="{{date('d/m/Y')}}" >
			</div>
			<div class="form-group">
				<label >Số lượng</label>
			<input type="text" name ="quantity" id="quantity" class="form-control" readonly value="1" >
			</div>
		</div>
		
	</div>
	                      
                        <div class="panel-body" id='dynamicTable'>
						
						<div class="row" id ="1stld">
							<fieldset class="col-sm-8 col-sm-offset-2" >
							<legend class="w-auto px-3">		
								<button type="button"   class="btn btn-success">Người lao động</button>            
							</legend>
							<div class="col-sm-4 col-sm-offset-0">
                              
							   <div class="form-group">
									<label >Họ và Tên (*)</label>

										<input type="text" name ="hoten[]" class="form-control" required >
								
								</div>
								<div class="form-group">
									<label >Số CMND/CCCD (*)</label>

										<input type="text" name ="cmnd[]" class="form-control" required >
								
								</div>
								<div class="form-group">
									<label > Giới tính (*) </label>
									<select class="form-control input-sm m-bot5" name ="gioitinh[]" >
											<option value='nam' selected >Nam</option>
											<option value='nu'>Nữ</option>
											
										</select></div>
								<div class="form-group">
									<label >Ngày tháng năm sinh (*)</label>
										<input type="date" name ="ngaysinh[]" class="form-control" required >						
								</div>	
								<div class="form-group">
									<label >Quốc tịch (*)</label>
										<select class="form-control input-sm m-bot5" name ="nation[]" >
										<?php foreach ( $countries_list as $key => $value){ ?>
											<option value='{{$key}}' <?php if($key=="VN") echo"selected" ;?>>{{$value}}</option>
										<?php } ?>	
										</select>
								</div>
								<div class="form-group">
									<label >Dân tộc (*)</label>
										<input type="text" name ="dantoc[]" class="form-control" required >						
								</div>	
								
								<div class="form-group">
									<label >Tỉnh (*)</label>
										<input type="text" name ="tinh[]" class="form-control" required >					
								</div>
								<div class="form-group">
									<label >Huyện Thị (*)</label>
										<input type="text" name ="huyen[]" class="form-control"  >					
								</div>
								
								<div class="form-group">
									<label >Phường xã (*)</label>
										<input type="text" name ="xa[]" class="form-control"  >					
								</div>	
								<div class="form-group">
									<label >Địa chỉ (*)</label>
										<input type="text" name ="address[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Vị trí </label>
										<input type="text" name ="vitri[]" class="form-control"  >						
								</div>
							</div>
							<div class="col-sm-4">
							
								
								<div class="form-group">
									<label >Chức vụ</label>
										<input type="text" name ="chucvu[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Trình độ Giáo dục</label>
										<select class="form-control input-sm m-bot15" name ="trinhdogiaoduc[]" >
											<?php foreach ( $list_tdgd as $td){ ?>
											<option value='{{$td->name}}' >{{$td->name}}</option>
											<?php } ?>	
											
											
										</select>
								</div>
								<div class="form-group">
									<label >Trình độ CMKT</label>
										<select class="form-control input-sm m-bot15" name ="trinhdocmkt[]" >
											
											<?php foreach ( $list_cmkt as $td){ ?>
											<option value='{{$td->name}}' >{{$td->name}}</option>
											<?php } ?>	
											
										</select>
								</div>
								<div class="form-group">
									<label >Ngành nghề </label>
										<select class="form-control input-sm m-bot15" name ="nghenghiep[]" >
											
											<?php foreach ( $list_nghe as $td){ ?>
											<option value='{{$td->name}}' >{{$td->name}}</option>
											<?php } ?>	
										</select>
								</div>
								
								<div class="form-group">
									<label >Lĩnh vực đào tạo </label>
										<select class="form-control input-sm m-bot15" name ="linhvucdaotao[]" >
											
											<?php foreach ( $list_linhvuc as $td){ ?>
											<option value='{{$td->name}}' >{{$td->name}}</option>
											<?php } ?>	
										</select>
								</div>
								
								
								<div class="form-group">
									<label >Mức lương (*)</label>
										<input type="text" name ="luong[]" data-type="currency" class="form-control" required >						
								</div>
								<div class="form-group">
									<label >Phụ cấp chức vụ</label>
										<input type="text" name ="pcchucvu[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Phụ cấp thâm niên</label>
										<input type="text" name ="pcthamnien[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Phụ cấp thâm niên nghề</label>
										<input type="text" name ="pcthamniennghe[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Phụ cấp lương</label>
										<input type="text" name ="pcluong[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Phụ cấp bổ sung</label>
										<input type="text" name ="pcbosung[]" class="form-control"  >						
								</div>
								
								
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label >Ngày bắt đầu NN độc hại, nặng nhọc </label>
										<input type="date" name ="bddochai[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Ngày kết thúc NN độc hại, nặng nhọc </label>
										<input type="date" name ="ktdochai[]" class="form-control"  >						
								</div>
								
								<div class="form-group">
									<label >Loại HĐLĐ</label>
										<select class="form-control input-sm m-bot15" name ="loaihdld[]" >
											
											<?php foreach ( $list_hdld as $td){ ?>
											<option value='{{$td->name}}' >{{$td->name}}</option>
											<?php } ?>	
										</select>
								</div>
								<div class="form-group">
									<label >Ngày hiệu lực HĐLD</label>
										<input type="date" name ="bdhopdong[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Ngày hết hiệu lực HĐLD</label>
										<input type="date" name ="kthopdong[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Số sổ bảo hiểm</label>
										<input type="text" name ="sobaohiem[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Ngày bắt đầu BHXH</label>
										<input type="date" name ="bdbhxh[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Ngày kết thúc BHXH</label>
										<input type="date" name ="ktbhxh[]" class="form-control"  >						
								</div>
								<div class="form-group">
									<label >Mức lương đóng BHXH</label>
										<input type="text" name ="luongbhxh[]" class="form-control"  >						
								</div>
								
								<div class="form-group">
									<label >Tuyển dụng từ TTDVVL</label>
										<select class="form-control input-sm m-bot5" name ="fromttdvvl[]" >
											<option value='1' selected >Đúng</option>
											<option value='0'>Sai</option>
											
										</select>				
								</div>
								
								<div class="form-group">
									<label >Ghi chú</label>
									<textarea   name ="ghichu[]" class="form-control"rows='2' > </textarea>						
								</div>
                            </div>
							
						</fieldset>		
                         
								
						 </div>   
					  
						</div>
								
								<input type="hidden" name="isnew" value= '1'>
								<input type="hidden" name="id[]" value= '0'>
<div class="row ">	
	<div class="col-sm-8 col-sm-offset-2">
						<button type="button" name="add" id="add" class="btn btn-success"><h4> Thêm người lao động </h4></button>            
                                <button type="button" class="btn btn-danger" id='remove'><h4> Giảm </h4></button>
								<button type="submit" class="btn btn-info btn-lg pull-right"><h4>Khai báo</h4></button>
							
						
						  
	</div>
</div>	
								
</form>
                       
 </section>
					
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   
<script type="text/javascript">
   
    var i = 0;
   
   $("#add").click(function(){
		document.getElementById("quantity").value= parseInt(document.getElementById("quantity").value,10) +1;
        ++i;
		firstld =  document.getElementById("1stld").innerHTML +'';
		nextld= "<div class='row' id ='row"+i+"' >" + firstld + "</div>"
       $("#dynamicTable").append(nextld);
         });
    $("#remove").click(function(){
		document.getElementById("quantity").value= parseInt(document.getElementById("quantity").value,10) -1;
       
		delrowid="row"+i;
		document.getElementById(delrowid).remove();
		--i;
         });
   

</script>	
@endsection