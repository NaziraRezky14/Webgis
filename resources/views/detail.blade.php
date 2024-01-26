@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Data Lokasi</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>{{ $data->tematik->kecamatan }}</td>
                                </tr>
                                @auth
                                    <tr>
                                        <td>Nama Pengusul</td>
                                        <td>{{ $data->nama_pelapor }}</td>
                                    </tr>

                                    <tr>
                                        <td>NIK</td>
                                        <td>{{ $data->nik }}</td>
                                    </tr>
                                @endauth

                                <tr>
                                    <td>Nama Lokasi</td>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $data->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan (Ada korban/tidak)</td>
                                    <td>{{ $data->ket }}</td>
                                </tr>
                                <tr>
                                    <td>Ketinggian Banjir</td>
                                    <td>{{ $data->ketinggian }} cm</td>
                                </tr>
                                <td>Longitude</td>
                                <td>{{ $data->long }}</td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td>{{ $data->lat }}</td>
                                </tr>
                                <tr>
                                    <td>Durasi banjir</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4 d-flex">
                                                <input type="number"  value={{ $data->hari }} class="form-control" id="hari" name="hari">
                                                <label id="hari" class="mx-2 my-auto">Hari</label>
                                            </div>
                                            <div class="col-md-4 d-flex">
                                                <input type="number" value={{ $data->jam }} class="form-control" id="jam" name="jam">
                                                <label id="jam" class="mx-2 my-auto">Jam</label>
                                            </div>
                                            <div class="col-md-4 d-flex">
                                                <input type="number" value={{ $data->menit }} class="form-control" id="menit" name="menit">
                                                <label id="menit" class="mx-2 my-auto">Menit</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        @if ($data->gambar)
                            <strong>Gambar</strong>
                        @endif
                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="">
                        <a href="{{ route('halaman data2') }}" class="btn mt-4 text-white"
                            style="background-color: #1D5C63">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detail Lokasi</div>
                    <div class="card-body" id="mapid"></div>
                    @if ($data->kerusakan)
                        <strong>Kerusakan</strong>
                    @endif
                    <img src="{{ asset('storage/' . $data->kerusakan) }}" alt="">
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
        #mapid {
            min-height: 500px;
        }
    </style>
@endsection

@push('scripts')
    <!-- Leaflet JavaScript -->
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
        var map = L.map('mapid').setView([{{ $data->lat }}, {{ $data->long }}],
            {{ config('leafletsetup.detail_zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $data->lat }}, {{ $data->long }}]).addTo(map)

        axios.get('{{ route('api.places.index') }}')
            .then(function(response) {
                //console.log(response.data);
                L.geoJSON(response.data, {
                        pointToLayer: function(geoJsonPoint, latlng) {
                            return L.marker(latlng);
                        }
                    })
                    .bindPopup(function(layer) {
                        //return layer.feature.properties.map_popup_content;
                        return ('<div class="my-2"><strong>Place Name</strong> :<br>' + layer.feature.properties
                            .place_name + '</div> <div class="my-2"><strong>Description</strong>:<br>' + layer
                            .feature.properties.description +
                            '</div><div class="my-2"><strong>Address</strong>:<br>' + layer.feature.properties
                            .address + '</div>');
                    }).addTo(map);
                console.log(response.data);
            })
            .catch(function(error) {
                console.log(error);
            });
    </script>
@endpush
