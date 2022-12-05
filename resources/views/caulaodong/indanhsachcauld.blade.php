@extends('main_baocao')
@section('custom-style')
@stop
@section('custom-script')
@stop
@section('content')

    <p style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase;">
        DANH SÁCH NHU CẦU LAO ĐỘNG
    </p>

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
                                <span>{{ $com->name }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($manghecap2 as $mnghe)
                            @if ($item->tencongviec == $mnghe->madmmntd)
                                <span>{{ $mnghe->tenmntd }}</span>
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
