<?php

namespace App\Exports;

use App\Models\application;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
  public function collection()
    {
        return Application::with(['offre', 'candidat'])->get();
    }

    public function headings(): array
    {
        return [
                'Candidate Full Name',
                'Application Status',
                'Offer Title',
                'Offer Description',
                'Application Date',
                'Duration',
                'Location',
                'Offer Type',
        ];
    }

    public function map($application): array
    {
        $candidat = $application->candidat;
        $offre = $application->offre;

        return [
            $candidat ? $candidat->prenom_candidat . ' ' . $candidat->nom_candidat : '',
            $application->statut ?? '',
            $offre->titre ?? '',
            $offre->description ?? '',
            $application->applied_at ?? '',
            $offre->duration ?? '',
            $offre->localisation ?? '',
            $offre->type ?? '',
        ];
    }
}
