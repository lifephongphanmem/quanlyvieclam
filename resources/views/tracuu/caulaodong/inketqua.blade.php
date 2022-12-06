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
                THÔNG TIN KẾT QUẢ TÌM KIẾM NHU CẦU LAO ĐỘNG
            </td>
        </tr>
    </table>
    <table id="data_body" class="money" cellspacing="0" cellpadding="0" border="1"
        style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;">
        <thead>
            <thead>
                <tr class="text-center">
                    <th width="2%"> STT </th>
                    <th width="2%">Năm </th>
                    <th width="10%">Doanh nghiệp</th>
                    <th width="15%">Tên công việc</th>
                    <th width="5%">Số lượng</th>
                    <th width="5%">Trình độ văn hóa</th>
                    <th width="5%">Chuyên ngành</th>
                    <th width="5%">Kinh nghiệm</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($model as $key => $tb)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $tb->nam }}</td>
                        <td  class="text-left">{{ $tb->madn != null ? $a_doanhnghiep[$tb->madn]:'' }} </td>
                        <td > {{ $tb->tencongviec != null ? $a_congviec[$tb->tencongviec]:'' }}</td>
                        <td> {{ $tb->soluong }}</td>
                        <td>
                            {{ $tb->tdvanhoa != null ? $a_trinhdovanhoa[$tb->tdvanhoa]:'' }}
                        </td>
                        <td>{{ $tb->chuyennganh }}</td>
                        <td>{{ $tb->kinhnghiem }}</td>
                    </tr>
                @endforeach
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
@endsection
