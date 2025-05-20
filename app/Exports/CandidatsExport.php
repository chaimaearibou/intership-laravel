<?php

namespace App\Exports;

use App\Models\CandidatProfile;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CandidatsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CandidatProfile::with('utilisateur')->get();
    }
    public function headings(): array
    {
        return [
            'Candidate ID',
            'First Name',
            'Last Name',
            'Phone Number',
            'Email',
        ];
    }

        public function map($candidat): array
    {
        return [
            $candidat->candidat_id,
            $candidat->prenom_candidat,
            $candidat->nom_candidat,
            $candidat->number,
            $candidat->utilisateur->email ?? '', // <-- Added email data
        ];
    }
}
