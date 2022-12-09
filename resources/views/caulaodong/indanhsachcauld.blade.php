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
        <b>Đơn vị: {{isset($m_dv)?$m_dv->tendv:''}}</b>
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
        DANH SÁCH THÔNG TIN CẦU LAO ĐỘNG
    </td>
</tr>
</table>

    <table cellspacing="0" cellpadding="0" border="1">
        <tr>
            <th>STT</th>
            <th>Doanh nghiệp</th>
            <th>Mã nghề cấp 2</th>
            <th>Số lượng</th>
        </tr>

        @if ($model != null)
            @foreach ($model as $i => $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        @foreach ($company as $com)
                            @if ($item->madn == $com->madv)
                                {{ $com->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($manghecap2 as $mnghe)
                            @if ($item->tencongviec == $mnghe->madmmntd)
                                {{ $mnghe->tenmntd }}
                            @endif
                        @endforeach
                    </td>
                    <td style="text-align: center">{{ $item->soluong }}</td>
                </tr>
            @endforeach
            <?php
            $sum = 0;
            foreach ($model as $item) {
                $sum += $item->soluong;
            }
            
            ?>
            <tr>
                <td style="text-align: center;font-weight: bold;text-transform: uppercase;">Tổng</td>
                <td></td>
                <td></td>
                <td style="text-align: center">{{ $sum }}</td>
            </tr>
        @endif

    </table>

@stop
