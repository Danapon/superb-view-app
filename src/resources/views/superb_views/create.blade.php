@extends('layouts.app')

@push('scripts')
      <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '絶景投稿')

@section('content')

<h2 class="mt-3">絶景スポットを投稿する</h2>

<!-- エラーメッセージ (バリデーション)-->
@foreach ($errors->all() as $error)
      <p class="validation">{{ $error }}</p>
@endforeach
<!-- エラーメッセージ (入力した地名が見つからない場合)-->
@if(session('error_message'))
  <p class="error_message">{{ session('error_message') }}</p>
@endif

<div class="row">
      <div class="col-md">
            <form  method="POST" action="{{ route('superb_views.store') }}" enctype="multipart/form-data">
            @csrf
                  <div class="form-group mb-3">
                        <label class="form-label">地名：</label>
                        <input name="name" type="text" class="form-control">
                  </div>
                  <div class="form-group mb-3">
                        <label class="form-label">口コミ：</label>
                        <textarea name="comment" class="form-control" rows="3"></textarea>
                  </div>
                  <div class="form-group mb-3">
                        <label class="form-label">評価：</label>
                        <select name="rating" class="form-control review-score-color">
                             <option value="5" class="review-score-color">★★★★★</option>
                             <option value="4" class="review-score-color">★★★★</option>
                             <option value="3" class="review-score-color">★★★</option>
                             <option value="2" class="review-score-color">★★</option>
                             <option value="1" class="review-score-color">★</option>
                         </select>
                  </div>
                  <div class="form-group mb-3">
                        <label class="form-label">画像：</label>
                        <input name="image_url" class="form-control" type="file" id="formFile">
                  </div>
                  <button type="submit" class="btn btn-secondary">投稿する</button>
            </form>
      </div>
</div>



@endsection