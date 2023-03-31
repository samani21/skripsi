<!DOCTYPE html>
<html>
<head>
    <title>Simple Leaflet Map</title>
    <meta charset="utf-8" />
    <link 
        rel="stylesheet" 
        href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"
    />
</head>
<body>

    <div id="map" style="width: 600px; height: 400px"></div>

    <script
        src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js">
    </script>

    <script>

	var planes = [
		["7C6B07",-3.354645, 114.602565],
		["7C6B38",-3.342475, 114.602743],
		["7C6CA1",-3.354576, 114.599996],
		["7C6CA2",-3.352163, 114.601587],
		["C820B6",-3.357545, 114.609556],
        ["C820B346",-3.344528, 114.599549]
		];

        var map = L.map('map').setView([-3.353574,114.5949475], 15);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
            }).addTo(map);

		for (var i = 0; i < planes.length; i++) {
			marker = new L.marker([planes[i][1],planes[i][2]])
				.bindPopup(planes[i][0])
				.addTo(map);
		}
               
    </script>
</body>
</html>