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
                        <a href="{{ URL::to('dmhc-bnc/' . $p->maquocgia) }}" class="btn btn-xs btn-success mr-2">Tạo mới</a>
                        <a href="{{ URL::to('dmhc-ba') }}" class="btn btn-xs btn-info">Trở về </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Cấp</th>
                                <th>Mã quốc gia</th>
                                <th>Danh mục con</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                $i=0;
                foreach ($cats as $cat)
                    
                    { $i++;
                  ?>
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    <a href="{{ URL::to('dmhc-be') . '/' . $cat->id }}">{{ $cat->name }}</a>
                                </td>

                                <td><span class="text-ellipsis">{{ $cat->level }} </span></td>
                                <td><span class="text-ellipsis">{{ $cat->maquocgia }} </span></td>
                                <td><span class="text-ellipsis">
                                        <a href="{{ URL::to('dmhc-bac') . '/' . $cat->maquocgia }}"><button>{{ $cat->childs }}
                                                <i class="fa fa-eye"></i></button></a>
                                    </span></td>
                                <td>
                                    <a href="{{ URL::to('dmhc-bd') . '/' . $cat->id }}" class="active" ui-toggle-class=""
                                        onclick="return confirm('Bạn muốn xóa danh mục?');"><i
                                            class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>

                            <?php 
                  } 
              
               ?>

                        </tbody>
                    </table>

                    <footer class="panel-footer">
                        <div class="row">

                            <div class="d-flex justify-content-center">
                                Tổng cộng {{ $cats->total() }} kết quả
                                {!! $cats->links('pagination::bootstrap-4') !!}
                            </div>
                    </footer>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
@endsection
