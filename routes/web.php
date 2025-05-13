<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidatProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UtilisateurController;
use App\Models\CandidatProfile;
// * la route de page home
Route::get('/', [HomeController::class, 'index'])->name('home');
// * la route qui  afficher tous les offres
Route::get('/offre', [OffreController::class, 'index'])->name('offre');
// * la route qui afficher one offer /show
Route::get('/offre/{offre}', [OffreController::class, 'show'])->name('offres.show');
//! les route que admin can access to 
Route::middleware(['auth', 'admin'])->group(function () {
    // *!la route qui retourne la page de dasborf admin
    Route::get('/dashbord', [UtilisateurController::class, 'index'])->name('dasbordAdmin');
    //* la roote qui retourne la page offreadmin / index
    Route::get('/offreAdmin', [OffreController::class, 'indexAdmin'])->name('offreAdmin');
    //*  la route qui retourner la page des cndidate pour admin /index
    Route::get('/candidatAdmin', [CandidatProfileController::class, 'index'])->name('candidats.index');
    // * la route qui retourne tous les applications /index
    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    // * la route qui redirier a la page de create offer 
    Route::get('/offres/creates', [OffreController::class, 'create'])->name('offre.create');
    // * la route qui rediriger vers la page de edite offre
    Route::get('/offre/{offre}/edit', [OffreController::class, 'edit'])->name('offre.edit');
    //* la route qui rediriger ver offre /destroy
    Route::delete('/offre/{offre}', [OffreController::class, 'destroy'])->name('offre.destroy');
    // * la route pour update un offre
    Route::put('/offre/{offre}', [OffreController::class, 'update'])->name('offre.update');
    // * la route pour ajouter un offre
    Route::post('/offre', [OffreController::class, 'store'])->name('offre.store');
    // * la route pour candidat / show
    Route::get('/candidat/{candidat}', [CandidatProfileController::class, 'show'])->name('candidats.show');
    // * la route pour candidat / destroy
    Route::delete('/candidat/{candidat_profile}', [CandidatProfileController::class, 'destroy'])->name('candidats.destroy');
    // *la route pour afficher applicaton /show
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    // * la route pour application destroy 
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    // * la route pour modifier le status de l'application
    Route::post('/applications/{id}/status', [ApplicationController::class, 'updateStatus']) ->name('applications.status');
});

// ! les route de de login 
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('show.login')->middleware('guest');;
Route::post('/login', [AuthController::class, 'login'])->name('login');

// ! la route de registre
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('show.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// ! la route de logout /deconnecter  
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//! dasbord  User route
Route::get('/dashboard/user', fn() => view('user.dashbord'))->middleware(['auth', 'interne'])->name('dashboard.user');
