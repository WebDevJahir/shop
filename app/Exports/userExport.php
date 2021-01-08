<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class userExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $exportData = User::select('name','email','city','address')->where('status',1)->orderBy('id','Desc')->get();
        return $exportData;
    }

    public function headings(): array{
    	return['Name','Email','City','Address'];
    }
}
