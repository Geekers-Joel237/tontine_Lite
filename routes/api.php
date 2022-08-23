<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Models
use App\Models\Annonce;

// Controllers
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EvenementController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User

// Annonces
Route::get('/annonces',[AnnonceController::class,'index']);
Route::get('/annonces/{id}',[AnnonceController::class,'show']);
Route::post('/annonces',[AnnonceController::class,'store']);
Route::put('/annonces/{id}',[AnnonceController::class,'update']);
Route::delete('/annonces/{id}',[AnnonceController::class,'destroy']);

//Evenements
Route::get('/evenements',[EvenementController::class,'index']);
Route::get('/evenements/{id}',[EvenementController::class,'show']);
Route::post('/evenements',[EvenementController::class,'store']);
Route::put('/evenements/{id}',[EvenementController::class,'update']);
Route::delete('/evenements/{id}',[EvenementController::class,'destroy']);

//publications
Route::get('/publications',[PublicationsController::class,'index']);
Route::get('/publications/evenements/{user_id}',[PublicationsController::class,'index']);
Route::get('/publications/annonces/{user_id}',[PublicationsController::class,'index']);
Route::get('/publications/evenements/{reunion_id}',[PublicationsController::class,'index']);



