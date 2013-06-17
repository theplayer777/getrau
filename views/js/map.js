var arrets, refresh, filter_arrets_nom, map;
$(document).ready(function() {

    map = new OpenLayers.Map('map');

    //Creation de la carte de fond SwissTopo
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


    //Creation des différents styles pour les layers
    var styleArrets = new OpenLayers.Style({
        pointRadius: 10,
        fillColor: "#ff0000"
    });

    var styleLignes = new OpenLayers.Style({
        strokeWidth: 5,
        strokeColor: "#ff0000"
    });
    
    var styleEleves = new OpenLayers.Style({
        pointRadius: 10,
        fillColor: "#0000ff"
    });

    //Stratégies pour rafraichir automatiquement les layers lors du changement du filtre
    refreshArrets = new OpenLayers.Strategy.Refresh({force: true, active: true});
    refreshLignes = new OpenLayers.Strategy.Refresh({force: true, active: true});
    refreshEleves = new OpenLayers.Strategy.Refresh({force: true, active: true});

    //Filtre de comparaison. Le filtre est le même pour tous les layers
    filter = new OpenLayers.Filter.Comparison({
        type: OpenLayers.Filter.Comparison.LIKE,
        property: "tags",
        value: ""
    });

    //la règle associée au filtre
    rule_filter = new OpenLayers.Rule({
        filter: filter
    });

    //Ajout de la règle aux différents style des layers
    styleArrets.addRules([rule_filter]);
    styleLignes.addRules([rule_filter]);
    styleEleves.addRules([rule_filter]);


    //Création du layer des arrêts de bus
    arrets = new OpenLayers.Layer.Vector("Arrêts de bus", {
        styleMap: styleArrets,
        strategies: [new OpenLayers.Strategy.Fixed(), refreshArrets],
        protocol: new OpenLayers.Protocol.HTTP({
            url: "../getArretsGeoJSON",
            params: {
                'filter': $("#filter").val()
            },
            format: new OpenLayers.Format.GeoJSON()
        }),
        projection: new OpenLayers.Projection("EPSG:4326")
    });

    //Création du layer des lignes de bus
    lignes = new OpenLayers.Layer.Vector("Lignes de bus", {
        styleMap: styleLignes,
        strategies: [new OpenLayers.Strategy.Fixed(), refreshLignes],
        protocol: new OpenLayers.Protocol.HTTP({
            url: "../getLignesGeoJSON",
            params: {
                'filter': $("#filter").val()
            },
            format: new OpenLayers.Format.GeoJSON()
        }),
        projection: new OpenLayers.Projection("EPSG:4326")
    });
    
    //Création du layer des élèves
    eleves = new OpenLayers.Layer.Vector("Elèves", {
        styleMap: styleEleves,
        strategies: [new OpenLayers.Strategy.Fixed(), refreshEleves],
        protocol: new OpenLayers.Protocol.HTTP({
            url: "../getElevesGeoJSON",
            params: {
                'filter': $("#filter").val()
            },
            format: new OpenLayers.Format.GeoJSON()
        }),
        projection: new OpenLayers.Projection("EPSG:4326")
    });

    //Ajout des layers sur la carte
    map.addLayers([carte, arrets, lignes, eleves]);

    //Ajout du layerSwitcher
    map.addControl(new OpenLayers.Control.LayerSwitcher());

    //Recentrage de la map sur Aubonne
    map.setCenter(new OpenLayers.LonLat(520000, 148000), 8);

    //Fonction permettant la mise à jour du filtre
    $("#filter").keyup(function() {
        filter.value = $("#filter").val();
        filter.value = $("#filter").val();
        refreshArrets.refresh();
        refreshLignes.refresh();
        refreshEleves.refresh();
        console.log("hello world");
    });

    // activation du contrôle de sélection "hover" sur la couche arrets
    selectControl = new OpenLayers.Control.SelectFeature([arrets,lignes,eleves], {click: true});
    map.addControl(selectControl);
    selectControl.activate();

    arrets.events.register("featureselected", arrets, onArretSelect);
    arrets.events.register("featureunselected", arrets, onFeatureUnselect);
    lignes.events.register("featureselected", lignes, onLigneSelect);
    lignes.events.register("featureunselected", lignes, onFeatureUnselect);
    eleves.events.register("featureselected", eleves, onEleveSelect);
    eleves.events.register("featureunselected", eleves, onFeatureUnselect);


});

function onPopupClose(evt) {
    selectControl.unselect(this.feature);
}

function onArretSelect(evt) {
    feature = evt.feature;
    popup = new OpenLayers.Popup.FramedCloud("featurePopup",
            feature.geometry.getBounds().getCenterLonLat(),
            new OpenLayers.Size(100, 100),
            "<h2>" + feature.attributes.name + "</h2>" +
            "<b>Localité:</b> " +
            feature.attributes.localite,
            null,
            true,
            onPopupClose
            );
    feature.popup = popup;
    popup.feature = feature;
    map.addPopup(popup);
}

function onLigneSelect(evt) {
    feature = evt.feature;
    popup = new OpenLayers.Popup.FramedCloud("featurePopup",
            feature.geometry.getBounds().getCenterLonLat(),
            new OpenLayers.Size(100, 100),
            "<h2>" + feature.attributes.region + "</h2>",
            null,
            true,
            onPopupClose
            );
    feature.popup = popup;
    popup.feature = feature;
    map.addPopup(popup);
}

function onEleveSelect(evt) {
    feature = evt.feature;
    popup = new OpenLayers.Popup.FramedCloud("featurePopup",
            feature.geometry.getBounds().getCenterLonLat(),
            new OpenLayers.Size(100, 100),
            "<h2>"+ feature.attributes.prenom + " " + feature.attributes.name + " " + feature.attributes.tags + "</h2>",
            null,
            true,
            onPopupClose
            );
    feature.popup = popup;
    popup.feature = feature;
    map.addPopup(popup);
}

function onFeatureUnselect(evt) {
    feature = evt.feature;
    if (feature.popup) {
        popup.feature = null;
        map.removePopup(feature.popup);
        feature.popup.destroy();
        feature.popup = null;
    }
}

$(window).load(function () {
        filter.value = $("#filter").val();
        filter.value = $("#filter").val();
        refreshArrets.refresh();
        refreshLignes.refresh();
        refreshEleves.refresh();
        var params = getQueryParams(document.location.search);
        console.log(params.x);
        map.setCenter(new OpenLayers.LonLat(params.x, params.y), 8);
});

function getQueryParams(qs) {
    qs = qs.split("+").join(" ");

    var params = {}, tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }

    return params;
}