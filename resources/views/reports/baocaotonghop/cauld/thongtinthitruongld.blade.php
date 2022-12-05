@extends('main_baocao')
@section('custom-style')
@stop


@section('custom-script')

@stop

@section('content')
    <table width="96%" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
        <tr>
            <td width="40%" style="vertical-align: top;">
                <p style="text-transform: uppercase">ỦY BAN NHÂN DÂN</p>
                <span style="text-transform: uppercase;font-weight: bold">SỞ LAO ĐỘNG - THƯƠNG BINH VÀ XÃ HỘI</span>
                <hr style="width: 10%;vertical-align: top;  margin-top: 2px">

            </td>
            <td style="vertical-align: top;">
                <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM<br>
                    Độc lập - Tự do - Hạnh phúc</b>
                <hr style="color: black;;width: 15%;vertical-align: top; margin-top: 2px">

            </td>
        </tr>
        <tr>
            <td>Số: ....../BC-SLĐTBXH</td>
            <td style="text-align: right"><i style="margin-right: 30%;">Quảng Bình, ngày .... tháng .... năm ....</i></td>
        </tr>
    </table>
    <p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">BÁO CÁO <br>VỀ THÔNG TIN THỊ TRƯỜNG LAO ĐỘNG  NĂM......</p>
    <p style="text-align: center;font-style: italic;">Kính gửi: - Bộ Lao động - Thương binh và Xã hội<br>
                                                                    - Ủy ban nhân dân tỉnh/thành phố</p>

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
        {{-- cung --}}
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
        {{-- cầu --}}
        <tr>
            <td colspan="5" style="font-weight: bold; text-transform: uppercase;text-align: left">II. THÔNG TIN CẦU LAO ĐỘNG</td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">1</td>
            <td  style="font-weight: bold;">Tổng số doanh nghiệp</td>
            <td style="text-align: center;">DN</td><td></td><td></td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">2</td>
            <td  style="font-weight: bold;">Tổng số lao dộng</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> a </td><td> Chia theo loại lao động </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Lao động nữ</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Lao động trên 35 tuổi</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>

        <tr>
            <td></td><td>- Lao động tham gia BHXH bắt buộc</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td> b </td><td> Chia theo vị trí việc làm </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Nhà quản lý</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Chuyên môn kỹ thuật bậc cao</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Chuyên môn kỹ thuật bậc trung</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>- Khác</td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        {{-- nhu cầu tuyển dụng --}}
        <tr>
            <td colspan="5" style="font-weight: bold; text-transform: uppercase;text-align: left">III. THÔNG TIN NHU CẦU TUYỂN DỤNG LAO ĐỘNG</td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">1</td>
            <td  style="font-weight: bold;">Tổng số lượng tuyển</td>
            <td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td  style="font-weight: bold;">2</td>
            <td colspan="5"  style="font-weight: bold;">Chia theo loại hình</td>
            
        </tr>
    
        @foreach ($loaihinhkt as $i => $lh)
        <?php 
            $dsnhucau = [];
            $dsdoanhnghiep = [];
            $kytruoc = 0;
            $kybaocao = 0;
            $nam2 = $nam - 1;
            $namtruoc = (string)$nam2;
            $nambaocao = (string)$nam;

        foreach ($company as  $item) {

            if ($item->loaihinh == $lh->madmlhkt) {
                array_push($dsdoanhnghiep, $item);

            }
        }
             
            foreach ($nhucautuyendung as  $item) {
                foreach ($dsdoanhnghiep as  $item2) {
                    if ($item->madn == $item2->user) {
                        $a = $item ;
                        
                         array_push($dsnhucau, $a);
                        
                    }
                }
            }

           foreach ($dsnhucau as  $item) {
                if ($item->nam == $namtruoc) {
                    $kytruoc += $item->soluong; 
                }
           }

           foreach ($dsnhucau as  $item) {
                if ($item->nam == $nambaocao) {
                    $kybaocao += $item->soluong; 
                   
                }
           }
        ?>
        <tr>
            @if ($i == 0)
            <td>a</td>
            @endif
            @if ($i == 1)
            <td>b</td>
            @endif
            @if ($i == 2)
            <td>c</td>
            @endif
            @if ($i == 3)
            <td>d</td>
            @endif
            @if ($i == 4)
            <td>e</td>
            @endif
            @if ($i == 5)
            <td>g</td>
            @endif
            <td> {{$lh->tenlhkt}} </td><td style="text-align: center;">Người</td>
            <td  style="text-align: center;">{{  $kytruoc }}</td><td  style="text-align: center;">{{$kybaocao }}</td>
        </tr>
        @endforeach

        <tr>
            <td  style="font-weight: bold;">2</td>
            <td colspan="5"  style="font-weight: bold;">Chia theo mã nghề cấp 2</td>
           
        </tr>

        <tr>
            <td></td><td> Nhà quản lý của các cơ quan Tập đoàn, Tổng công ty và tương đương (chuyên trách) </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhà chuyên môn trong lĩnh vực khoa học và kỹ thuật </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>  Nhà chuyên môn về sức khỏe </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>    Nhà chuyên môn về giảng dạy </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>  Nhà chuyên môn về kinh doanh và quản lý </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>

        <tr>
            <td></td><td>  Nhà chuyên môn trong lĩnh vực công nghệ thông tin và truyền thông </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhà chuyên môn về luật pháp, văn hóa, xã hội </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>  Kỹ thuật viên khoa học và kỹ thuật </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>

        <tr>
            <td></td><td> Kỹ thuật viên sức khỏe </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên về kinh doanh và quản lý  </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên luật pháp, văn hóa, xã hội </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Kỹ thuật viên thông tin và truyền thông </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Giáo viên bậc trung </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên tổng hợp và nhân viên làm các công việc bàn giấy </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên dịch vụ khách hàng </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên ghi chép số liệu và vật liệu </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên hỗ trợ văn phòng khác </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên dịch vụ cá nhân </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>  Nhân viên bán hàng </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên chăm sóc cá nhân </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Nhân viên dịch vụ bảo vệ </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lao động có kỹ năng trong nông nghiệp có sản phẩm chủ yếu để bán </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lao động có kỹ năng trong lâm nghiệp, thủy sản và săn bắn có sản phẩm chủ yếu để bán  </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>

        <tr>
            <td></td><td> Lao động tự cung tự cấp trong nông nghiệp, lâm nghiệp và thủy sản </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lao động xây dựng và lao động có liên quan đến nghề xây dựng (trừ thợ điện) </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Thợ luyện kim, cơ khí và thợ có liên quan </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Thợ thủ công và thợ liên quan đến in </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Thợ điện và thợ điện tử </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Thợ chế biến thực phẩm, gia công gỗ, may mặc, đồ thủ công và thợ có liên quan khác </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Thợ vận hành máy móc và thiết bị  </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>       
        <tr>
            <td></td><td> Thợ lắp ráp </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lái xe và thợ vận hành thiết bị chuyển động </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Người quét dọn và giúp việc </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lao động giản đơn trong nông nghiệp, lâm nghiệp và thủy sản </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Lao động trong ngành khai khoáng, xây dựng, công nghiệp chế biến, chế tạo và giao thông vận tải </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Người phụ giúp chuẩn bị thực phẩm </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td>Lao động trên đường phố và lao động có liên quan đến bán hàng  </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
        <tr>
            <td></td><td> Người thu dọn vật thải và lao động giản đơn khác </td><td style="text-align: center;">Người</td><td></td><td></td>
        </tr>
    </table>

    <table width="96%" cellspacing="0" height cellpadding="0" style="margin: 20px auto;text-align: center; height:200px">
        <tr>
            <td width="40%" style="text-align: left; vertical-align: top;">
            </td>
            <td style="vertical-align: top;">
                <b>GIÁM ĐỐC</b><br>
                <i>(Chữ ký, dấu)</i>
            </td>
        </tr>
    </table>
@stop


