@extends('layouts.app')

@push('scripts')
      <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '絶景詳細')

@section('content')

<!-- 投稿完了メッセージ -->
@if(session('post_message'))
  <p class="post_message">{{ session('post_message') }}</p>
@endif
<!-- 削除完了メッセージ -->
@if(session('delete_message'))
  <p class="delete_message">{{ session('delete_message') }}</p>
@endif

<div class="container">
      <div class="row row_style">
            <div class="col">
                  <h2 style="font-weight: bold;">{{ $superb_view_masters[0]->name }}</h2>
            </div>
            <div class="col">
                        <div class="star-ratings-css">
                              <div class="star-ratings-css-top" style="width: {{ $superb_view_masters[0]->superbViewReviews->avg('rating')*25 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                              <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        </div>
            </div>
      </div>
      <div class="row row_style">
            <div class="col-3"><h3 style="line-height: 63.02px">所在地</h3></div>
            <div class="col-9"><p style="line-height: 63.02px">{{ $superb_view_masters[0]->address }}</p></div>
      </div>
      @foreach($superb_view_masters[0]->superbViewReviews->reverse() as $superbViewReview)
      <div class="row post_block_parent">
            <div class="col post_block_child">
                  <div>
                        <p>{{ $superbViewReview->user->name }} さんの口コミ</p>
                  </div>
                  <div class="star-ratings-css">
                        <div class="star-ratings-css-top" style="width: {{ ($superbViewReview->rating)*25 }}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                  </div>
                  <div style="margin-top: 2rem" >
                        <p>{{ $superbViewReview->comment }}</p>
                  </div>
            </div>
            <div class="col post_block_child">
                  @if($superbViewReview->image_url)
                        <img src="{{ $superbViewReview->image_url }}" class="post_image">
                  @endif
            </div>
            @auth
            @if(Auth::user()->id === $superbViewReview->user_id)
                  <form action="{{ route('superb_views.destroy', [$superbViewReview->id, $superb_view_masters[0]->id] ) }}" method="post" style="text-align: center; margin-top: 1rem;">
                  @csrf
                  @method('delete')
                  <input type="submit" name="delete" class="common_btn" value="口コミを削除" onClick="delete_alert(event);return false;">
            @endif
            @endauth
      </form>
      </div>
      @endforeach
      <div style="margin-top: 5rem;">&emsp;</div>
</div>

@endsection