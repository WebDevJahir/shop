<?php

namespace App\Exports;

use App\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;

class subscriberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Newsletter::all();
    }
}
