<?php

namespace App\Exports;

use App\Models\Offre;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OffresExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return Offre::with('utilisateur')->get();
    }

        public function headings(): array
    {
        return [
            'Offer ID',
            'Title',
            'Description',
            'Location',
            'Duration',
            'Start Date',
            'End Date',
            'Type',
            'Created By ',
            'Created At',
        ];
    }
        public function map($offre): array
    {
        return [
            $offre->offre_id,
            $offre->titre,
            $offre->description,
            $offre->localisation,
            $offre->duration,
            $offre->date_debut,
            $offre->date_fin,
            $offre->type,
            $offre->utilisateur->nom ?? '', 
            $offre->creer_at,
        ];
    }
}
