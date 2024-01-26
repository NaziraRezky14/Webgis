@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('storage/css/halaman-data.css') }}">
    <section class="second-section" style=" background-color: #EDE6DB">
        <div class="container">
            <div class="card p-4">
            <h3><b>Cara Melihat Informasi Banjir Terkini</b></h3>
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 me-2 text-white rounded-circle px-1" style="width: fit-content">
                            1
                        </span> Buka Menu "Maps"
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/daftar.png') }}" alt="">
                    </div>
                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            2
                        </span> Maka anda akan melihat peta bahaya banjir, agar peta bahaya banjir tidak terlihat
                        dapat klik "Sembunyikan Peta Bahaya Banjir" atau turunkan nilai opacity agar Peta Kecamatan 
                        Aceh Utara terlihat jelas
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/IsiData.png') }}" alt="">
                    </div>
                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            3
                        </span> Untuk melihat informasi kejadian banjir terakhir, dapat klik kecamatan yang diinginkan dan untuk
                        melihat informasi banjir setiap titik, dapat klik titik yang ada pada peta.
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/Maps.png') }}" alt="">
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="card p-4">
            <h3><b>Cara Melihat HeatMaps Banjir Kabupaten Aceh Utara</b></h3>
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 me-2 text-white rounded-circle px-1" style="width: fit-content">
                            1
                        </span> Buka Menu "HeatMaps"
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/heatmap.png') }}" alt="">
                    </div>
                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            2
                        </span> Maka anda akan melihat titik dengan warna dimana titik tersebut adalah lokasi banjir yang pernah terjadi
                        beserta peta kawasan banjir. Anda dapat menurunkan opacity pada peta untuk melihat titik heatmaps dengan jelas.
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/heatmaps.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card p-4">
            <h3><b>Jika Ingin Melaporkan Kejadian Banjir</b></h3>
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 me-2 text-white rounded-circle px-1" style="width: fit-content">
                            1
                        </span> Buka Menu "Lapor Banjir"
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/lapor.png') }}" alt="">
                    </div>
                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            2
                        </span> Maka anda akan melihat data banjir yang pernah terjadi dan untuk melaporkan kejadian banjir, Anda 
                        dapat menekan tombol "Lapor Banjir".
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/databanjir.png') }}" alt="">
                    </div>
                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            3
                        </span> Maka Anda akan diarahkan kepada formulir untuk mengisi laporan banjir agar laporan segera diproses.
                        Jika sudah selesai, tekan tombol "Tambah".
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/tambahdata.png') }}" alt="">
                    </div>
                </div>

            </div>
        </div>


        <div class="container">
            <div class="card p-4">
                <div class="col">
                    <h3><b>Data Dampak Banjir di Kabupaten Aceh Utara
                </div>
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            1
                        </span>Buka menu "Terdampak"
                    </div>

                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/terdampak.png') }}" alt="">
                    </div>
                </div>


                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            2
                        </span> Maka Anda akan melihat data dampak akibat banjir setiap kecamatan selama setahun. Untuk mengubah
                        data tahun, dapat menekan tombol "Pilih Tahun" pada sisi kanan peta.
                    </div>
                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/dampak.png') }}" alt=""></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="card p-4">
                <div class="col">
                    <h3><b>Jika Anda Pihak Badan Penanggulangan Bencana
                </div>
                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            1
                        </span> Login menggunakan Akun yang sudah disediakan untuk Admin
                    </div>

                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/loginAdmin.png') }}" alt=""></div>

                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            2
                        </span> Menu dashboard akan menampilkan informasi seputar banjir Kabupaten Aceh Utara seperti
                        Maps, HeatMaps, Terdampak, dan Laporan Banjir beserta grafik.
                    </div>

                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/dashboard.png') }}" alt=""></div>

                </div>

                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            3
                        </span> Jika terdapat data banjir yang keliru atau perlu diperbaiki, Admin dapat 
                        mengubah data tersebut di menu Laporan Banjir.
                    </div>

                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/laporadmin.png') }}" alt="">
                    </div>
                </div>



                <div class="mt-2">
                    <div class="mb-2">
                        <span class="bg-success me-2 text-white rounded-circle px-1" style="width: fit-content">
                            4
                        </span>
                        Menu Terdampak selain menampilkan data dampak banjir selama setahun, Admin dapat menambahkan
                        data baru jika pada akhir tahun sudah selesai dirampung.
                    </div>

                    <div class="text-center"><img class="mx-auto" width="700"
                            src="{{ asset('storage/img/terdampakad.png') }}" alt="">
                    </div>
                </div>
            </div> 
        </div>

    </section>
@endsection
