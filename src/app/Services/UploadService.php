<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{

  public function uploadImageContent($request)
  {
    // アップロードされた画像ファイルがあれば保存する
    $image_url = "";
    if ($request->file('image_url')) {
        // アップロードされたファイル名を取得
        $file_name = $request->file('image_url');
        // S3バケットにアップロード
        $path = Storage::disk('s3')->putFile('/review_images', $file_name, 'public');
        // アップロードした画像のパスを取得
        $image_url = Storage::disk('s3')->url($path);
    }

    return $image_url;

  }

}