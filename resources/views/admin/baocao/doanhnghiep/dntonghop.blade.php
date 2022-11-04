@extends('HeThong.main_report')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <span style="text-transform: uppercase"></span><br>
                <span style="text-transform: uppercase;font-weight: bold"></span>
                <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

            </td>
            <td style="vertical-align: top;">
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b>
                <hr style="width: 15%;vertical-align: top; margin-top: 2px">

            </td>
        </tr>
        <tr>
            <td>Số: ......../.........</td>
            <td style="text-align: right"><i style="margin-right: 40%;">Quảng Bình, ngày .... tháng .... năm ....</i></td>
        </tr>
    </table>
    <p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">BÁO CÁO <br>TÌNH HÌNH SỬ
        DỤNG LAO ĐỘNG</p>
    <p style="text-align: left;font-style: italic;">Thông tin:</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;"
        id="data">
        <thead>
            <tr style="text-align: center">
                <th rowspan="3">STT</th>
                <th rowspan="3">Họ tên</th>
                <th rowspan="3">Mã số BHXH</th>
                <th rowspan="3">Ngày tháng năm sinh</th>
                <th rowspan="3">Giới tính</th>
                <th rowspan="3">Số CCCD/ CMTND/ hộ chiếu</th>
                <th rowspan="3">Cấp bậc chức vụ, chức ranh nghề, nơi làm việc </th>
                <th colspan="4">Vị trí việc làm </th>
                <th colspan="6">Tiền lương</th>
                <th rowspan="2" colspan="2">Ngành/ nghề nặng nhọc, độc hại</th>
                <th colspan="5">Loại và hiệu lực hợp đồng lao động</th>
                <th rowspan="3">Thời điểm đơn vị bắt đầu đóng BHXH</th>
                <th rowspan="3">Thời điểm đơn vị kết thúc đóng BHXH</th>
                <th rowspan="3">Ghi chú</th>
            </tr>
            <tr>
                <th rowspan="2">Nhà quản lý</th>
                <th rowspan="2">Chuyên môn kỹ thuật bậc cao</th>
                <th rowspan="2">Chuyên môn kỹ thuật bậc trung</th>
                <th rowspan="2">khác</th>
                <th rowspan="2">Hệ số/ Mức lương</th>
                <th colspan="5">Phụ cấp</th>
                <th rowspan="2">Ngày bắt đầu HĐLĐ không xác thời hạn</th>
                <th colspan="2">Hiệu lực HĐLĐ xác định thời hạn </th>
                <th colspan="2">Hiệu lực HĐLĐ khác (dưới 1 tháng, thử việc)</th>
            </tr>
            <tr>
                <th>Chức vụ</th>
                <th>Thâm niên VK (%)</th>
                <th>Thâm niên nghề (%)</th>
                <th>Phụ cấp lương</th>
                <th>Các khoan bổ sung</th>
                <th>Ngày bắt đầu </th>
                <th>Ngày kết thúc </th>
                <th>Ngày bắt đầu </th>
                <th>Ngày kết thúc </th>
                <th>Ngày bắt đầu </th>
                <th>Ngày kết thúc </th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            {{-- @foreach ($model as $key => $tt)
            <tr>
                <td style="text-align: center">{{$i++}}</td>
                <td>{{$tt->dvthue}}</td>
                <td style="text-align: center">{{dinhdangsothapphan($tt->dientichsd,2)}}</td>
                <td style="text-align: center">{{$tt->soqdpd}}</td>
                <td style="text-align: center">{{getDayVn($tt->thoigianpd,2)}}</td>
                <td style="text-align: center">{{$tt->soqdgkd}}</td>
                <td style="text-align: center">{{getDayVn($tt->thoigiangkd,2)}}</td>
                <td style="text-align: center">{{dinhdangsothapphan($tt->giakhoidiem,2)}}</td>
                <td style="text-align: right">{{dinhdangsothapphan($tt->giatri,2)}}</td>
                <td></td>
            </tr>
        @endforeach --}}
            <tr style="font-weight: bold" class="text-right;">
                <td colspan="3">Tổng cộng</td>
                <td style="text-align: center"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center"></td>
                <td style="text-align: right"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table width="96%" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">

            </td>
            <td style="vertical-align: top;">
                <b>ĐẠI DIỆN DOANH NGHIỆP, CƠ QUAN, TỔ CHỨC</b><br>
                <i>(Chữ ký, dấu)</i>
            </td>
        </tr>
    </table>
@stop
