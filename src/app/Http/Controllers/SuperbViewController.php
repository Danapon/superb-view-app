<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SuperbViewReview;
use App\Models\SuperbViewMaster;
use App\Models\PrefectureMaster;
// API呼び出しのため
use GuzzleHttp\Client;

class SuperbViewController extends Controller
{

    public function __construct (
        private SuperbViewReview $superb_view_reviews,
        private SuperbViewMaster $superb_view_masters,
        private PrefectureMaster $prefecture_masters)
      {
        $this->superb_view_reviews = $superb_view_reviews;
        $this->superb_view_masters = $superb_view_masters;
        $this->prefecture_masters = $prefecture_masters;
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 都道府県マスターテーブルの全レコード取得
        $prefectures = PrefectureMaster::get();

        return view('superb_views.index' ,compact('prefectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superb_views.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'rating' => 'required',
        ]);

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
        // httpステータスコードが200の場合のみ続行
        if($response->getStatusCode() === 200){
            $response_body = json_decode($response->getBody(), true);

            // 入力された地名が見つからない場合はエラーを返す
            if ($response_body["ResultInfo"]["Count"] === 0) {
                $error_message = "該当する地名が見つかりませんでした";
                return to_route('superb_views.create')->with(compact('error_message'));
            }

            // レスポンスデータを変数に格納
            // 地名(name)
            $response_name = $response_body["Feature"][0]["Name"];
            // 住所(address)
            $response_address = $response_body["Feature"][0]["Property"]["Address"];
            // 位置情報
            $geometry = explode(",", $response_body["Feature"][0]["Geometry"]["Coordinates"]);
            // 緯度(lat)
            $lat = $geometry[1];
            // 経度(lng)
            $lng = $geometry[0];
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
            // アップロードされた画像ファイルがあれば保存する
            $image_url = "";
            if ($request->file('image_url')) {
                // ディレクトリ名
                $dir = 'review_images';
                // アップロードされたファイル名を取得
                $file_name = $request->file('image_url')->getClientOriginalName();
                // 取得したファイル名で保存
                $request->file('image_url')->storeAs('public/' . $dir, $file_name);
                // 画像のパスを取得
                $image_url = 'public/' . $dir . '/' . $file_name;
            }
            // superb_view_reviewsテーブルに入力データを登録する
            $superb_view_master_id = $superb_view_masters[0]->id;
            $superb_view_reviews = $this->superb_view_reviews->createSuperbViewReviews(
                $superb_view_master_id,
                $request->input('comment'),
                $request->input('rating'),
                $image_url
            );

            $post_message = "投稿しました";

            // return to_route('superb_views.show')->with(compact('post_message'));
            return to_route('superb_views.show', ['superb_view' => $superb_view_master_id])->with(compact('post_message'));
            // return view('superb_views.show',compact('superb_view_master'));

        }else{
            throw new \Exception('ERROR response:'.$response->getStatusCode());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $superb_view_reviews = SuperbViewReview::where('superb_view_master_id', $id)->orderByDesc('id')->get();
        return view('superb_views.show' ,compact('superb_view_reviews'));
    }

    // 以下はMVP範囲外なので時間があれば作成する

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
