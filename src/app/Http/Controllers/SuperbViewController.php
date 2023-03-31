<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SuperbViewReview;
use App\Models\SuperbViewMaster;
use App\Models\PrefectureMaster;
use App\Services\ApiService;
use App\Services\UploadService;

class SuperbViewController extends Controller
{

    public function __construct (
        private SuperbViewReview $superb_view_reviews,
        private SuperbViewMaster $superb_view_masters,
        private PrefectureMaster $prefecture_masters,
        private ApiService $api_service,
        private UploadService $upload_service)
      {
        $this->superb_view_reviews = $superb_view_reviews;
        $this->superb_view_masters = $superb_view_masters;
        $this->prefecture_masters = $prefecture_masters;
        $this->api_service = $api_service;
        $this->upload_service = $upload_service;
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($prefecture_id)
    public function index(Request $request)
    {
        // 都道府県マスターテーブルの全レコード取得
        $prefectures = PrefectureMaster::get();
        // 絶景マスタテーブルの全レコード取得
        $superb_view_masters = SuperbViewMaster::get();
        // 検索結果取得(id)
        $request->has('search') ? $search_id = $this->superb_view_masters->searchSuperbViewMaster($request->search) : $search_id = "";

        return view('superb_views.index' ,compact('prefectures', 'superb_view_masters', 'search_id'));
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

        // Yahooの地理APIからレスポンスを取得
        $response = $this->api_service->getApiContent($request);

        // httpステータスコードが200の場合のみ続行
        if($response->getStatusCode() === 200){
            $response_body = json_decode($response->getBody(), true);

            // 入力された地名が見つからない場合はエラーを返す
            if ($response_body["ResultInfo"]["Count"] === 0) {
                $error_message = "該当する地名が見つかりませんでした";
                return to_route('superb_views.create')->with(compact('error_message'));
            }

            // レスポンスデータをsuperb_view_masterテーブルに登録
            $superb_view_masters = $this->api_service->createApiContent($response_body);

            // アップロードされた画像ファイルがあれば保存する
            $image_url = $this->upload_service->uploadImageContent($request);

            // superb_view_reviewsテーブルに入力データを登録する
            $superb_view_master_id = $superb_view_masters[0]->id;
            $superb_view_reviews = $this->superb_view_reviews->createSuperbViewReviews(
                $superb_view_master_id,
                $request->input('comment'),
                $request->input('rating'),
                $image_url
            );

            $post_message = "投稿しました";

            return to_route('superb_views.show', ['superb_view' => $superb_view_master_id])->with(compact('post_message'));

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
        $superb_view_masters = $this->superb_view_masters->getRelation($id);
        return view('superb_views.show' ,compact('superb_view_masters'));
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
