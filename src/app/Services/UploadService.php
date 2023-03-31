<?php
declare(strict_types=1);

namespace App\Services;

class UploadService
{

  public function uploadImageContent($request)
  {
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
        $image_url = 'storage/' . $dir . '/' . $file_name;
    }

    return $image_url;

  }

}