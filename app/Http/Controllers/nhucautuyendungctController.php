<?php

namespace App\Http\Controllers;

use App\Models\dmmanghetrinhdo;
use App\Models\nhucautuyendungct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class nhucautuyendungctController extends Controller
{
    public function edit(Request $request)
    {
        $data = nhucautuyendungct::find($request->id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['token']);
        if ($request->id == null) {
            $input['nam'] = date('Y');
            $input['xd'] = 'cxd';
            nhucautuyendungct::create($input);
        } else {
            nhucautuyendungct::find($input['id'])->update($input);
        }
        $mahs = $input['mahs'];
        $result = array();
        $result = $this->getdata($mahs, $result);
        $result['status'] = 'success';
        return response()->json($result);
    }


    public function delete(Request $request)
    {
        $model = nhucautuyendungct::find($request->id);
        $mahs = $model->mahs;
        $model->delete();
        $result = array();
        $result = $this->getdata($mahs, $result);
        $result['status'] = 'success';
        return response()->json($result);
    }
    public function getdata($mahs, $result)
    {
        $modelct = nhucautuyendungct::where('mahs', $mahs)->get();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();

        $result['message']  =  '<div class="row" id="getdata">';
        $result['message'] .=  '<div class="col-xl-12">';
        $result['message'] .= '<div class="card card-custom">';
        $result['message'] .=  '<div class="card-header card-header-tabs-line">';
        $result['message'] .= '<div class="card-title">';
        $result['message'] .=  '<h5 >Chi tiết vị trí tuyển dụng</h5></div>';
        $result['message'] .=  '<div class="card-toolbar">';
        $result['message'] .=  '<a onclick="setcreate()" data-toggle="modal" data-target="#create_modal" class="btn btn-success"';
        $result['message'] .=  'title="Thêm mới chi tiết"><i class="fa fa-plus"></i>thêm mới</a>';
        $result['message'] .=  '</div></div>';
        $result['message'] .= '<div class="card-body">';
        $result['message'] .= '<div class="table-responsive">';
        $result['message'] .= '<table class="table table-striped b-t b-light table-hover">';
        $result['message'] .= '<thead>';
        $result['message'] .= '<tr class="text-center">';
        $result['message'] .= '<th width="5%"> STT </th>';
        $result['message'] .= '<th>Mã nghề cấp 2</th>';
        $result['message'] .= '<th>Số lượng</th>';
        $result['message'] .= '<th>Mô tả</th>';
        $result['message'] .= '<th>Kinh nghiệm</th>';
        $result['message'] .= '<th>nơi làm việc</th>';
        $result['message'] .= '<th>Lương</th>';
        $result['message'] .= '<th>Thao tác</th>';
        $result['message'] .= '</tr></thead>';
        $result['message'] .= '<tbody>';

        foreach ($modelct as $i => $item) {

            $result['message'] .= '<tr class="text-center">';
            $result['message'] .= '<td>' . ++$i . '</td>';
            $result['message'] .= '<td>';
            foreach ($dmmanghetrinhdo as $manghetd) {
                if ($manghetd->madmmntd == $item->tencongviec) {
                    $result['message'] .= '<span>'.$manghetd->tenmntd.'</span>';
                }
            }
            $result['message'] .= '</td>';
            $result['message'] .= '<td>' . $item->soluong . '</td>';
            $result['message'] .= '<td>' . $item->mota . '</td>';
            $result['message'] .= '<td>' . $item->kinhnghiem . '</td>';
            $result['message'] .= '<td>' . $item->noilamviec . '</td>';
            $result['message'] .= '<td>' . $item->luong . '</td>';
            $result['message'] .= '<td>';
            $result['message'] .= '<a title="Sửa chi tiết" onclick="setedit(' . $item->id . ')" data-toggle="modal"';
            $result['message'] .= 'data-target="#create_modal" type="button" class="btn btn-sm btn-clean btn-icon">';
            $result['message'] .= '<i class="icon-lg la flaticon-edit-1 text-primary"></i>' . $item->id . '</a>';
            $result['message'] .= '<button title="Xóa" onclick="setdelete(' . $item->id . ')"';
            $result['message'] .= 'data-toggle="modal" data-target="#delete-modal"';
            $result['message'] .= 'class="btn btn-sm btn-clean btn-icon">';
            $result['message'] .= '<i class="icon-lg flaticon-delete text-danger"></i>';
            $result['message'] .= '</button></td></tr>';
        }
        $result['message'] .= '</p>';
        $result['message'] .= '</table></div></div></div></div></div>';

        return $result;
    }
}
