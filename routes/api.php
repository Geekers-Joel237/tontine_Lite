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
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileUploadController;










Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

// Route::middleware(['cors'])->group(function () {
//     Route::post('/auth/login',[AuthController::class,'login'] );

// });
// User
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/refresh', 'refresh');
    Route::post('/auth/logout', 'logout');

});

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
Route::get('/tontines/reunion/{id}',[TontineController::class,'getTontinesByReunionId']);
Route::post('/tontines',[TontineController::class,'store']);
Route::put('/tontines/{id}',[TontineController::class,'update']);
Route::delete('/tontines/{id}',[TontineController::class,'destroy']);
Route::get('/tontinesOuvertes',[TontineController::class,'getTontinesOuvertes']);

//seances
Route::get('/seances',[SeanceController::class,'index']);
Route::get('/seances/{id}',[SeanceController::class,'show']);
Route::get('/seances/reunion/{id}',[SeanceController::class,'getSeancesByReunionId']);
Route::post('/seances',[SeanceController::class,'store']);
Route::put('/seances/{id}',[SeanceController::class,'update']);
Route::delete('/seances/{id}',[SeanceController::class,'destroy']);

// sanctions
Route::get('/sanctions',[SanctionController::class,'index']);
Route::get('/sanctions/{id}',[SanctionController::class,'show']);
Route::get('/sanctions/user/{id}',[SanctionController::class,'getsanctionsByUserId']);
Route::post('/sanctions',[SanctionController::class,'store']);
Route::put('/sanctions/{id}',[SanctionController::class,'update']);
Route::delete('/sanctions/{id}',[SanctionController::class,'destroy']);

//cotisationsEvenements
Route::get('/cotisationEvenements',[CotisationEvenementController::class,'index']);
Route::get('/cotisationEvenements/{id}',[CotisationEvenementController::class,'show']);
Route::get('/cotisationEvenements/user/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByUserId']);
Route::get('/cotisationEvenements/reunion/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByReunionId']);
Route::get('/cotisationEvenements/evenement/{id}',[CotisationEvenementController::class,'getcotisationEvenementsByEvenementId']);
Route::get('/cotisationEvenements/user/event/{userId}/{eventId}',[CotisationEvenementController::class,'getcotisationEvenementsUserByEventId']);
Route::get('/cotisationEvenements/user/reunion/{userId}/{reunionId}',[CotisationEvenementController::class,'getcotisationEvenementsUserByReunionId']);
Route::get('/cotisationEvenements/reunion/event/{reunionId}/{eventId}',[CotisationEvenementController::class,'getcotisationEvenementsReunionByEventId']);
Route::get('/cotisationEvenements/usersList/{eventId}',[CotisationEvenementController::class,'getcotisationEvenementsUsersListByEventId']);
Route::post('/cotisationEvenements',[CotisationEvenementController::class,'store']);
Route::put('/cotisationEvenements/{id}',[CotisationEvenementController::class,'update']);
Route::delete('/cotisationEvenements/{id}',[CotisationEvenementController::class,'destroy']);

//Integrations
Route::get('/integrations',[IntegrationController::class,'index']);
Route::get('/integrations/{id}',[IntegrationController::class,'show']);
Route::get('/integrations/usersList/{reunionId}',[IntegrationController::class,'getUserListByReunionId']);
Route::get('/integrations/user/{reunionId}',[IntegrationController::class,'getintegrationsByReunionId']);
Route::get('/integrations/reunionsList/{userId}',[IntegrationController::class,'getReunionListByUserId']);
Route::post('/integrations',[IntegrationController::class,'store']);
Route::put('/integrations/{id}',[IntegrationController::class,'update']);
Route::delete('/integrations/{id}',[IntegrationController::class,'destroy']);

//Cotisations
Route::get('/cotisations',[CotisationController::class,'index']);
Route::get('/cotisations/{id}',[CotisationController::class,'show']);
Route::get('/cotisations/user/{id}',[CotisationController::class,'getcotisationsByUserId']);
Route::get('/cotisations/seance/{id}',[CotisationController::class,'getcotisationsBySeanceId']);
Route::get('/cotisations/tontine/{id}',[CotisationController::class,'getcotisationsByTontineId']);
Route::get('/cotisations/user/tontine/{userId}/{tontineId}',[CotisationController::class,'getcotisationsUserByTontineId']);
Route::get('/cotisations/user/seance/{userId}/{seanceId}',[CotisationController::class,'getcotisationsUserBySeanceId']);
Route::get('/cotisations/tontine/seance/{tontineId}/{seanceId}',[CotisationController::class,'getcotisationsTontineBySeanceId']);
Route::get('/cotisations/tontinesList/{userId}',[CotisationController::class,'getTontineListByUserId']);
Route::get('/cotisations/usersList/{tontineId}',[CotisationController::class,'getUserListByTontineId']);
Route::post('/cotisations',[CotisationController::class,'store']);
Route::put('/cotisations/{id}',[CotisationController::class,'update']);
Route::delete('/cotisations/{id}',[CotisationController::class,'destroy']);


//imagescni
Route::post('/upload-file', [FileUploadController::class, 'fileUpload']);
Route::post('/documents',[FileUploadController::class,'getDocumentsByCustomId']);
Route::delete('/documents/{id}',[FileUploadController::class, 'deleteFile']);
Route::post('/documents/{id}',[FileUploadController::class, 'updateFile']);

