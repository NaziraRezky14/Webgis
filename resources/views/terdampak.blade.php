@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/halaman-data.css') }}">
    <div class="container-xl">
        <div class="table-responsive" style="background-color: white">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Data Terdampak</h2>
                        </div>
                        @auth
                            <div class="col-sm-6 text-end d-flex justify-content-end">
                                <select class="form-control w-25" id="tahun">
                                    <option value={{ date('Y') }} selected>--Pilih Tahun--</option>
                                    @foreach ($tahunList as $item)
                                        <option value="{{ $item->tanggal }}"
                                            {{ $tahun == $item->tanggal ? 'selected' : '' }}>
                                            {{ $item->tanggal }}
                                        </option>
                                    @endforeach
                                </select>
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="button" class="btn text-white" style="background-color: #417D7A"
                                        onclick="document.getElementById('import').click()" value="Tambah csv" />
                                    <input type="file" id="import" name="file" onchange="form.submit()"
                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                        class="btn btn-danger d-none">
                                </form>
                            </div>
                        @else
                            <div class="col-sm-6 text-end d-flex justify-content-end">
                                <select class="form-control w-25" id="tahun">
                                    <option value={{ date('Y') }} selected>--Pilih Tahun--</option>
                                    @foreach ($tahunList as $item)
                                        <option value="{{ $item->tanggal }}"
                                            {{ $tahun == $item->tanggal ? 'selected' : '' }}>
                                            {{ $item->tanggal }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endauth

                    </div>

                </div>

                <div id="map"></div>
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

        .leaflet-control {
            max-height: 14rem;
            overflow-y: auto
        }
    </style>
@endsection
@push('scripts')
    <script>
        $('#tahun').change(function() {
            window.location.href = '/terdampak/' + this.value;
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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
        var tematik = {!! json_encode($tematik) !!}
        var terdampak = {!! json_encode($terdampak) !!}
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

                    terdampak[id[feature.properties.NAMOBJ]] ? terdampak[id[feature.properties.NAMOBJ]] :
                    'Tidak Ada Data', {
                        maxHeight: 200,
                        minWidth: 200,

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
            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 12, 25, 37, 50, 62, 75, 87], //pretty break untuk 8
                from, to;
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
        $("#printBtn").click(function() {
            $('#map').print();
        });
    </script>
@endpush
