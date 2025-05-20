<?php

namespace App\Exports;

use App\Models\Utilisateur;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Utilisateur::all();
    }
}
