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
}
