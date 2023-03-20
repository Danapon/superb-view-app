// mapboxで地図を表示
mapboxgl.accessToken = 'pk.eyJ1IjoiYXBvbGlhMzA2IiwiYSI6ImNsZmFmam80MjB2Zjkzem13NGJjMTFoNWoifQ.vzZfpoQYaY1cfOHW-y7exw';
const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [139.767125, 35.681236],//中心は東京駅を指定
      zoom: 11.15
});
// mapをloadした後に実行
map.on('load', function() {
      // map.setLayoutProperty('country-label', 'text-field', [
      //       'get',
      //       `name_jp`
      // ]);
      // ピンのポップアップ作成
      const popup = new mapboxgl.Popup({ offset: 25 }).setText(
      'スカイツリーです'
      );
      // ピンの生成
      const marker = new mapboxgl.Marker({
      })
      // 経度緯度を取得
      .setLngLat([139.810810, 35.710006]) //経度,緯度
      // ポップアップ表示
      .setPopup(popup) // sets a popup on this marker
      // map上に追加
      .addTo(map);
      // map.resize();
})