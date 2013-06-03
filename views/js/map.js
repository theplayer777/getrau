var arrets, refresh, filter_arrets_nom;
$(document).ready(function() {

    map = new OpenLayers.Map('map');
    
    OpenLayers.ProxyHost = "proxy.php?url=";

    var carte = new OpenLayers.Layer.WMTS({
        name: "Swisstopo PK",
        url: ["http://wmts0.geo.admin.ch/", "http://wmts1.geo.admin.ch/", "http://wmts.geo.admin.ch/"],
        layer: "ch.swisstopo.pixelkarte-farbe",
        requestEncoding: "REST",
        formatSuffix: "jpeg",
        matrixSet: "21781",
        format: "image/jpeg",
        serverResolutions: [4000, 3750, 3500, 3250, 3000, 2750, 2500, 2250, 2000, 1750, 1500, 1250, 1000, 750, 650, 500, 250, 100, 50, 20, 10, 5, 2.5, 2, 1.5, 1, 0.5],
        style: "default",
        maxExtent: new OpenLayers.Bounds(420000, 30000, 900000, 350000),
        isBaseLayer: true,
        opacity: 1.0,
        dimensions: ['TIME'],
        params: {'time': 20130213}
    });

    var styleMap = new OpenLayers.Style({
        pointRadius: 10,
        fillColor: "#ff0000"
    });
    refresh = new OpenLayers.Strategy.Refresh({force: true, active: true});

    filter_arrets_nom = new OpenLayers.Filter.Comparison({
        type: OpenLayers.Filter.Comparison.LIKE,
        property: "name",
        value: ""
    });

    filter_arrets_id = new OpenLayers.Filter.Comparison({
        type: OpenLayers.Filter.Comparison.LIKE,
        property: "localite",
        value: ""
    });

    var c_filter = new OpenLayers.Filter.Logical({
        type: OpenLayers.Filter.Logical.OR,
    });

    c_filter.filters.push(filter_arrets_nom);
    c_filter.filters.push(filter_arrets_id);

    rule_arrets = new OpenLayers.Rule({
        filter: c_filter
    });

    styleMap.addRules([rule_arrets]);

    arrets = new OpenLayers.Layer.Vector("Arrêts de bus", {
     styleMap: styleMap,
     strategies: [new OpenLayers.Strategy.Fixed(), refresh],
     protocol: new OpenLayers.Protocol.HTTP({
     url: "../getArrets",
     params: {
     'filter': $("#filter").val()
     },
     format: new OpenLayers.Format.GeoJSON()
     }),
     projection: new OpenLayers.Projection("EPSG:4326")
     });

    /*var wms = new OpenLayers.Layer.WMS(
            "Arrets de bus",
            "http://localhost:8880/geoserver/cite/wms",
            {
                layers: 'cite:arretstransport_input', // la liste des couches à assembler dans une image cartographique
                format: 'image/png',
                transparent: 'true',
                filter: filter_arrets_nom
            }, {
        displayOutsideMaxExtent: true,
    });*/

    /*capitals = new OpenLayers.Layer.Vector("Arrets de bus", {
        protocol: new OpenLayers.Protocol.WFS({
            url: "http://localhost:8880/geoserver/cite/wf",
            featureType: "arretstransport_input",
            featurePrefix: "cite",
            featureNS: "http://jira.codehaus.org/secure/BrowseProject.jspa?id=10311",
            defaultFilter: c_filter
        }),
        strategies: [new OpenLayers.Strategy.BBOX()]
    });*/

    map.addLayers([carte, arrets]);
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.setCenter(new OpenLayers.LonLat(520000, 148000), 8);

    $("#filter").keyup(function() {
        //arrets.protocol.params.filter = $("#filter").val();
        filter_arrets_nom.value = $("#filter").val();
        filter_arrets_id.value = $("#filter").val();
        refresh.refresh();
    });

});