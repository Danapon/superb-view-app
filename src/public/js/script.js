// mapboxで地図を表示
mapboxgl.accessToken = 'pk.eyJ1IjoiYXBvbGlhMzA2IiwiYSI6ImNsZmFmam80MjB2Zjkzem13NGJjMTFoNWoifQ.vzZfpoQYaY1cfOHW-y7exw';
const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [139.767125, 35.681236],//中心は東京駅を指定
      // center: [127.6811	,	26.2125],//中心は東京駅を指定
      zoom: 4.9 //デフォルト表示
      // zoom: 7.5   
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
      const popup2 = new mapboxgl.Popup({ offset: 25 }).setText(
            '札幌駅です'
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
      // ピンの生成2
      const marker2 = new mapboxgl.Marker({
      })
      // 経度緯度を取得
      .setLngLat([141.3428, 43.0687]) //経度,緯度
      // ポップアップ表示
      .setPopup(popup2) // sets a popup on this marker
      // map上に追加
      .addTo(map);
      // map.resize();
})