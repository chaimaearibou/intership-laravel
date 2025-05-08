<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\application;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\CandidatProfile;
use App\Charts\ApplicationsChart;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalOffers = Offre::count();
        $totalApplications = application::count();
        $totalCandidates = CandidatProfile::count();
        $pendingApplications = Application::where('statut', 'pending')->count();
    
        $recentApplications = Application::with(['candidat', 'offre'])
                                    ->orderByDesc('applied_at')
                                    ->limit(5)->get();
    
        $recentOffers = Offre::orderByDesc('creer_at')->limit(5)->get();
        $chart = new ApplicationsChart();
    
        return view('admin.dashbord', compact(
            'totalOffers',
            'totalApplications',
            'totalCandidates',
            'pendingApplications',
            'recentApplications',
            'recentOffers',
            'chart'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        //
    }
}
