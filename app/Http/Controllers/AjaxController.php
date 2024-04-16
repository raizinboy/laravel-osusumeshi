<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //ajaxで市町村を取得
    public function getCityOptions(Request $request)
    {

        /*
        $context = stream_context_create(array(
            'http'=>array(
                'header'=>"Ocp-Apim-Subscription-Key:b926065402d94d948d5d68a8e6df4bef",
            )
        ));
        $url = "https://www.reinfolib.mlit.go.jp/ex-api/external/XIT002?area=".$request->prefecture_id;
        $json = file_get_contents($url, false ,$context);
        $json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $data = json_decode($json,true);
        return $data;
        */
        $get_curl = curl_init();

        $get_http_url = "https://www.reinfolib.mlit.go.jp/ex-api/external/XIT002?area=".$request->prefecture_id;

        // 1. HTTP通信のRequest-設定情報をSetする
        curl_setopt($get_curl, CURLOPT_URL, $get_http_url); // url-setting
        curl_setopt($get_curl, CURLOPT_HTTPHEADER, array("Content-type: application/json",'Ocp-Apim-Subscription-Key:b926065402d94d948d5d68a8e6df4bef')); // HTTP-HeaderをSetting
        curl_setopt($get_curl, CURLOPT_SSL_VERIFYPEER, false); // サーバ証明書の検証は行わない。
        curl_setopt($get_curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($get_curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

        // 2. curl(HTTP通信)を実行する => レスポンスを変数に入れる
        $get_data = curl_exec($get_curl);
        $data = gzdecode($get_data);

        // 3. curlの処理を終了 => コネクションを切断
        curl_close($get_curl);

        // 4. レスポンスを出力する
       return $data;
    }
}
