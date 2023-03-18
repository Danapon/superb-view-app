@extends('layouts.app')

@push('scripts')
      <script src="{{ asset('/js/script.js') }}"></script>
@endpush

@section('title', '絶景マップ')

@section('content')

<style>
body { margin: 0; padding: 0; }
#map { position: relative; top: 0; bottom: 0; width: 500px; height: 300px; }
</style>

<main>
 <div id="map"></div>
 <script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiYXBvbGlhMzA2IiwiYSI6ImNsZmFmam80MjB2Zjkzem13NGJjMTFoNWoifQ.vzZfpoQYaY1cfOHW-y7exw';
      const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [139.767125, 35.681236],
            zoom: 11.15
      });
      map.on('load', function() {
            // map.setLayoutProperty('country-label', 'text-field', [
            //       'get',
            //       `name_jp`
            // ]);
            // create the popup
            const popup = new mapboxgl.Popup({ offset: 25 }).setText(
            'スカイツリーです'
            );
            const marker = new mapboxgl.Marker({
            })
            .setLngLat([139.810810, 35.710006])
            .setPopup(popup) // sets a popup on this marker
            .addTo(map);
      })
</script>
</main>

@endsection