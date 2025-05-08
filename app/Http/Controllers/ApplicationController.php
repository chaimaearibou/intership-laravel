<?php

namespace App\Http\Controllers;

use App\Models\application;
use Illuminate\Http\Request;

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
    
        if ($request->filled('statut')  ) {
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
    
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }
}
