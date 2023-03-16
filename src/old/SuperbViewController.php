<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperbViewController extends Controller
{
    // 一覧ページ
    public function index() {        
        return view('superb.index');
    }
}
