<?php

namespace App\Charts;

use App\Models\application;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ApplicationsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->labels(['Pending', 'Accepted', 'Refused']);

        $this->dataset('Applications by Status', 'bar', [
            application::where('statut', 'pending')->count(),
            application::where('statut', 'accept')->count(),
            application::where('statut', 'refuse')->count()
        ])->backgroundColor(['#ffc107', '#28a745', '#dc3545']);
    }
}
