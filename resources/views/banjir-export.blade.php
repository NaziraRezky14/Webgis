<html>
<table>
    <thead>
        <tr>
            <th>no</th>
            <th>Kecamatan</th>
            <th>Nama Lokasi</th>
            <th>Alamat</th>
            <th>Tanggal</th>
            <th>Nama Pelapor</th>
            <th>Ketinggian Banjir</th>
            <th>Durasi Banjir</th>
      
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>{{ $item->tematik->kecamatan }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->nama_pelapor }}</td>
                <td>{{ $item->ketinggian }}</td>
                <td>{{ $item->hari }} Hari {{$item->jam}} Jam {{$item->menit}} Menit</td>
            </tr>
        @endforeach
    </tbody>
</table>

</html>
