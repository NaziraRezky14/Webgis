<?php

namespace App\Exports;

use App\Models\DataBanjir;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class Banjir implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = DataBanjir::all();
        return view('banjir-export',['data'=>$data]);
    }
}
