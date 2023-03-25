// mapboxで地図を表示
const prefData = {
      "1":{"lng": 141.3428,"lat":43.0687,"zoom":5.5},
      "2":{"lng": 140.71,"lat":40.8222,"zoom":7.3},
      "3":{"lng": 141.1522,"lat":39.7019,"zoom":7.1},
      "4":{"lng": 140.8719,"lat":38.2688,"zoom":7.1},
      "5":{"lng": 140.1025,"lat":39.7186,"zoom":7.1},
      "6":{"lng": 140.3633,"lat":38.2406,"zoom":7},
      "7":{"lng": 140.4681,"lat":37.7503,"zoom":7},
      "8":{"lng": 140.4644,"lat":36.3658,"zoom":7},
      "9":{"lng": 139.8836,"lat":36.5553,"zoom":7},
      "10":{"lng": 139.0656,"lat":36.3912,"zoom":7.5},
      "11":{"lng": 139.6489,"lat":35.8617,"zoom":8},
      "12":{"lng": 140.1233,"lat":35.6047,"zoom":8.2},
      "13":{"lng": 139.7667,"lat":35.6814,"zoom":8.2},
      "14":{"lng": 139.6225,"lat":35.4478,"zoom":8.4},
      "15":{"lng": 139.0236,"lat":37.9022,"zoom":7.3},
      "16":{"lng": 137.2117,"lat":36.6953,"zoom":8.5},
      "17":{"lng": 136.6567,"lat":36.5611,"zoom":7.3},
      "18":{"lng": 136.2219,"lat":36.0652,"zoom":8.1},
      "19":{"lng": 138.5683,"lat":35.6639,"zoom":8.1},
      "20":{"lng": 138.1811,"lat":36.6514,"zoom":7.5},
      "21":{"lng": 136.7222,"lat":35.3911,"zoom":8.1},
      "22":{"lng": 138.3889,"lat":34.9769,"zoom":8.1},
      "23":{"lng": 136.9067,"lat":35.1814,"zoom":8.1},
      "24":{"lng": 136.5156,"lat":34.7186,"zoom":8.1},
      "25":{"lng": 135.8631,"lat":35.0044,"zoom":8.5},
      "26":{"lng": 135.7556,"lat":35.0213,"zoom":8.5},
      "27":{"lng": 135.5022,"lat":34.6939,"zoom":8.5},
      "28":{"lng": 135.1956,"lat":34.6906,"zoom":8.5},
      "29":{"lng": 135.8328,"lat":34.6851,"zoom":8.8},
      "30":{"lng": 135.1675,"lat":34.2261,"zoom":8.5},
      "31":{"lng": 134.2383,"lat":35.5036,"zoom":8.5},
      "32":{"lng": 133.0483,"lat":35.4681,"zoom":8.2},
      "33":{"lng": 133.9175,"lat":34.6617,"zoom":8.2},
      "34":{"lng": 132.4594,"lat":34.3964,"zoom":8.2},
      "35":{"lng": 131.4714,"lat":34.1861,"zoom":8.2},
      "36":{"lng": 134.5594,"lat":34.0658,"zoom":8.2},
      "37":{"lng": 134.0433,"lat":34.3403,"zoom":8.5},
      "38":{"lng": 132.7658,"lat":33.8417,"zoom":8.3},
      "39":{"lng": 133.5311,"lat":33.5597,"zoom":8.3},
      "40":{"lng": 130.4181,"lat":33.5814,"zoom":8.3},
      "41":{"lng": 130.2989,"lat":33.2494,"zoom":8.3},
      "42":{"lng": 129.8736,"lat":32.7447,"zoom":8.3},
      "43":{"lng": 130.7417,"lat":32.8031,"zoom":8.3},
      "44":{"lng": 131.6125,"lat":33.2381,"zoom":8.3},
      "45":{"lng": 131.4239,"lat":31.9111,"zoom":8.3},
      "46":{"lng": 130.5581,"lat":31.5603,"zoom":8.3},
      "47":{"lng": 127.6811,"lat":26.2125,"zoom":7.5},
}
mapboxgl.accessToken = mapboxKey;
const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [139.767125,35.681236],//中心は東京駅を指定
      zoom: 4.9 //デフォルト表示 
});
// mapをloadした後に実行
map.on('load', function() {
      // map.setLayoutProperty('country-label', 'text-field', [
      //       'get',
      //       `name_jp`
      // ]);

      // ループ処理入れる
      superbViewMasters.forEach(function(superbViewMaster){

            // ピンのポップアップ作成
            eval("var popup" + superbViewMaster.id + " = new mapboxgl.Popup({ offset: 25 }).setHTML(" + "`<h3>" + superbViewMaster.name + "</h3><br><p>所在地：" + superbViewMaster.address + "</p><br><a href=" + "\"superb_views/" + superbViewMaster.id + "\"" + ">口コミを見る" + "</a>`" + ");");
            
            // ピンの生成
            eval("var marker" + superbViewMaster.id + " = new mapboxgl.Marker({}).setLngLat([" + superbViewMaster.lng + "," + superbViewMaster.lat + "]).setPopup(popup" + superbViewMaster.id + ").addTo(map);" );

      });

      // // ピンのポップアップ作成
      // const popup = new mapboxgl.Popup({ offset: 25 }).setText(
      // 'スカイツリーです'
      // );
      // const popup2 = new mapboxgl.Popup({ offset: 25 }).setText(
      //       '札幌駅です'
      //       );
      // // ピンの生成
      // const marker = new mapboxgl.Marker({
      // })
      // // 経度緯度を取得
      // .setLngLat([139.810810, 35.710006]) //経度,緯度
      // // ポップアップ表示
      // .setPopup(popup) // sets a popup on this marker
      // // map上に追加
      // .addTo(map);
      // // map.resize();
      // // ピンの生成2
      // const marker2 = new mapboxgl.Marker({
      // })
      // // 経度緯度を取得
      // .setLngLat([141.3428, 43.0687]) //経度,緯度
      // // ポップアップ表示
      // .setPopup(popup2) // sets a popup on this marker
      // // map上に追加
      // .addTo(map);
      // // map.resize();
})
$(function() {
      // ボタンがクリックされた場合
      $('a.prefecture').on('click', function(){
        console.log($(this).data('pref-code'));
        const pref = prefData[$(this).data('pref-code')];
        map.flyTo({
            // These options control the ending camera position: centered at
            // the target, at zoom level 9, and north up.
            center: [pref.lng, pref.lat],
            zoom: pref.zoom,
            bearing: 0,
             
            // These options control the flight curve, making it move
            // slowly and zoom out almost completely before starting
            // to pan.
            speed: 1.2, // make the flying slow
            curve: 1, // change the speed at which it zooms out
             
            // This can be any easing function: it takes a number between
            // 0 and 1 and returns another number between 0 and 1.
            easing: (t) => t,
             
            // this animation is considered essential with respect to prefers-reduced-motion
            essential: true
            });
      });
});