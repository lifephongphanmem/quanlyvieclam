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
                        <h3 class="card-label text-uppercase">Danh mục hành chính</h3>
                    </div>
                    <div class="card-toolbar">
                        <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>Id</th>
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

    <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        {!! Form::open([
            'url' => '/dmhc-bi',
            'method' => 'post',
            'id' => 'thoai_nhanexcel',
            'class' => 'form-horizontal form-validate',
        ]) !!}
        <div class="modal-dialog modal-content">
            <div class="modal-header modal-header-primary">
                <h4 id="modal-header-primary-label" class="modal-title">Nhận danh sách từ file Excel</h4>
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="file" name="import_file" onchange="this.form.submit()">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button type="submit" name="submit" value="submit" class="btn btn-primary">Đồng ý</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
