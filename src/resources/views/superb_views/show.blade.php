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

<p>{{ $superb_view_reviews->id }}</p>

@endsection