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
                <b>Đơn vị: {{isset($m_dv)?$m_dv->name:''}}</b>
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
                DANH SÁCH THÔNG TIN LAO ĐỘNG NƯỚC NGOÀI
            </td>
        </tr>
    </table>

    <table id="data_body" class="money" cellspacing="0" cellpadding="0" border="1"
        style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;">
        <thead>
            <tr style="padding-left: 2px;padding-right: 2px">
                <th style="width: 5%;" >S</br>T</br>T</th>
                <th style="width: 20%;">Họ và tên</th>
                <th >Ngày sinh</th>
                <th >Giới tính</th>
                <th >Quốc tịch</th>
                <th>Số hộ chiếu</th>
                <th> Ngày cấp</br>Số hộ chiếu</th>
                <th> Số giấy phép lao động</th>
                <th> Ngày cấp</br>giấy phép lao động</th>
                <th> Trình độ</th>
                <th> Vị trí việc làm</th>

            </tr>

        </thead>
        <tbody>
            @if (isset($model))
                @foreach ($model as $key => $ct)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $ct->hoten }}</td>
                        <td>{{ $ct->ngaysinh }}</td>
                        <td>{{ $ct->gioitinh }}</td>
                        <td>{{ $ct->quoctich }}</td>
                        <td>{{ $ct->cmnd }}</td>
    
                        <td>{{ $ct->ngaycapcmnd }}</td>
                        <td>{{ $ct->giaypheplaodong }}</td>
                        <td>{{ $ct->ngaycapgiaypheplaodong }}</td>
                        <td>{{ $ct->trinhdo }}</td>
                        <td>{{ $ct->vitricongviec }}</td>


                    </tr>
                @endforeach
            @endif
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
