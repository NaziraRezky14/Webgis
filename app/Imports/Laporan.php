<?php

namespace App\Imports;

use App\Models\DataBanjir;
use App\Models\Tematik;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class Laporan implements ToCollection
{
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $dataToAdd = [];
        foreach ($collection as $row) {
            try {
                $tematik = Tematik::where('kecamatan', $row['kecamatan'])->first()->id;
            } catch (\Throwable $th) {
                dd($row['kecamatan']);
            }
            $data = [
                'tematik_id' => $tematik,
                'nama' => $row['nama'],
                'alamat' => $row['alamat'],
                'gambar' => '',
                'long' => $row['long'],
                'lat' => $row['lat'],
                'nama_pelapor' => $row['nama_pelapor'],
                'nik' => $row['nik'],
                'deskripsi' => $row['deskripsi'],
                'ket' => $row['ket'],
                'ketinggian' => $row['ketinggian'],
                'rumah' => $row['rumah'],
                'jalan' => $row['jalan'],
                'jembatan' => $row['jembatan'],
                'perkantoran' => $row['perkantoran'],
                'tmpt_ibadah' => $row['tmpt_ibadah'],
                'sekolah' => $row['sekolah'],
                'tanggul' => $row['tanggul'],
                'tanggal' => $this->transformDate($row['tanggal']),
            ];
            array_push($dataToAdd, $data);
        }
        $datas = DB::table('data_banjirs')->insert($dataToAdd);
        return $datas;
    }
}
