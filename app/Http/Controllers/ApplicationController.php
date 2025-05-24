<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\application;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplicationRequest;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Application::with(['candidat', 'offre']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('candidat', function ($q) use ($search) {
                $q->where('nom_candidat', 'like', "%$search%")
                    ->orWhere('prenom_candidat', 'like', "%$search%");
            })->orWhereHas('offre', function ($q) use ($search) {
                $q->where('titre', 'like', "%$search%");
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $applications = $query->paginate(10);

        if ($request->ajax()) {
            return response()->view('admin.application.index', compact('applications'));
        }

        return view('admin.application.index', compact('applications'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Offre $offre)
    {
        $user = Auth::user();

        return view('user.apply_offre', [
            'offre' => $offre,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {

        $user = Auth::user();
        $candidat = $user->candidat_profile;   // candidat_profile the relation name that in the utilisateur model

        // Check if profile is missing
        if (!$candidat) {
            return back()->withErrors(['profile_missing' => 'Your candidate profile cannot be found. Please complete it before applying.']);
        }

        // Vérifie si déjà postulé
        $alreadyApplied = Application::where('offre_id', $request->offre_id)
            ->where('candidat_id', $candidat->candidat_id)
            ->exists();

        if ($alreadyApplied) {
            return back()->withErrors(['already_applied' => 'You have already applied for this job.'])->withInput();
        }

        // Stock fichiers
        $cvPath = $request->file('cv')->store('cvs', 'public');
        $lettrePath = $request->file('lettre_motivation')->store('lettres', 'public');

        $application = Application::create([
            'offre_id' => $request->offre_id,
            'utilisateur_id' => $user->utilisateur_id,
            'candidat_id' => $candidat->candidat_id,
            'cv' => $cvPath,
            'lettre_motivation' => $lettrePath,
            'statut' => 'en attente',
            'applied_at' => now(),
        ]);

        // 🔔 Notification pour l’utilisateur interne
        Notification::create([
            'message' => 'Votre candidature a été envoyée avec succès.',
            'type' => 'info',
            'lue' => false,
            'utilisateur_id' => $user->utilisateur_id,
            'application_id' => $application->application_id,
        ]);

        // 🔔 Notification pour l’admin
        $admin = \App\Models\Utilisateur::where('role', 'admin')->first();

        if ($admin) {
            Notification::create([
                'message' => 'New application for the offer' . $application->offre->titre . '" by ' . $candidat->nom_candidat . ' ' . $candidat->prenom_candidat,
                'type' => 'info',
                'lue' => false,
                'utilisateur_id' => $admin->utilisateur_id,
                'application_id' => $application->application_id,
            ]);
        }



        return redirect()->route('dashboard.user')->with('success', 'Votre candidature a été envoyée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(application $application)
    {
        $application->load(['offre', 'candidat']); // <-- This adds relationships to the existing model

        return view('admin.application.details', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(application $application)
    {
        $application->delete();
        return redirect()->route('application.index')->with('success', 'Application deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $validated = $request->validate([
            'statut' => 'required|in:pending,accept,refuse'
        ]);

        $application->update($validated);


        // Notify the user
        $user = $application->utilisateur;

        $statusMessage = match ($validated['statut']) {
            'accept' => 'Your application has been accepted. Congratulations! 🎉',
            'refuse' => 'Your application has been declined. Thank you for your interest.',
            'pending' => 'Your application is being processed.',
        };

        Notification::create([
            'message' => $statusMessage,
            'type' => 'info',
            'lue' => false,
            'utilisateur_id' => $user->utilisateur_id,
            'application_id' => $application->application_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
