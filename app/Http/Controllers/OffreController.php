<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\Offrerequest;
use Illuminate\Http\RedirectResponse;

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


        return view('pages.offre', compact('offres', 'localisations', 'durations')); //  Show all offres
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.offre.create_offre');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Offrerequest $request)
    {
        // dd($request->all());
        Offre::create($request->validated());
        
        return redirect()->route('offreAdmin')->with('success', 'offre created successfully'); //  rediriger la page  view/admin/offre/offreAd,in avec un message de success
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
    public function edit(Offre $offre): View
    {
        return view('admin.offre.edite', compact('offre')); //  Show edit offre page

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Offrerequest $request, Offre $offre): RedirectResponse
    {
        $offre->update($request->validated());
        return redirect()->route('offreAdmin')->with('success', 'offre updated successfully'); //  rediriger la page  view/admin/offre/offreAdmin avec un message de success
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offre $offre)
    {
        $offre->delete();
        return redirect()->route('offreAdmin')->with('success', 'offre deleted successfully');
    }
    // retourne tous les offre 
    public function indexAdmin()
    {
        $offres = Offre::all();
        return view('admin.offre.offreAdmin', compact('offres'));
    }
}
