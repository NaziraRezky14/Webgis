@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <button class="btn btn-dark leaflet-control-measure">Sembunyikan Peta Bahaya Banjir</button>
            <div class="row">

                <div class="col-lg-11">
                    <div id="map"></div>
                </div>
                <div class="col-lg-1">
                    <label for="opacity">Opacity</label>
                    <div class="d-flex h-100">
                        <input id="opacity" type="range" class="form-control h-50" min="0" max="1"
                            value="1" step="0.1" list="tickmarks">
                        <datalist id="tickmarks" class=" h-50">
                            <option value="1" label="1"></option>
                            <option value="0.9" label="0.9"></option>
                            <option value="0.8" label="0.8"></option>
                            <option value="0.7" label="0.7"></option>
                            <option value="0.6" label="0.6"></option>
                            <option value="0.5" label="0.5"></option>
                            <option value="0.4" label="0.4"></option>
                            <option value="0.3" label="0.3"></option>
                            <option value="0.2" label="0.2"></option>
                            <option value="0.1" label="0.1"></option>
                            <option value="0" label="0"></option>
                        </datalist>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <style>
        datalist {
            display: grid;
            justify-content: space-between;
            color: red;
        }



        input[type="range"] {
            -webkit-appearance: slider-vertical;
        }

        #map {
            min-height: 500px;
        }

        .leaflet-control-attribution {
            display: none !important
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .leaflet-marker-pane {
            z-index: 900 !important;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            text-align: left;
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        .search-input {
            color: black
        }
        .leaflet-control{
            max-height: 14rem;
            overflow-y: auto
        }
        .leaflet-popup-pane{
            z-index: 700;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-To-Print-Any-Part-Of-Your-Page-Print/jQuery.print.js">
    </script>
    <!-- Leaflet JavaScript -->
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"
        integrity="sha512-Abr21JO2YqcJ03XGZRPuZSWKBhJpUAR6+2wH5zBeO4wAw4oksr8PRdF+BKIRsxvCdq+Mv4670rZ+dLnIyabbGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.css" />
    <script src="https://unpkg.com/leaflet-search@2.3.7/dist/leaflet-search.src.js"></script>
    <script type="text/javascript">
        var s = [4.9786, 97.2221];
        var color = {!! json_encode($color) !!};
        var data = {!! json_encode($data) !!}
        var tematik = {!! json_encode($tematik) !!}
        var test = {!! json_encode($test) !!}
        var tahun = {!! json_encode($tahun) !!}
        var id = {!! json_encode($id) !!}
        var map = L.map('map').setView(
            s, 10
        );


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function style(feature) {
            return {
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 1.0,
                fillColor: color[feature.properties.NAMOBJ]
            };
        }
        var geojson;

        function updatePopup(evt) {

            var propertyValue;
            var feature = evt.target.feature;
            var props = feature.properties;
            evt.target.setStyle({
                fillColor: color[props.NAMOBJ]
            });
            evt.popup.setContent('');
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            if (feature.properties) {
                layer.bindPopup(

                    tahun[id[feature.properties.NAMOBJ]] ? '<b>Kejadian banjir terakhir</b> <br/>' + tahun[id[feature
                        .properties.NAMOBJ]][0] : 'Tidak ada data', {
                        maxHeight: 200
                    }), layer.bindTooltip(feature.properties.NAMOBJ, {
                    permanent: true,
                    direction: 'center',
                    className: 'bg-transparent border-0 text-white shadow-none font-weight-bold'
                });
                layer.on('popupopen', updatePopup);
            }

            layer.on({
                "click": zoomToFeature
            });
        }
        var geojsonLayer = new L.GeoJSON.AJAX({!! json_encode($geofile) !!}, {
            style: style,
            onEachFeature: onEachFeature
        });
        geojsonLayer.addTo(map);

        var legend = L.control({
            position: 'bottomright'
        });


        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'info legend')
            labels = []
            for (var i = 0; i < tematik.length; i++) {
                labels.push(
                    '<i style="background:' + color[tematik[i]] + '"></i> - ' + tematik[i]);
            }
            div.innerHTML = '<h4>Legenda:</h4>' + labels.join('<br>');
            return div;
        };

        legend.addTo(map);
        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: geojsonLayer,
            initial: false,
            zoom: 12,
            marker: false,
            propertyName: 'NAMOBJ',
            autoType: false,
            marker: {
                icon: false
            }

        });
        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);
        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 12,
            autoType: false,
            marker: false

        });
        controlSearch.on('search:locationfound', function(e) {

            e.layer.openPopup();

        }).on('search:collapsed', function(e) {});

        map.addControl(controlSearch);
        for (var i = 0; i < data.length; i++) {
            // var title = data[i][0],
            var title = "Alamat "+data[i][4]+"<br/>"+"Total Jumlah Banjir " + data[i][2] + "<br> Ketinggian Banjir Tertinggi " + data[
                    i][3] + " cm",
                loc = [data[i][0], data[i][1]],
                marker = new L.Marker(new L.latLng(loc), {
                    title: title
                });
            marker.bindPopup(title);
            markersLayer.addLayer(marker);

        }
        map.addControl(controlSearch);
        $("#printBtn").click(function() {
            $('#map').print();
        });
        map.createPane('labels');
        map.getPane('labels').style.zIndex = 650;
        var wmsLayer = L.tileLayer.wms(
            'https://inarisk1.bnpb.go.id:6443/arcgis/rest/services/inaRISK/layer_bahaya_banjir/ImageServer/exportImage?F=image&FORMAT=PNG32&TRANSPARENT=true&IMAGESR=3857&DPI=90', {
                pane: 'labels',
                opacity:1

            }).addTo(map);
        $(".leaflet-control-measure").click(function() {
            var oddClick = $(this).data("oddClick");
            $(this).data("oddClick", !oddClick);
            if (map.hasLayer(wmsLayer)) {
                $(this).removeClass('selected');
                map.removeLayer(wmsLayer);
            } else {
                map.addLayer(wmsLayer);
                $(this).addClass('selected');
            }
        });
        $('#opacity').change(function() {
            $(".leaflet-pane .leaflet-labels-pane").css("opacity", this.value);
        });
    </script>
@endpush
