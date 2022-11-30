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
                <b>Đơn vị:</b>
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
               DANH SÁCH DOANH NGHIỆP
            </td>
        </tr>
    </table>

    <table id="data_body" class="money" cellspacing="0" cellpadding="0" border="1"
        style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;">
        <thead>
            <tr style="padding-left: 2px;padding-right: 2px">
                <th style="width: 5%;">S</br>T</br>T</th>
                <th style="width: 20%;">Tên doanh nghiệp</th>
                <th>Mã số doanh nghiệp</th>
                <th>Mã số DKKD</th>
                <th>Địa chỉ</th>
                <th>Khu công nghiệp</th>
                <th>Loại hình doanh nghiệp</th>
                <th>Ngành nghề</th>

            </tr>
        </thead>
        @foreach ($model as $key => $ct )
        <tr>
            <td>{{++$key}}</td>
            <td>{{$ct->name}}</td>
            <td>{{$ct->masodn}}</td>
            <td>{{$ct->dkkd}}</td>
            <td>{{$ct->adress}}</td>
            <td>{{$ct->khucn=='0'?'':$ct->khucn}}</td>
            <td>{{$ct->loaihinh}}</td>
                <td>{{$ct->nganhnghe}}</td>
        </tr>
        @endforeach
       
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
