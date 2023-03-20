<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperbViewMaster;

class SuperbViewReview extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function superbViewMaster() {
        return $this->belongsTo(SuperbViewMaster::class);
    }

    public function createSuperbViewReviews(
        int $superb_view_master_id,
        string $comment = null,
        int $rating,
        string $image_url = null) {
        // superb_view_mastersテーブルのidをsuperb_view_reviewsのsuperb_view_master_idに入れる
        $this->superb_view_master_id = $superb_view_master_id;
        $this->user_id = Auth::id();
        $this->comment = empty($comment) ? '' : $comment;
        $this->rating = $rating;
        $this->image_url = empty($image_url) ? '' : $image_url;
        $this->save();
        return self::where('superb_view_master_id', $superb_view_master_id)->get();
    }

}
