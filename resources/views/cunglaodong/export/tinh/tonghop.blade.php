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
                DANH SÁCH THÔNG TIN CUNG LAO ĐỘNG
            </td>
        </tr>
    </table>

    <table id="data_body" class="money" cellspacing="0" cellpadding="0" border="1"
        style="margin: 20px auto; border-collapse: collapse;font:normal 11px Times, serif;">
        <thead>
            <tr style="padding-left: 2px;padding-right: 2px">
                <th style="width: 5%;" rowspan="4">S</br>T</br>T</th>
                <th style="width: 20%;" rowspan="4">Họ và tên</th>
                <th rowspan="4">Ngày sinh</th>
                <th colspan="2">Giới tính</th>
                <th rowspan="4">CCCD/</br>CMND</th>
                <th style="width: 20%;" rowspan="4">Nơi đăng ký</br>thường trú</th>
                <th style="width: 20%;" rowspan="4">Nơi ở</br>hiện tại</th>
                <th rowspan="4">Số điện thoại</th>
                <th colspan="{{ isset($doituong_ut) ? count($doituong_ut) : '' }}">Đối tượng ưu tiên</th>
                <th colspan="{{ isset($gdpt) ? count($gdpt) : '' }}">Trình độ GDPT</br>cao nhất</br>đạt được</th>
                <th colspan="{{ isset($cmkt) ? count($cmkt) : '' }}">Trình độ CMKT</br>cao nhất</th>
                <th rowspan="4">Chuyên ngành</br>đào tạo</th>
                <th colspan="{{ isset($tttghdkt) ? count($tttghdkt) : '' }}">Tình trạng</br>tham
                    gia</br>hoạt
                    động</br>kinh
                    tế
                </th>
                @if (isset($tttghdkt))
                    @foreach ($tttghdkt as $tt)
                        <?php $m_tt = $tttghdkt1->where('manhom', $tt->madmtgkt);
                        $a_m_tt = array_column($m_tt->toarray(), 'madmtgktct');
                        $m_ct = $tttghdkt2->wherein('manhom2', $a_m_tt);
                        ?>
                        @if (count($m_ct) > 0)
                            @foreach ($m_tt as $val)
                                <?php $m_ttct = $tttghdkt2->where('manhom2', $val->madmtgktct); ?>
                                @if (count($m_ttct) > 0)
                                    <th colspan="{{ count($m_tt) + count($m_ttct) - 1 }}">{{ $tt->tentgkt }}</th>
                                @endif
                            @endforeach
                        @else
                            <th colspan="{{ count($m_tt) }}">{{ $tt->tentgkt }}</th>
                        @endif
                    @endforeach
                @endif

            </tr>
            <tr>
                <th rowspan="3">Nam</th>
                <th rowspan="3">Nữ</th>
                @if (isset($doituong_ut))
                    @foreach ($doituong_ut as $dt)
                        <th rowspan="3">{{ $dt->tendoituong }}</th>
                    @endforeach
                @else
                    <th rowspan="3"></th>
                @endif
                @if (isset($gdpt))
                    @foreach ($gdpt as $gd)
                        <th rowspan="3">{{ $gd->tengdpt }}</th>
                    @endforeach
                @else
                    <th rowspan="3"></th>
                @endif
                @if (isset($cmkt))
                    @foreach ($cmkt as $cm)
                        <th rowspan="3">{{ $cm->tentdkt }}</th>
                    @endforeach
                @else
                    <th rowspan="3"></th>
                @endif
                @if (isset($tttghdkt))
                    @foreach ($tttghdkt as $tt)
                        <th rowspan="2">{{ $tt->tentgkt }}</th>
                    @endforeach
                @else
                    <th></th>
                @endif
                @if (isset($tttghdkt))
                    @foreach ($tttghdkt as $tt)
                        <?php $m_tt1 = $tttghdkt1->where('manhom', $tt->madmtgkt); ?>
                        @foreach ($m_tt1 as $val)
                            <?php $m_ttct1 = $m_ttct = $tttghdkt2->where('manhom2', $val->madmtgktct); ?>
                            @if (count($m_ttct1) > 0)
                                <th colspan="{{ count($m_ttct1) }}">{{ $val->tentgktct }}</th>
                            @else
                                <th rowspan="2">{{ $val->tentgktct }}</th>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <th></th>
                @endif
            </tr>
            <tr>
                @if (isset($tttghdkt))
                    @foreach ($tttghdkt as $tt)
                        <?php $m_tt1 = $tttghdkt1->where('manhom', $tt->madmtgkt); ?>
                        @foreach ($m_tt1 as $val)
                            <?php $m_ttct = $tttghdkt2->where('manhom2', $val->madmtgktct); ?>
                            @if (count($m_ttct) > 0)
                                @foreach ($m_ttct as $item)
                                    <th>{{ $item->tentgktct2 }}</th>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (isset($model))
                @foreach ($model_dv as $k => $val)
                    <tr style="font-weight: bold">
                        <td>{{convert2Roman(++$k)}}</td>
                        <td colspan="43">{{$val->name}}</td>
                    </tr>
                    {{-- <?php $m_th=$model->where('madv',$val->madv) ?> --}}
                    <?php $m_th = $model->where('madvbc', $val->madv); ?>
                    @foreach ($m_th as $key=>$ct )
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $ct->hoten }}</td>
                        <td>{{ $ct->ngaysinh }}</td>
                        @if ($ct->gioitinh == 'nam' || $ct->gioitinh == 'Nam')
                            <td>{{ $ct->gioitinh }}</td>
                            <td></td>
                        @else
                            <td></td>
                            <td>{{ $ct->gioitinh }}</td>
                        @endif
                        <td>{{ $ct->cmnd }}</td>
                        <td>{{ $ct->thuongtru }}</td>
                        <td>{{ $ct->tamtru }}</td>
                        <td>{{ $ct->phone }}</td>
                        @if (isset($doituong_ut))
                            @foreach ($doituong_ut as $dt)
                                <td>{{ $dt->madmdt == $ct->doituonguutien ? 'X' : '' }}</td>
                            @endforeach
                        @else
                            <td></td>
                        @endif

                        @if (isset($gdpt))
                            @foreach ($gdpt as $gd)
                                <td class="text-center">{{ $gd->madmgdpt == $ct->trinhdogiaoduc ? 'X' : '' }}</td>
                            @endforeach
                        @else
                            <td></td>
                        @endif

                        @if (isset($cmkt))
                            @foreach ($cmkt as $cm)
                                <td class="text-center">{{ $cm->madmtdkt == $ct->trinhdocmkt ? 'X' : '' }}</td>
                            @endforeach
                        @else
                            <td></td>
                        @endif
                        <td>{{isset($ct->linhvucdaotao)?$a_chuyennganh[$ct->linhvucdaotao]:''}}</td>
                        @if (isset($tttghdkt))
                            @foreach ($tttghdkt as $tt)
                                <td class="text-center">{{ $tt->madmtgkt == $ct->tinhtrangvl ? 'X' : '' }}</td>
                            @endforeach
                        @else
                            <td></td>
                        @endif

                        {{-- @if (isset($tttghdkt))
                        @foreach ($tttghdkt as $tt)
                            <?php $m_tt = $tttghdkt1->where('manhom', $tt->madmtgkt);
                            $a_m_tt = array_column($m_tt->toarray(), 'madmtgktct');
                            $m_ct = $tttghdkt2->wherein('manhom2', $a_m_tt);
                            ?>
                            @if (count($m_ct) > 0)
                                @foreach ($m_tt as $val)
                                    <?php $m_ttct = $tttghdkt2->where('manhom2', $val->madmtgktct); ?>
                                    @if (count($m_ttct) > 0)
                                    @if ($ttct->madmtgktct2 == $ct->vithevl)
                                    <td class="text-center">{{ 'X' }}</td>
                                @elseif($ttct->madmtgktct2 == $ct->thoigianthatnghiep)
                                    <td class="text-center">{{ 'X' }}</td>
                                    @else
                                    <td></td>
                                @endif
                                    @endif
                                @endforeach
                            @else
                            <td>{{$ct->nghenghiep}}</td>
                            @endif
                        @endforeach
                    @endif --}}

                        @if (isset($tttghdkt))
                            @foreach ($tttghdkt as $tt)
                                <?php $m_tt1 = $tttghdkt1->where('manhom', $tt->madmtgkt);?>
                                @foreach ($m_tt1 as $val)
                                    <?php $m_ttct1 = $tttghdkt2->where('manhom2', $val->madmtgktct); ?>
                                    @if (count($m_ttct1) > 0)
                                        @foreach ($m_ttct1 as $ttct)
                                            @if ($ttct->madmtgktct2 == $ct->vithevl)
                                                <td class="text-center">{{ 'X' }}</td>
                                            @elseif($ttct->madmtgktct2 == $ct->thoigianthatnghiep)
                                                <td class="text-center">{{ 'X' }}</td>
                                                @else
                                                <td></td>
                                            @endif
                                        @endforeach
                                    @else
                                        @if ($ct->lydoktg == $val->madmtgktct)
                                        <td class="text-center">{{ 'X' }}</td>
                                        @elseif($ct->thatnghiep == $val->madmtgktct)
                                        <td class="text-center">{{ 'X' }}</td>
                                        @else
                                        <td></td>
                                        @endif
                                       
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <th></th>
                        @endif

                    </tr>
                                            
                    @endforeach
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
