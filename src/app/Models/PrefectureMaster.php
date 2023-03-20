<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrefectureMaster extends Model
{
    use HasFactory;

    public function superbViewMasters() {
        return $this->hasMany(SuperbViewMaster::class);
    }

    // 都道府県名に一致するレコードを取得
    public function getPrefectureMaster(string $prefecture_name) {
        return self::where('name', $prefecture_name)->get();
    }
}
