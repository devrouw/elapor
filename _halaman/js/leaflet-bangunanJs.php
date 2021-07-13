<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

   <script type="text/javascript">
    var latInput = document.querySelector("[name=lat]");
    var lngInput = document.querySelector("[name=lng]");
    var marker;
   	var map = L.map('mapid').setView([-1.224724, 116.870586], 17);

   	var LayerKita=L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
		attribution: '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
		tileSize: 512,
		maxZoom: 18,
		zoomOffset: -1,
		id: 'mapbox/streets-v11',
		accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
		});

	map.addLayer(LayerKita);

    map.on("click",function(e){
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if(!marker){
            marker = L.marker(e.latlng).addTo(map);
        }else{
            marker.setLatLng(e.latlng);
        }

        latInput.value = lat;
        lngInput.value = lng;
    })

   </script>