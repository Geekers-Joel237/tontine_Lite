<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cotisation;
use App\Models\User;
use App\Models\Tontine;


class CotisationController extends Controller
{
    public function index(){
        $cotisations = Cotisation::all();
        return response()->json([
            'message' => 'Liste des cotisations',
            'data'=> $cotisations
        ],200);
    }

    public function show($id){
        $cotisation = Cotisation::find($id);
        if (is_null($cotisation)) {
            return response()->json([
                'message' => 'cotisation Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'cotisation Trouvee',
            'data' => $cotisation
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomCotisation'=> 'required',
            'motif' => 'required|string',
            'etat' =>'required',
            'classement' => 'required',
            'montant'=>'required',
            'user_id' =>'required',
            'seance_id' =>'required',
            'tontine_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $cotisation = Cotisation :: create($req->all());
        return response()->json([
            'message' => 'cotisation Ajoutee avec Success',
            'data' => $cotisation

        ],201);
    }

    public function update(Request $req, $id) {
        $cotisation = Cotisation::find($id);
        if (is_null($cotisation)) {
            return response()->json([
                'message' => 'cotisation Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomCotisation'=> 'required',
            'motif' => 'required|string',
            'etat' =>'required',
            'classement' => 'required',
            'montant'=>'required',
            'user_id' =>'required',
            'seance_id' =>'required',
            'tontine_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $cotisation -> update($req->all());
        return response()->json([
            'message' => 'cotisation d\'identifiant '. $id . ' modifie',
            'data' => $cotisation]);
        }

        public function destroy($id){
            $cotisation = Cotisation::find($id);
            if (is_null($cotisation)) {
                return response()->json([
                    'message'=>'cotisation introuvable'
                ],404);
            }
            $copiecotisation = $cotisation;
            $cotisation->delete();
            return response()->json([
                'message'=>'cotisation d\'indentifiant '.$id.' supprimee',
                'data'=>$copiecotisation
            ]);
        }

        public function getcotisationsByUserId($userId){
            $userOwnerCotisations = Cotisation::all()->where('user_id',$userId);
            return response()->json([
                'message'=>'cotisations de  l\'user d\'id '. $userId,
                'data'=>$userOwnerCotisations
            ]);
        }

        public function getcotisationsBySeanceId($seanceId){
            $seanceOwnerCotisations = Cotisation::all()->where('seance_id',$seanceId);
            return response()->json([
                'message'=>'cotisations de la seance d\'id '. $seanceId,
                'data'=>$seanceOwnerCotisations
            ]);
        }

        public function getcotisationsByTontineId($tontineId){
            $tontineOwnerCotisations = Cotisation::all()->where('tontine_id',$tontineId);
            return response()->json([
                'message'=>'cotisations crees pour la totine d\'id '. $tontineId,
                'data'=>$tontineOwnerCotisations
            ]);
        }

        public function getcotisationsUserByTontineId($userId,$tontineId){
            $userAndTontineOwnerCotisations = Cotisation::all()->where('user_id',$userId)
                                                                                ->where('tontine_id',$tontineId);
            return response()->json([
                'message'=>'cotisations de l\'user d\'id '. $userId .' pour la tontine d\'id '.$tontineId,
                'data'=>$userAndTontineOwnerCotisations
            ]);
        }

        public function getcotisationsUserBySeanceId($userId,$seanceId){
            $userAndSeanceOwnerCotisations = Cotisation::all()->where('user_id',$userId)
                                                                                ->where('seance_id',$seanceId);
            return response()->json([
                'message'=>'cotisations de l\'user d\'id '. $userId .' pour la Seance d\'id '.$seanceId,
                'data'=>$userAndSeanceOwnerCotisations
            ]);
        }

        public function getcotisationsTontineBySeanceId($tontineId,$seanceId){
            $userAndTontineOwnerCotisations = Cotisation::all()->where('tontine_id',$tontineId)
                                                                                ->where('seance_id',$seanceId);
            return response()->json([
                'message'=>'cotisations de la tontine d\'id '. $tontineId .' pour la Seance d\'id '.$seanceId,
                'data'=>$userAndTontineOwnerCotisations
            ]);
        }

        public function getTontineListByUserId($userId){
            $cotisations = Cotisation::all()
                                            ->where('user_id',$userId);

            $tontinesId = [];
            $tontinesList = [];
            foreach($cotisations as $cotisation => $value){
                $tontinesId[] = $value ->tontine_id;
            }
            $tontinesId = array_unique($tontinesId);
            foreach($tontinesId as $tontineId){
                $tontine = Tontine::find($tontineId);
                if(!is_null($tontine)){
                    $tontinesList[] = $tontine;
                }
            }
            return response()->json([
                'message' => 'Liste des tontines de l\'user d\'id '.$userId,
                'data' => $tontinesList
            ]);
        }

        public function getUserListByTontineId($tontineId){
            $cotisations = Cotisation::all()
                                            ->where('tontine_id',$tontineId);

            $usersId = [];
            $usersList = [];
            foreach($cotisations as $cotisation => $value){
                $usersId[] = $value ->user_id;
            }
            $usersId = array_unique($usersId);
            foreach($usersId as $userId){
                $user = User::find($userId);
                if(!is_null($user)){
                    $usersList[] = $user;
                }
            }
            return response()->json([
                'message' => 'Liste des membres ayant cotise a l\' d\'id '.$tontineId,
                'data' => $usersList
            ]);
        }





}
