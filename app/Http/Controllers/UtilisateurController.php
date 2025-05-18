<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\application;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\CandidatProfile;
use App\Charts\ApplicationsChart;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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

   public function dashboardUser()
{
    $user = Auth::user(); 
    
    // Récupère les 5 dernières candidatures avec offre liée
    $applications = Application::with('offre')
        ->where('candidat_id', $user->candidat_profile->candidat_id)
        ->latest()
        ->take(5)
        ->get();

    // Notifications non lues
    $notifications = Notification::where('utilisateur_id', $user->utilisateur_id)
        ->where('lue', false)
        ->latest()
        ->get();

    // Compteurs
    $applicationsCount = Application::where('candidat_id', $user->candidat_profile->candidat_id)->count();
    $offersViewed = session()->get('offre_views', 0);
    $unreadNotifications = $notifications->count();

    return view('user.dashbord', compact(
        'applications', 
        'notifications',
        'applicationsCount',
        'offersViewed',
        'unreadNotifications'
    ));
}
    
}
