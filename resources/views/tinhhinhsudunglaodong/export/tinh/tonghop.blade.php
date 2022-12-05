@extends('main_baocao')

@section('content')
    <table id="data_header" class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
        style="margin:0 auto 25px; text-align: center;">
        <tr>
            <td style="text-align: left;width: 60%">

            </td>
            <td style="text-align: center;">

            </td>
        </tr>
        <tr>
            <td style="text-align: left;width: 60%">
                <b>Đơn vị: {{ isset($m_dv) ? $m_dv->name : '' }}</b>
            </td>
            <td style="text-align: center; font-style: italic">

            </td>
        </tr>
        <tr>
            <td style="text-align: left;width: 60%">
                <b>Mã đơn vị SDNS: </b>
            </td>

            <td style="text-align: center; font-style: italic">

            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: center; font-weight: bold; font-size: 20px;">
                BÁO CÁO</br>TÌNH HÌNH SỬ DỤNG LAO ĐỘNG
            </td>
        </tr>
    </table>

    <table id="data_body" class="money" cellspacing="0" cellpadding="0" border="1"
        style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;">
        <thead>
            <tr style="padding-left: 2px;padding-right: 2px">
                <th style="width: 3%;" rowspan="2">S</br>T</br>T</th>
                <th style="width: 20%;" rowspan="2">Người sử dụng lao động</th>
                <th colspan="4" style="width: 20%;">Tổng số lao động</th>
                <th colspan="4" style="width: 20%;">Vị trí việc làm</th>
                <th colspan="3" style="width: 20%;">Loại và hiệu lực hợp đồng hợp đồng</th>
                <th rowspan="2">Ghi chú</th>
            </tr>
            <tr>
                <th >Tổng</th>
                <th >Lao động nữ</th>
                <th >Lao động trên 35 tuổi</th>
                <th >Số lao động tham gia</br>BHXH bắt buộc</th>
                <th >Nhà quản lý</th>
                <th >Chuyên môn</br>kỹ thuật</br>bậc cao</th>
                <th >Chuyên môn</br>kỹ thuật</br>bậc trung</th>
                <th >Khác</th>
                <th >Số lao động tham gia HĐLĐ không xác định thời hạn</th>
                <th >Số lao động tham gia HĐLĐ xác định thời hạn</th>
                <th >Số lao động tham gia HĐLĐ khác (dưới 1 tháng, thử việc)</th>
            </tr>
          
            <tr class="text-center">
                @for ($i=1;$i<15;$i++)
                <th>{{$i}}</th>
                @endfor
            </tr>
                
           

        </thead>
        <tbody>
                @foreach ($model as $ct )
                    <tr class="text-center">
                        <td>{{$ct['tt']}}</td>
                        <td class="text-left">{{$ct['noidung']}}</td>
                        <td>{{dinhdangso($ct['tong'])}}</td>
                        <td>{{dinhdangso($ct['tongnu'])}}</td>
                        <td>{{dinhdangso($ct['tren35tuoi'])}}</td>
                        <td>{{dinhdangso($ct['BHXH'])}}</td>
                        <td>{{dinhdangso($ct['nhaquanly'])}}</td>
                        <td>{{dinhdangso($ct['cmktbaccao'])}}</td>
                        <td>{{dinhdangso($ct['cmktbactrung'])}}</td>
                        <td>{{dinhdangso($ct['cmktkhac'])}}</td>
                        <td>{{dinhdangso($ct['bhxhkhongxacdinh'])}}</td>
                        <td>{{dinhdangso($ct['bhxhxacdinh'])}}</td>
                        <td>{{dinhdangso($ct['bhxhkhac'])}}</td>
                        <td></td>
                    </tr>
                @endforeach
                <tr class="text-center" style="font-weight: bold;">
                    <td colspan="2">Tổng</td>
                    <td>{{dinhdangso($model[0]['tong'] + $model[1]['tong'] + $model[2]['tong'])}}</td>
                    <td>{{dinhdangso($model[0]['tongnu'] + $model[1]['tongnu'] + $model[2]['tongnu'])}}</td>
                    <td>{{dinhdangso($model[0]['tren35tuoi'] + $model[1]['tren35tuoi'] + $model[2]['tren35tuoi'])}}</td>
                    <td>{{dinhdangso($model[0]['BHXH'] + $model[1]['BHXH'] + $model[2]['BHXH'])}}</td>
                    <td>{{dinhdangso($model[0]['nhaquanly'] + $model[1]['nhaquanly'] + $model[2]['nhaquanly'])}}</td>
                    <td>{{dinhdangso($model[0]['cmktbaccao'] + $model[1]['cmktbaccao'] + $model[2]['cmktbaccao'])}}</td>
                    <td>{{dinhdangso($model[0]['cmktbactrung'] + $model[1]['cmktbactrung'] + $model[2]['cmktbactrung'])}}</td>
                    <td>{{dinhdangso($model[0]['cmktkhac'] + $model[1]['cmktkhac'] + $model[2]['cmktkhac'])}}</td>
                    <td>{{dinhdangso($model[0]['bhxhkhongxacdinh'] + $model[1]['bhxhkhongxacdinh'] + $model[2]['bhxhkhongxacdinh'])}}</td>
                    <td>{{dinhdangso($model[0]['bhxhxacdinh'] + $model[1]['bhxhxacdinh'] + $model[2]['bhxhxacdinh'])}}</td>
                    <td>{{dinhdangso($model[0]['bhxhkhac'] + $model[1]['bhxhkhac'] + $model[2]['bhxhkhac'])}}</td>
                    <td></td>

                </tr>
        </tbody>

    </table>

    <table id="data_footer" class="header" width="96%" border="0" cellspacing="0" cellpadding="8"
        style="margin:20px auto; text-align: center;">

        <tr style="font-weight: bold">
            <td style="text-align: center;" width="50%">Người lập bảng</td>
            <td style="text-align: center;" width="50%"></td>
        </tr>
        <tr style="font-style: italic">
            <td style="text-align: center;" width="50%">(Ghi rõ họ tên)</td>
            <td style="text-align: center;" width="50%">(Ký tên, đóng dấu)</td>
        </tr>
        <tr>
            <td><br><br><br><br><br><br></td>
        </tr>

        <tr>
            <td style="text-align: center;" width="50%"></td>
            <td style="text-align: center;" width="50%"></td>
        </tr>
    </table>
@stop
