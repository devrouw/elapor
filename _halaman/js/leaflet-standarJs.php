<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

   <script type="text/javascript">

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

	var myStyle2 = {
	    "color": "#ffff00",
	    "weight": 1,
	    "opacity": 0.9
	};

	function popUp(f,l){
	    var out = [];
	    if (f.properties){
	        // for(key in f.properties){
	        // 	console.log(key);

	        // }
			// out.push("Provinsi: "+f.properties['PROVINSI']);
			// out.push("Kecamatan: "+f.properties['KECAMATAN']);
			out.push("Contoh: Ini Pop Up manual");
	        l.bindPopup(out.join("<br />"));
	    }
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
	}

	// function featureToMarker(feature, latlng) {
	// 	return L.marker(latlng, {
	// 		icon: L.divIcon({
	// 			className: 'marker-'+feature.properties.amenity,
	// 			html: iconByName(feature.properties.amenity),
	// 			iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
	// 			iconSize: [25, 41],
	// 			iconAnchor: [12, 41],
	// 			popupAnchor: [1, -34],
	// 			shadowSize: [41, 41]
	// 		})
	// 	});
	// }

	var baseLayers = [
		{
			name: "OpenStreetMap",
			layer: LayerKita
		},
		{	
			name: "OpenCycleMap",
			layer: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')
		},
		{
			name: "Outdoors",
			layer: L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
		}
	];

	<?php
    $getKelurahan=$db->ObjectBuilder()->get('tb_kelurahan');
		foreach ($getKelurahan as $row) {
			?>

			var myStyle<?=$row->id_kelurahan?> = {
			    "color": "<?=$row->warna_maps?>",
			    "weight": 1,
			    "opacity": 1
			};

			<?php
			$arrayKec[]='{
			name: "'.$row->nm_kelurahan.'",
			icon: iconByName("'.$row->warna_maps.'"),
			layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_kelurahan.'"],{onEachFeature:popUp,style: myStyle'.$row->id_kelurahan.' }).addTo(map)
			}';
		}
	?>

	var overLayers = [{
		group: "Layer Kecamatan",
		layers: [
			<?=implode(',', $arrayKec);?>
		]
	}
	];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});

	map.addControl(panelLayers);

	<?php
	$db->join('tb_warga b','a.id_warga=b.id_warga','LEFT');
	$get = $db->ObjectBuilder()->get('tb_bangunan a');
	foreach($get as $row){
		$popupContent = "<div>Jenis Bangunan: ".$row->jenis_bangunan."</div><div>Alamat: ".$row->alamat."No. ".$row->nomor_rumah."</div><div>Pemilik: ".$row->nama_lengkap."</div>";
		?>
		L.marker([<?=$row->lat?>,<?=$row->lng?>]).addTo(map).bindPopup("<img src=<?=assets('unggah/bangunan/'.$row->foto_bangunan)?> style=width:50px;height:50px;><div>Jenis Bangunan: <?=$row->jenis_bangunan?></div><div>Alamat: <?=$row->alamat?> No. <?=$row->nomor_rumah?></div><div>Pemilik: <?=$row->nama_lengkap?></div>");
		<?php
	}
	?>

   </script>