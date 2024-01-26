<?php

namespace App\Http\Controllers;

use App\Exports\Banjir;
use App\Models\DataBanjir;
use App\Models\HalamanData as ModelsHalamanData;
use App\Models\HalamanData2 as ModelsHalamanData2;
use App\Models\Tematik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class HalamanData2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("halaman_data2", [
            'data' => DataBanjir::with('tematik')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tematik = Tematik::all();
        $geofile = [];
        $color = [];
        $index = 0;

        foreach ($tematik as $item) {
            $geofile[$index] = 'storage/' . $item->geojson;
            $index++;
        }
        foreach ($tematik as $item) {
            $color[$item->kecamatan] = $item->warna;
        }
        return view('tambah_data2', ['tematik' => $tematik, 'geofile' => $geofile, 'color' => $color]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = "";
        if ($request->hasFile('gambar')) {
            $fileName = $request->gambar->store('public/images');
            $fileName = str_replace("public/", "", $fileName);
        }
        if ($request->hasFile('kerusakan')) {
            $fileName2 = $request->kerusakan->store('public/images');
            $fileName2 = str_replace("public/", "", $fileName2);
        }
        DataBanjir::create([
            'tematik_id' => $request->kecamatan,
            'nama' => $request->lokasi,
            'alamat' => $request->alamat,
            'gambar' => $fileName,
            'long' => $request->long,
            'lat' => $request->lat,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'ket' => $request->ket,
            'ketinggian' => $request->ketinggian,
            'nama_pelapor' => $request->nama_pelapor,
            'nik' => $request->nik,
            'kerusakan' => $fileName2,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'menit' => $request->menit,
        ]);
        return redirect()->route('halaman data2');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('detail', [
            'data' => DataBanjir::find($id)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tematik = Tematik::all();
        return view('edit2', [
            'data' => DataBanjir::with('tematik')->find($id),
            'id' => $id,
            'tematik' => $tematik,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileName = "";
        $fileName2 = "";
        if ($request->hasFile('gambar')) {
            $file_path = storage_path('app/public/' . $request->gambar_lama);
            if (File::exists($file_path)) File::delete($file_path);
            $fileName = $request->gambar->store('public/images');
            $fileName = str_replace("public/", "", $fileName);
        } else {
            $fileName = $request->gambar_lama;
        }
        if ($request->hasFile('kerusakan')) {
            $file_path2 = storage_path('app/public/' . $request->kerusakan);
            if (File::exists($file_path2)) File::delete($file_path);
            $fileName2 = $request->kerusakan->store('public/images');
            $fileName2 = str_replace("public/", "", $fileName2);
        } else {
            $fileName2 = $request->kerusakan_lama;
        }
        DataBanjir::find($id)->update([
            'tematik_id' => $request->kecamatan,
            'nama' => $request->lokasi,
            'alamat' => $request->alamat,
            'gambar' => $fileName,
            'kerusakan' => $fileName2,
            'long' => $request->long,
            'lat' => $request->lat,
            'tanggal' => $request->tanggal,
            'hari' => $request->hari,
            'jam' => $request->jam,
            'menit' => $request->menit,
        ]);
        return redirect()->route('halaman data2');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataBanjir::find($id);
        $file_path = storage_path('app/public/' . $data->gambar);
        if (File::exists($file_path)) File::delete($file_path);
        $data->delete();
        return back();
    }
    public function export(){
        return Excel::download(new Banjir, 'rekap.xlsx');
    }
}
