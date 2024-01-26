@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-4">
            <form action="{{ route('data lokasi') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select class="form-select" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($tematik as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->kecamatan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Pelapor</label>
                            <input name="nama_pelapor" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input name="lokasi" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kejadian</label>
                            <input name="tanggal" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah korban</label>
                            <input name="ket" type="number" class="form-control" required>
                        </div>
                        <style>
                            .slider-wrapper input {
                                width: 358px;
                                height: 23px;
                                margin: 0;
                                transform-origin: 319px 71px;
                                transform: rotate(-90deg);
                            }
                        </style>
                        <div class="form-group">
                            <label>Ketinggian Banjir</label>
                            <div class="slider-wrapper text-end"
                                style="background: url({{ asset('/storage/level.png') }});background-repeat: no-repeat; background-size:310px 310px;background-position:bottom">
                                <input type="range" class="me-3" name="ketinggian" min="0" max="200"
                                    value="100" step="1" list="level">
                                <datalist id="level" class="d-block mr-5">
                                    <option class="border-1" value="200" label="200 cm"></option>
                                    <option class="border-1" value="190"></option>
                                    <option class="border-1" value="180"></option>
                                    <option class="border-1" value="170"></option>
                                    <option class="border-1" value="160"></option>
                                    <option class="border-1" value="150" label="150 cm"></option>
                                    <option class="border-1" value="140"></option>
                                    <option class="border-1" value="130"></option>
                                    <option class="border-1" value="120"></option>
                                    <option class="border-1" value="110"></option>
                                    <option class="border-1" value="100" label="100 cm"></option>
                                    <option class="border-1" value="90"></option>
                                    <option class="border-1" value="80"></option>
                                    <option class="border-1" value="70"></option>
                                    <option class="border-1" value="60"></option>
                                    <option class="border-1" value="50" label="50 cm"></option>
                                    <option class="border-1" value="40"></option>
                                    <option class="border-1" value="30"></option>
                                    <option class="border-1" value="20"></option>
                                    <option class="border-1" value="10"></option>
                                    <option class="border-1" value="0" label="0 cm"></option>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="form-group">
                                <label>Masukkan Gambar</label>
                                <input name="gambar" type="file" class="form-control">
                            </div> -->
                        <div class="form-group">
                            <label>NIK</label>
                            <input name="nik" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude <i class="text-danger">*Silahkan pilih titik lokasi pada map
                                    dibawah</i></label>
                            <input id='longitude' name="long" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Latitude <i class="text-danger">*Silahkan pilih titik lokasi pada map
                                    dibawah</i></label>
                            <input id='latitude' name="lat" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Kerusakan yang diakibatkan</label>
                            <input name="kerusakan" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Durasi banjir</label>
                            <div class="row">
                                <div class="col-md-4 d-flex">
                                    <input type="number" class="form-control" id="hari" name="hari">
                                    <label id="hari" class="mx-2 my-auto">Hari</label>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <input type="number" class="form-control" id="jam" name="jam">
                                    <label id="jam" class="mx-2 my-auto">Jam</label>
                                </div>
                                <div class="col-md-4 d-flex">
                                    <input type="number" class="form-control" id="menit" name="menit">
                                    <label id="menit" class="mx-2 my-auto">Menit</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label>Keterangan</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                       
                    </div>
                </div>
                <div class="container mt-4" id="mapid"></div>
                <button class="btn btn-primary float-end mt-4" type="submit">Tambah</button>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <style>
        #mapid {
            min-height: 500px;
        }
    </style>
@endsection

@push('scripts')
    <!-- Leaflet JavaScript -->
    <!-- Make sure you put this AFTER Leaflet's CSS -->
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
    <script>
        var mapCenter = [4.9786, 97.2221];
        var color = {!! json_encode($color) !!};

        var map = L.map('mapid').setView(mapCenter, {{ config('leafletsetup.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var marker = L.marker(mapCenter).addTo(map);

        function updateMarker(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("Your location :" + marker.getLatLng().toString())
                .openPopup();
            return false;
        };
        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            updateMarker(latitude, longitude);
        });
        var updateMarkerByInputs = function() {
            return updateMarker($('#latitude').val(), $('#longitude').val());
        }
        $('#latitude').on('input', updateMarkerByInputs);
        $('#longitude').on('input', updateMarkerByInputs);

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



        function zoomToFeature(e) {
            console.log(e)
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            if (feature.properties) {
                layer.bindTooltip(feature.properties.NAMOBJ, {
                    permanent: true,
                    direction: 'center',
                    className: 'bg-transparent border-0 text-white shadow-none font-weight-bold'
                });
            }

        }
        var geojsonLayer = new L.GeoJSON.AJAX({!! json_encode($geofile) !!}, {
            style: style,
            onEachFeature: onEachFeature
        });
        geojsonLayer.addTo(map);
        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);
    </script>
@endpush
