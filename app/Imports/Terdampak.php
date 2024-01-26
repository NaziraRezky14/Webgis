<?php

namespace App\Imports;

use App\Models\Tematik;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Terdampak implements ToCollection, WithHeadingRow
{
    
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
                'rmh_terandam' => $row['rumah_terendam'],
                't_kk' => $row['korban_terdampak_kk'],
                't_jiwa' => $row['korban_terdampak_jiwa'],
                'm_mengungsi' => $row['korban_mengungsi_kk'],
                'm_jiwa' => $row['korban_mengungsi_jiwa'],
                'sakit' => $row['korban_sakit'],
                'meninggal' => $row['korban_meninggal'],
                'hilang' => $row['korban_hilang'],
                'created_at' => Carbon::now()
            ];
            array_push($dataToAdd, $data);
        }
        $datas = DB::table('terdampaks')->insert($dataToAdd);
        return $datas;
    }
}
