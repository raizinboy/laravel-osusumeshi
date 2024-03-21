<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //ajaxで市町村を取得
    public function getCityOptions(Request $request)
    {
        $url = "https://www.land.mlit.go.jp/webland/api/CitySearch?area=".$request->prefecture_id;
        $json = file_get_contents($url);
        $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $data = json_decode($json,true);
        return $data;
    }
}
