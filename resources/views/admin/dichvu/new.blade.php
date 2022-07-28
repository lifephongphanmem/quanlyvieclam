@extends ('admin.layout')

@section ('content')
 

			<section class="panel">
                        <header class="panel-heading">
                            Thêm Dịch vụ
                        </header>
						<div class="row w3-res-tb">
							  <div class="col-sm-5 m-b-xs">
							  </div>
							  <div class="col-sm-4">
							  </div>
							  <div class="col-sm-3">
								<i class="fa fa-undo"> <a href="{{URL::to('dichvu-ba')}}">Trở về </a></i>
								</div>
							</div>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="POST" action="{{URL::to('dichvu-bs')}}" enctype= 'multipart/form-data'>
									 {{ csrf_field() }}
							  <div class="form-group">
									<label >Tên </label>

										<input type="text" name ="name" class="form-control" required >
								
								</div>
								<div class="form-group">
									<label >Hoạt động</label>
										<select class="form-control input-sm m-bot5" name ="state">
											<option value='1'>Hoạt động</option>
											<option value='2'>Không</option>
											
										</select>
								</div>
								<div class="form-group">
									<label >Miêu tả </label>

										<textarea name ="description" class="form-control"  rows=10 required ></textarea>
								
								</div>
								
													
								
								
								
                               <input type="hidden" name="isnew" value= '1'>
								<input type="hidden" name="id" value= '0'>
								
								
                                <button type="submit" class="btn btn-info">Thêm dich vụ</button>
                            </form>
                            </div>

                        </div>
                    </section>
				
@endsection