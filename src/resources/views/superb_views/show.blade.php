@extends('layouts.app')

@section('title', '絶景詳細')

@section('content')

<!-- 投稿完了メッセージ -->
@if(session('post_message'))
  <p class="post_message">{{ session('post_message') }}</p>
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
                  <img src="{{ asset($superbViewReview->image_url) }}" class="post_image">
            </div>
      </div> 
      @endforeach
      <div style="margin-top: 5rem;">&emsp;</div>
</div>

@endsection