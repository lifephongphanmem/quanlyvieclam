@extends('main_baocao')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
             
                <p>Tỉnh, thành phố ...............................................</p>
                <p>Quận, huyện, thị xã .........................................</p>
                <p>Xã, phường, thị trấn ........................................</p>
                <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

            </td>
            <td style="vertical-align: top;">
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b>
                <hr style="color: black;width: 15%;vertical-align: top; margin-top: 2px">
            </td>
        </tr>
        <tr>
            <td>Số: ......../BC-</td>
            <td style="text-align: right"><i style="margin-right: 40%;">Quảng Bình, ngày .... tháng .... năm ....</i></td>
        </tr>
    </table>
    <p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">BÁO CÁO <br>VỀ THÔNG TIN CUNG LAO ĐỘNG NĂM......</p>
    <p style="text-align: center;font-style: italic;">Kính gửi: - Ủy ban nhân dân ................................................<br>- Sở Lao động - Thương binh và Xã hội</p>

    <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;"
        id="data">

        <tr>
            <th style="width: 5%;">STT</th>
            <th style="width: 45%;">Chỉ tiêu</th>
            <th style="width: 10%;">Đơn vị</th>
            <th style="width: 20%;">Kỳ trước</th>
            <th style="width: 20%;">Kỳ báo cáo</th>
        </tr>
        <tr style="text-align: center">
            <td> A </td>
            <td> B </td>
            <td> C </td>
            <td> 1 </td>
            <td> 2 </td>
        </tr>
        <tr>
            <td colspan="5" style="font-weight: bold; text-transform: uppercase;text-align: left">I. THÔNG TIN CUNG LAO ĐỘNG</td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">1</td>
            <td  style="font-weight: bold;">Số người từ 15 tuổi trở lên</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>a</td>
            <td colspan="4">Chia theo khu vực</td>
        </tr>
        <tr>
            <td></td><td>- Thành thị</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Nông thôn</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>b</td>
            <td colspan="4">Chia theo giới tính</td>
        </tr>
        <tr>
            <td></td><td>- Nam</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Nữ</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">2</td>
            <td  style="font-weight: bold;">Số người có việc làm</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>a</td>
            <td colspan="4">Chia theo Khu vực</td>
        </tr>
        <tr>
            <td></td><td>- Thành thị</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Nông thôn</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>b</td>
            <td colspan="4">Chia theo trình độ chuyên môn kỹ thật</td>
        </tr>
        <tr>
            <td></td><td>- Chưa qua đào tạo</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- CNKT không bằng</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Chứng chỉ nghề dưới 3 tháng</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Sơ cấp</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Trung cấp</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Cao đẳng</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Đại học</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Trên đại học</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>c</td>
            <td colspan="4">Chia theo việc làm</td>
        </tr>
        <tr>
            <td></td><td>Chủ cơ sở sản xuất kinh doanh</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>Tự làm</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>Lao động gia đình</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>Làm công ăn lương</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">3</td>
            <td  style="font-weight: bold;">Số người thất nghiệp</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>a</td>
            <td colspan="4">Chia theo Khu vực</td>
        </tr>
        <tr>
            <td></td><td>- Thành thị</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Nông thôn</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>b</td>
            <td colspan="4">Chia theo trình độ chuyên môn kỹ thật</td>
        </tr>
        <tr>
            <td></td><td>- Chưa qua đào tạo</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- CNKT không bằng</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Chứng chỉ nghề dưới 3 tháng</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Sơ cấp</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Trung cấp</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Cao đẳng</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Đại học</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Trên đại học</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td>b</td>
            <td colspan="4">Chia theo thời gian thất nghiệp</td>
        </tr>
        <tr>
            <td></td><td>- Dưới 3 tháng</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Từ 3 tháng đến 1 năm</td> <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Trên 1 năm</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">4</td>
            <td  style="font-weight: bold;">Số người không tham gia hoạt động kinh tế</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> a </td><td> Đi học </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> b </td><td> Hưu trí </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> c </td><td> Nội trợ </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> d </td><td> Khuyết tật </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> e </td><td> Khác </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>

    </table>
    <table width="96%" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">

            </td>
            <td style="vertical-align: top;">
                <b>ỦY BAN NHÂN DÂN.......................</b><br>
                <i>(Chữ ký, dấu)</i>
            </td>
        </tr>
    </table>
@stop
