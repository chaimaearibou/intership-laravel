<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');  //main home page
Route::get('/offre',[OffreController::class,'index'])->name('offre'); //offre page : show all offre
Route::get('/contact',function(){ return view('pages.contact');})->name('contact'); //contact page
Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');  // show one offre
