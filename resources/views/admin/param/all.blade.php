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
                        <h3 class="card-label text-uppercase">Giá trị tham số: <span>{{ $catname }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ URL::to('param-bn' . '/' . $catid) }}" class="btn btn-sm btn-success mr-2">Tạo mới</a>
                        <a href="{{ URL::to('ptype-ba') }}" class="btn btn-sm btn-info">Trở về </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    STT
                                </th>

                                <th>Giá trị tham số</th>
                                <th>Miêu tả</th>
                                <th>Id</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                $i=0;
                foreach ($params as $param)
                    
                    { $i++;
                  ?>
                            <tr>
                                <td>{{ $i }}</label></td>

                                <td>
                                    <a href="{{ URL::to('param-be') . '/' . $param->id }}">{{ $param->name }}</a>
                                </td>

                                <td><span class="text-ellipsis">{{ $param->description }} </span></td>
                                <td>
                                    {{ $param->id }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('param-bd') . '/' . $param->id }}" class="active" ui-toggle-class=""
                                        onclick="return confirm('Cảnh báo ! Bạn muốn xóa giá trị?');"><i
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
