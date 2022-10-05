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


//Controllers
use App\Http\Controllers\TontineController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\CaisseController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\DetteController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\RetardController;
use App\Http\Controllers\EchecController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MembreController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/login2', 'login2');
    Route::post('/auth/register', 'register');
    Route::post('/auth/refresh', 'refresh');
    Route::post('/auth/logout', 'logout');

});

//Tontines
Route::get('/tontines',[TontineController::class,'index']);
Route::get('/tontines/{id}',[TontineController::class,'show']);
Route::get('/tontines-info/{id}',[TontineController::class,'allTontinesInfo']);
Route::post('/tontines/search',[TontineController::class,'search']);
Route::post('/tontines/filter',[TontineController::class,'filter']);
Route::post('/tontines',[TontineController::class,'store']);
Route::put('/tontines/{id}',[TontineController::class,'update']);
Route::delete('/tontines/{id}',[TontineController::class,'destroy']);

//Exercices
Route::get('/exercices',[ExerciceController::class,'index']);
Route::get('/exercices/{id}',[ExerciceController::class,'show']);
Route::post('/exercices/search',[ExerciceController::class,'search']);
Route::post('/exercices',[ExerciceController::class,'store']);
Route::put('/exercices/{id}',[ExerciceController::class,'update']);
Route::delete('/exercices/{id}',[ExerciceController::class,'destroy']);
Route::get('/exercices-info/{id}',[ExerciceController::class,'allExercicesInfo']);

//Seances
Route::get('/seances',[SeanceController::class,'index']);
Route::get('/seances/{id}',[SeanceController::class,'show']);
Route::post('/seances/search',[SeanceController::class,'search']);
Route::post('/seances',[SeanceController::class,'store']);
Route::put('/seances/{id}',[SeanceController::class,'update']);
Route::delete('/seances/{id}',[SeanceController::class,'destroy']);
Route::get('/seances-info/{id}',[SeanceController::class,'allseancesInfos']);

//Caisses
Route::get('/caisses',[CaisseController::class,'index']);
Route::get('/caisses/{id}',[CaisseController::class,'show']);
Route::post('/caisses/search',[CaisseController::class,'search']);
Route::post('/caisses',[CaisseController::class,'store']);
Route::put('/caisses/{id}',[CaisseController::class,'update']);
Route::delete('/caisses/{id}',[CaisseController::class,'destroy']);

//Beneficiaires
Route::get('/beneficiaires',[BeneficiaireController::class,'index']);
Route::get('/beneficiaires/{id}',[BeneficiaireController::class,'show']);
Route::post('/beneficiaires/search',[BeneficiaireController::class,'search']);
Route::post('/beneficiaires',[BeneficiaireController::class,'store']);
Route::put('/beneficiaires/{id}',[BeneficiaireController::class,'update']);
Route::delete('/beneficiaires/{id}',[BeneficiaireController::class,'destroy']);

//Cotisations
Route::get('/cotisations',[CotisationController::class,'index']);
Route::get('/cotisations/{id}',[CotisationController::class,'show']);
Route::post('/cotisations/search',[CotisationController::class,'search']);
Route::post('/cotisations',[CotisationController::class,'store']);
Route::put('/cotisations/{id}',[CotisationController::class,'update']);
Route::delete('/cotisations/{id}',[CotisationController::class,'destroy']);

//Dettes
Route::get('/dettes',[DetteController::class,'index']);
Route::get('/dettes/{id}',[DetteController::class,'show']);
Route::post('/dettes/search',[DetteController::class,'search']);
Route::post('/dettes',[DetteController::class,'store']);
Route::put('/dettes/{id}',[DetteController::class,'update']);
Route::delete('/dettes/{id}',[DetteController::class,'destroy']);

//Retards
Route::get('/retards',[RetardController::class,'index']);
Route::get('/retards/{id}',[RetardController::class,'show']);
Route::post('/retards/search',[RetardController::class,'search']);
Route::post('/retards',[RetardController::class,'store']);
Route::put('/retards/{id}',[RetardController::class,'update']);
Route::delete('/retards/{id}',[DetteController::class,'destroy']);

//Echecs
Route::get('/echecs',[EchecController::class,'index']);
Route::get('/echecs/{id}',[EchecController::class,'show']);
Route::post('/echecs/search',[EchecController::class,'search']);
Route::post('/echecs',[EchecController::class,'store']);
Route::put('/echecs/{id}',[EchecController::class,'update']);
Route::delete('/echecs/{id}',[EchecController::class,'destroy']);

//Fichiers
Route::post('/upload-file', [FichierController::class, 'upload']);
Route::post('/upload-files', [FichierController::class, 'fileUpload']);
Route::post('/documents',[FichierController::class,'getDocumentsByCustomId']);
Route::delete('/documents/{id}',[FichierController::class, 'deleteFile']);
Route::post('/documents/{id}',[FichierController::class, 'updateFile']);

//Membres
Route::get('/membres',[MembreController::class,'index']);
Route::get('/membres/{id}',[MembreController::class,'show']);
Route::post('/membres/search',[MembreController::class,'search']);
Route::post('/membres',[MembreController::class,'store']);
Route::put('/membres/{id}',[MembreController::class,'update']);
Route::delete('/membres/{id}',[MembreController::class,'destroy']);

//Demandes
Route::get('/demandes',[DemandeController::class,'index']);
Route::get('/demandes/{id}',[DemandeController::class,'show']);
Route::post('/demandes/search',[DemandeController::class,'search']);
Route::post('/demandes',[DemandeController::class,'store']);
Route::put('/demandes/{id}',[DemandeController::class,'update']);
Route::delete('/demandes/{id}',[DemandeController::class,'destroy']);

