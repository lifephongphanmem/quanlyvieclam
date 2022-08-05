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
                        <h3 class="card-label text-uppercase">Chỉnh sửa danh mục</h3>
                    </div>
                    <div class="card-toolbar">
						<a href="{{URL::to('dmhc-bn')}}" class="btn btn-xs btn-success mr-2"> Tạo mới  </a>
						<a href="{{URL::to('dmhc-ba')}}" class="btn btn-xs btn-info">Trở về </a>                        
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{URL::to('dmhc-bu')}}" enctype= 'multipart/form-data'>
						{{ csrf_field() }}
				   
				   <div class="form-group">
					   <label >Tên danh mục</label>
					   <input type="text" name ="name" class="form-control" required value="{{$cat->name}}" >							
				   </div>
					<div class="form-group">
					   <label >Hiệu lực <input type='radio' value='1' name= 'public' <?php if ($cat->public==1){echo "checked";}; ?>></label> 
					   </label>Không hiệu lực` <input type='radio' value='0' name= 'public'  <?php if ($cat->public==0){echo "checked";}; ?> ></label>
				   
				   </div>
					<div class="form-group">
					   <label >Mã quốc gia</label>

						   <input type="text" name ="maquocgia" class="form-control" value="{{$cat->maquocgia}}"  >
				   
				   </div>
					<div class="form-group">
					   <label >Cấp</label>

						   <input type="text" name ="level" class="form-control" value="{{$cat->level}}"  >
				   
				   </div>
					<div class="form-group">
					   <label >Danh mục trên </label>

						   <select class="input-sm form-control w-sm inline v-middle" name="parent">
						   <?php foreach($cats as $dm) { ?>	
						   <option value="{{$dm->maquocgia}}" <?php if ($cat->parent==$dm->maquocgia){echo "selected";} ?>> {{$dm->name}} </option>	
						   
						   <?php } ?>
							</select>
				   
				   </div>
				   <div class="form-group">
					   <label >Miêu tả</label>
						   <textarea style="resize:none" rows='5' name ="description" class="form-control" value={{$dm->description}} >										{{$cat->description}}
						   </textarea>
				   </div>
				   
				   <input type="hidden" name="id" value= '{{$cat->id}}'>
				   
				   <button type="submit" class="btn btn-info">Cập nhật</button>
				  
			   </form>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
