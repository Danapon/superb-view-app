<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SuperbViewMaster;
use App\Models\PrefectureMaster;
use GuzzleHttp\Client;

class ApiService
{

  public function __construct (
    private SuperbViewMaster $superb_view_masters,
    private PrefectureMaster $prefecture_masters)
  {
    $this->superb_view_masters = $superb_view_masters;
    $this->prefecture_masters = $prefecture_masters;
  }

  public function getApiContent($request)
  {
      // Yahooの地理APIに投稿した地名(name)が存在するか検索をかける
      $name = $request->name;//検索する地名
      $client = new Client();
      $response = $client->request(
          "GET",
          "https://map.yahooapis.jp/geocode/cont/V1/contentsGeoCoder?appid=dj00aiZpPXdtOUt6VVl2TDY2VCZzPWNvbnN1bWVyc2VjcmV0Jng9NzE-&query=${name}&category=landmark&results=10&output=json",
          [   'headers' => [
              'Accept'     => 'application/json',
              'Authorization'      => 'Bearer '.config('app.bcart_key'),
              ],
              'http_errors' => false //エラーも通す指定
          ],
      );

      return $response;

  }

  public function createApiContent($response_body)
  {

    // レスポンスデータを変数に格納
    // 地名(name)
    $response_name = $response_body["Feature"][0]["Name"];
    // 住所(address)
    $response_address = $response_body["Feature"][0]["Property"]["Address"];
    // 位置情報
    $geometry = explode(",", $response_body["Feature"][0]["Geometry"]["Coordinates"]);
    // 緯度(lat)
    $lat = (float)$geometry[1];
    // 経度(lng)
    $lng = (float)$geometry[0];
    // 都道府県名
    $prefecture_name = $response_body["Feature"][0]["Property"]["AddressElement"][0]["Name"];

    // $superb_view_masterにレスポンスデータを登録する
    // 都道府県テーブルを取得
    $prefecture = $this->prefecture_masters->getPrefectureMaster($prefecture_name);
    // 地名に該当するレコードが存在するか判定
    $check_name_exist = $this->superb_view_masters->checkSuperbViewMaster($response_name);
    // レスポンスデータをテーブルに登録してidを取得する
    $superb_view_masters = $this->superb_view_masters->createSuperbViewMaster(
        $check_name_exist,
        $prefecture[0]->id,
        $response_name,
        $response_address,
        $lat,
        $lng);
    
    return $superb_view_masters;

  }


}