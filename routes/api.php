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


// Controllers
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\TontineController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\SanctionController;
use App\Http\Controllers\CotisationEvenementController;








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
Route::get('/publications',[PublicationController::class,'index']);
Route::get('/publications/evenements/user/{user_id}',[PublicationController::class,'getEventsByUserId']);
Route::get('/publications/annonces/user/{user_id}',[PublicationController::class,'getAnnoncesByUserId']);
Route::get('/publications/evenements/reunion/{reunion_id}',[PublicationController::class,'getEventsByReunionId']);
Route::get('/publications/annonces/reunion/{reunion_id}',[PublicationController::class,'getAnnoncesByReunionId']);
Route::get('/publications/evenements/{user_id}/{reunion_id}',[PublicationController::class,'getEventsByUserIdAndReunionId']);
Route::get('/publications/annonces/{user_id}/{reunion_id}',[PublicationController::class,'getAnnoncesByUserIdAndReunionId']);
Route::get('/publications/{id}',[PublicationController::class,'show']);
Route::post('/publications',[PublicationController::class,'store']);
Route::put('/publications/{id}',[PublicationController::class,'update']);
Route::delete('/publications/{id}',[PublicationController::class,'destroy']);

//Reunions
Route::get('/reunions',[ReunionController::class,'index']);
Route::get('/reunions/{id}',[ReunionController::class,'show']);
Route::post('/reunions',[ReunionController::class,'store']);
Route::put('/reunions/{id}',[ReunionController::class,'update']);
Route::delete('/reunions/{id}',[ReunionController::class,'destroy']);
Route::get('/reunions/userowner/{id}',[ReunionController::class,'getUserOwnerReunions']);

//Rapports
Route::get('/rapports',[RapportController::class,'index']);
Route::get('/rapports/{id}',[RapportController::class,'show']);
Route::get('/rapports/seance/{id}',[RapportController::class,'getRapportsBySeanceId']); //
Route::post('/rapports',[RapportController::class,'store']);
Route::put('/rapports/{id}',[RapportController::class,'update']);
Route::delete('/rapports/{id}',[RapportController::class,'destroy']);


// tontines
Route::get('/tontines',[TontineController::class,'index']);
Route::get('/tontines/{id}',[TontineController::class,'show']);
Route::get('/tontines/reunion/{id}',[TontineController::class,'getTontinesByReunionId']); //
Route::post('/tontines',[TontineController::class,'store']);
Route::put('/tontines/{id}',[TontineController::class,'update']);
Route::delete('/tontines/{id}',[TontineController::class,'destroy']);

//seances
Route::get('/seances',[SeanceController::class,'index']);
Route::get('/seances/{id}',[SeanceController::class,'show']);
Route::get('/seances/reunion/{id}',[SeanceController::class,'getSeancesByReunionId']); //
Route::post('/seances',[SeanceController::class,'store']);
Route::put('/seances/{id}',[SeanceController::class,'update']);
Route::delete('/seances/{id}',[SeanceController::class,'destroy']);

// sanctions
Route::get('/sanctions',[SanctionController::class,'index']);
Route::get('/sanctions/{id}',[SanctionController::class,'show']);
Route::get('/sanctions/user/{id}',[SanctionController::class,'getsanctionsByUserId']); //
Route::post('/sanctions',[SanctionController::class,'store']);
Route::put('/sanctions/{id}',[SanctionController::class,'update']);
Route::delete('/sanctions/{id}',[SanctionController::class,'destroy']);

//cotisationsEvenements
Route::get('/cotisationEvenements',[CotisationEvenementController::class,'index']);
Route::get('/cotisationEvenements/{id}',[CotisationEvenementController::class,'show']);
Route::get('/cotisationEvenements/user/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByUserId']);
Route::get('/cotisationEvenements/reunion/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByReunionId']);
Route::get('/cotisationEvenements/evenement/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByEvenementId']);
Route::get('/cotisationEvenements/user/event/{id}/{id}',[CotisationEvenementController::class,'getcotisationEvenementsUserByEventId']);
Route::get('/cotisationEvenements/reunion/event/{id}/{id}',[CotisationEvenementController::class,'getcotisationEvenementsReunionByEventId']);

Route::post('/cotisationEvenements',[CotisationEvenementController::class,'store']);
Route::put('/cotisationEvenements/{id}',[CotisationEvenementController::class,'update']);
Route::delete('/cotisationEvenements/{id}',[CotisationEvenementController::class,'destroy']);


