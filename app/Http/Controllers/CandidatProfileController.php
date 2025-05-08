<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CandidatProfile;

class CandidatProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $statut = $request->input('statut');

        // Start the query with the relationships
        $query = CandidatProfile::with('utilisateur');

        // Apply search filter if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('prenom_candidat', 'like', "%$search%")
                    ->orWhere('nom_candidat', 'like', "%$search%")
                    ->orWhereHas('utilisateur', function ($q2) use ($search) {
                        $q2->where('email', 'like', "%$search%");
                    });
            });
        }

        // Apply statut filter if provided
        if ($statut) {
            $query->where('statut', $statut);
        }

        // Paginate the results and keep the query parameters in the URL
        $candidats = $query->paginate(20)->appends($request->query());

        // Return the view with the filtered candidates
        return view('admin.candidate.index', compact('candidats'));
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
    public function show(CandidatProfile $candidat)
    {
        // Ensure that the model instance is retrieved with the relationships loaded
        $candidat = CandidatProfile::with('utilisateur')->findOrFail($candidat->candidat_id);

        return view('admin.candidate.details', compact('candidat'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CandidatProfile $candidat_profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CandidatProfile $candidat_profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidatProfile $candidat_profile)
    {
        $candidat_profile->delete();
        return redirect()->route('candidats.index')->with('success', 'Candidat profile deleted successfully');
    }

    

}
