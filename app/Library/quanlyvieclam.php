<?php

function chkPhanQuyen($machucnang = null, $tenphanquyen = null)
{
    //return true;
    //Kiểm tra giao diện (danhmucchucnang)
    if (!chkGiaoDien($machucnang)) {
        return false;
    }
    $capdo = session('admin')->capdo;

    if (in_array($capdo, ['SSA', 'ssa',])) {
        return true;
    }
    // dd(session('phanquyen'));
    return session('phanquyen')[$machucnang][$tenphanquyen] ?? 0;
}

function chkGiaoDien($machucnang, $tentruong = 'trangthai')
{
    $chk = session('chucnang')[$machucnang] ?? ['trangthai' => 0, 'tencn' => $machucnang . '()'];
    // if($machucnang == 'quantrihethong'){
        // dd($chk);
    // }
    return $chk[$tentruong];
}


function getParamsByNametype($paramtype)
{
  $cats = array();
  $type = DB::table('paramtype')->where('name', $paramtype)->get()->first();
  if ($type) {
    $cats = DB::table('param')->where('type', $type->id)->get();
  }
  return $cats;
}