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
}
