@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
          
            <div class="row">

                <div class="col-lg-11">
                    <div id="map"></div>
                </div>
                <div class="col-lg-1">
                    <label for="opacity">Opacity</label>
                    <div class="d-flex h-100">
                        <input id="opacity" type="range" class="form-control h-50" min="0" max="1"
                            value="0.2" step="0.1" list="tickmarks">
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
        .leaflet-pane .leaflet-labels-pane{
            opacity: 0.2;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.1.0/leaflet.ajax.min.js"
        integrity="sha512-Abr21JO2YqcJ03XGZRPuZSWKBhJpUAR6+2wH5zBeO4wAw4oksr8PRdF+BKIRsxvCdq+Mv4670rZ+dLnIyabbGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>

    <script src="{{ asset('storage/js/heatmap/build/heatmap.min.js') }}"></script>
    <script src="{{ asset('storage/js/leaflet-heatmap.js') }}"></script>
    <script type="text/javascript">
        var s = [4.9786, 97.2221];
        var color = {!! json_encode($color) !!};
        var data = {!! json_encode($data) !!}
        var coor = {!! json_encode($coor) !!}
        var test = {!! json_encode($test) !!}
        var map = L.map('map').setView(
            s, 11
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);


        var info = L.control();

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };
        //menampilkan pop up info tematik
        info.update = function(props) {
            this._div.innerHTML = '<h4>Kecamatan</h4>' + (props ?
                '<b>' + props.NAMOBJ + '</b><br />' + props.MhsSIF + ' orang' :
                'Gerakkan mouse Anda');
        };
        var dataMap = {
            data: coor
        };
        var cfg = {
            "radius": 0.005,
            "maxOpacity": .8,
            "scaleRadius": true,
            "useLocalExtrema": true,
            latField: 'lat',
            lngField: 'lng',
            valueField: 'count'
        };


        var heatmapLayer = new HeatmapOverlay(cfg);
        heatmapLayer.setData(dataMap);
        heatmapLayer.addTo(map);
       
        //memunculkan highlight pada peta
        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }
        // for (var i = 0; i < data.length; i++) {
        //     marker = new L.marker([data[i][1], data[i][2]])
        //         .bindPopup(data[i][3]  +"<br>"+data[i][0]+ "<br> Total Jumlah Banjir "+data[i][4]  )
        //         .addTo(map);
        // }


        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        var legend = L.control({
            position: 'bottomright'
        });
        map.createPane('labels');
        map.getPane('labels').style.zIndex = 650;
        var wmsLayer = L.tileLayer.wms(
            'https://inarisk1.bnpb.go.id:6443/arcgis/rest/services/inaRISK/layer_bahaya_banjir/ImageServer/exportImage?F=image&FORMAT=PNG32&TRANSPARENT=true&IMAGESR=3857&DPI=90', {
                pane: 'labels',
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
