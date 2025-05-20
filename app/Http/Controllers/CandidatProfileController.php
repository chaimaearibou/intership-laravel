<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CandidatProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CandidatProfileRequest;

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
        // Optional: Authorize to make sure only the owner can edit
        if ($candidat_profile->utilisateur_id !== Auth::id()) {
            abort(403);
        }

        return view('user.edite_profile', compact('candidat_profile'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(CandidatProfileRequest $request, CandidatProfile $candidat_profile)
    {
        // Authorization check
        if ($candidat_profile->utilisateur_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update profile fields
        $candidat_profile->nom_candidat = $request->input('nom_candidat');
        $candidat_profile->prenom_candidat = $request->input('prenom_candidat');
        $candidat_profile->number = $request->input('number');

        // Handle photo upload if provided in same form (optional)
        if ($request->hasFile('photo')) {
            if ($candidat_profile->photo && !Str::startsWith($candidat_profile->photo, ['http://', 'https://'])) {
                Storage::disk('public')->delete('profile_photos/' . $candidat_profile->photo);
            }
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_photos', $filename, 'public');
            $candidat_profile->photo = $filename;
        }

        $candidat_profile->save();

        // ALSO update Utilisateur table names for consistency
        $user = Auth::user();
        $user->nom = $request->input('nom_candidat');
        $user->prenom = $request->input('prenom_candidat');
        $user->save();

        return redirect()->route('profile.user')->with('success', 'Profile has been updated.');
    }

    // la fonction pour update la photo de profile
    public function updatePhoto(Request $request, CandidatProfile $candidat_profile)
    {
        if ($candidat_profile->utilisateur_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($candidat_profile->photo && !Str::startsWith($candidat_profile->photo, ['http://', 'https://'])) {
                Storage::disk('public')->delete('profile_photos/' . $candidat_profile->photo);
            }

            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $candidat_profile->photo = $photoPath;
            $candidat_profile->save();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CandidatProfile $candidat_profile)
    {
        $candidat_profile->delete();
        return redirect()->route('candidats.index')->with('success', 'Candidat profile deleted successfully');
    }

    public function Showprofile()
    {
        $user =  Auth::user();;
        return view('user.profile', compact('user'));;
    }
}
