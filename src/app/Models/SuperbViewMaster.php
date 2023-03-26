<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperbViewMaster extends Model
{
    use HasFactory;

    public function superbViewReviews() {
        return $this->hasMany(SuperbViewReview::class);
    }

    public function prefectureMaster() {
        return $this->belongsTo(PrefectureMaster::class);
    }

    /* テーブルに既に地名のレコードが存在するか確認する */
    public function checkSuperbViewMaster(string $response_name) {
        $get_name = self::where('name', $response_name)->first();
        return empty($get_name) ? false : true;
    }

    /* レスポンスデータをテーブルに登録 */
    public function createSuperbViewMaster(
        bool $check_name_exist,
        int $prefecture_id,
        string $response_name,
        string $response_address,
        float $lat,
        float $lng) {
        if ($check_name_exist) {
            return self::where('name', $response_name)->get();
        }
        else {
            $this->prefecture_master_id = $prefecture_id;
            $this->name = $response_name;
            $this->address = $response_address;
            $this->lat = $lat;
            $this->lng = $lng;
            $this->save();
            return self::where('name', $response_name)->get();
        }
    }

    /* リレーション取得 */
    public function getRelation($superb_view_master_id) {
        // superb_view_mastersテーブルからリレーション設定されたテーブルを全て取得
        return $this->where('id', $superb_view_master_id)->with('superbViewReviews.user')->get();
    }

     /* 検索結果取得(id) */
     public function searchSuperbViewMaster(string $search_word) {
        $get_result = self::where('name', "LIKE", "%$search_word%")->first();//部分一致で検索
        return empty($get_result) ? '' : $get_result->id;
    }    

}
