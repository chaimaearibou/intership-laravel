<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\UtilisateurController;

// * main home page
Route::get('/', [HomeController::class, 'index'])->name('home');  
//* offre page /index
Route::get('/offre',[OffreController::class,'index'])->name('offre'); 
//* contact page
Route::get('/contact',function(){ return view('pages.contact');})->name('contact'); 
// * show un offre /show
Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');  // show one offre
// * admin dasbord
Route::get('/dasbordAdmin',[UtilisateurController::class,'index'])->name('dasbordAdmin'); // show admin dasbord
