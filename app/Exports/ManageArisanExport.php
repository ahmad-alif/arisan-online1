<?php

namespace App\Exports;

use App\Models\Arisan;
use Maatwebsite\Excel\Concerns\FromCollection;

class ManageArisanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Arisan::all();
    }
}
