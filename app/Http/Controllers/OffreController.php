<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)    //* fonction qui afficher tous les offre 
    {
        $query = Offre::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('localisation')) {
            $query->where('localisation', $request->localisation);
        }
    
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }
    
        // Optional sorting
        $query->orderBy('date_debut', 'desc');
    
        // Pagination
        $offres = $query->paginate(9)->withQueryString(); // keep filters in pagination links
    
        // Get unique values for filters
        $localisations = Offre::select('localisation')->distinct()->pluck('localisation');
        $durations = Offre::select('duration')->distinct()->pluck('duration');


        
        return view('pages.offre',compact('offres','localisations','durations')); //  Show all offres
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
    public function show(Offre $offre)
    {
        return view('pages.offre_details', compact('offre')); //  Show one offre
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offre $offre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offre $offre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offre $offre)
    {
        //
    }
}
