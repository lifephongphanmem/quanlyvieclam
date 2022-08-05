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
                        <h3 class="card-label text-uppercase">Danh sách Văn bản</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ URL::to('ptype-bn') }}" class="btn btn-sm btn-success">Tạo mới</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Id</th>
                                <th>Tên</th>
                                <th>Miêu tả</th>
                                <th>Giá trị tham số</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cats as $cat)
                    
                    {
                  ?>
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                                </td>
                                <td>
                                    {{ $cat->id }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('ptype-be') . '/' . $cat->id }}">{{ $cat->name }}</a>
                                </td>

                                <td><span class="text-ellipsis">{{ $cat->description }} </span></td>
                                <td><span class="text-ellipsis"> <a href="{{ URL::to('param-ba') . '/' . $cat->id }}"> Xem
                                            {{ $cat->param }} giá trị</a></span></td>

                                <td>
                                    <a href="{{ URL::to('ptype-bd') . '/' . $cat->id }}" class="active" ui-toggle-class=""
                                        onclick="return confirm('Bạn muốn xóa danh mục?');"><i
                                            class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>

                            <?php 
                  } 
              
               ?>

                        </tbody>
                    </table>                    
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
