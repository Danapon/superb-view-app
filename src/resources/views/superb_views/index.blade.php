@extends('layouts.app')

@push('scripts')
      <script>
        const mapboxKey = @json(config('key.mapbox-value'));
        const superbViewMasters = @json($superb_view_masters);
        @if ($search_id)
            const searchResultLng = @json($superb_view_masters->where('id', $search_id)->first()->lng);
            const searchResultLat = @json($superb_view_masters->where('id', $search_id)->first()->lat);
        @endif
      </script>
      <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '絶景マップ')

@section('content')
<div class="container container-fluid">
      <div class="row">
            <!-- 都道府県から探す -->
            <div class="col-md-3 col12 d-none d-md-block">
                  <p class="prefecture_title d-none d-md-block">都道府県から探す</p>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">北海道・東北地方</p>
                        @for ($i = 0; $i < PrefectureConst::HOKKAIDO_TOHOKU; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">関東地方</p>
                        @for ($i = PrefectureConst::HOKKAIDO_TOHOKU; $i < PrefectureConst::KANTO; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">中部地方</p>
                        @for ($i = PrefectureConst::KANTO; $i < PrefectureConst::CHUBU; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">関西地方</p>
                        @for ($i = PrefectureConst::CHUBU; $i < PrefectureConst::KANSAI; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">中国・四国地方</p>
                        @for ($i = PrefectureConst::KANSAI; $i < PrefectureConst::CHUGOKU_SIKOKU; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
                  <div class="col region_block d-none d-md-block">
                        <p class="region">九州・沖縄地方</p>
                        @for ($i = PrefectureConst::CHUGOKU_SIKOKU; $i < PrefectureConst::KYUSYU_OKINAWA; $i++)
                        <a href="#" class="prefecture" data-pref-code="{{ $prefectures[$i]->id }}">{{ $prefectures[$i]->name }}</a>
                        @endfor
                  </div>
            </div>
            <!-- MAP -->
            <div class="col-md-9 col-12 map_display">
                  <div id="map"></div>
            </div>
      </div>
</div>
@endsection