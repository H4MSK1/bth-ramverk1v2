<?php

namespace H4MSK1\Map;

class OpenLayers extends AbstractMap
{
    public function getHtml($lat, $lng)
    {
        $html = <<<EOT
        <div id="map" style="height:400px;width:100%;"></div>
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
        <script>
          var map = new OpenLayers.Map("map");
          map.addLayer(new OpenLayers.Layer.OSM());
          var lonLat = new OpenLayers.LonLat($lng, $lat)
                .transform(
                  new OpenLayers.Projection("EPSG:4326"),
                  map.getProjectionObject()
                );
          var markers = new OpenLayers.Layer.Markers("Markers");
          map.addLayer(markers);
          markers.addMarker(new OpenLayers.Marker(lonLat));
          map.setCenter(lonLat, 14);
        </script>
EOT;
        return $html;
    }
}
