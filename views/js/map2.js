$(document).ready(function(){
          
                var options = {
                    projection: new OpenLayers.Projection("EPSG:900913"),
                    maxExtent: new OpenLayers.Bounds(-20037508, -20037508, 20037508, 20037508)
                };

                map = new OpenLayers.Map('map', options);
                map.addControl(new OpenLayers.Control.LayerSwitcher());
  
                var gphy = new OpenLayers.Layer.Google(
                            "Google Physical",
                            {
                                type: google.maps.MapTypeId.TERRAIN,
                                sphericalMercator: 'true'
                            }
                        );
                map.addLayer(gphy);
                
                var styleMap = new OpenLayers.StyleMap({
                    pointRadius: 10,
                    fillColor: "#ff0000"
                });
          
                var arrets = new OpenLayers.Layer.Vector("Arrêts de bus", {
                                styleMap:styleMap,
                                protocol: new OpenLayers.Protocol.HTTP({
                                    url: "../getArrets",
                                    format: new OpenLayers.Format.GeoJSON()
                                }),
                                strategies: [new OpenLayers.Strategy.Fixed()],
                                projection: new OpenLayers.Projection("EPSG:21781")
                            });
                map.addLayer(arrets);

                map.setCenter(new OpenLayers.LonLat(738600,5840171),5); // vers l'Europe
            });
