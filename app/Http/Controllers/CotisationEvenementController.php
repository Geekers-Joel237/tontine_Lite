<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CotisationEvenement;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CotisationEvenementController extends Controller
{
    public function index(){
        $cotisationsEvenement = CotisationEvenement::all();
        return response()->json([
            'message' => 'Liste des cotisationsEvenement',
            'data'=> $cotisationsEvenement
        ],200);
    }

    public function show($id){
        $cotisationEvenement = CotisationEvenement::find($id);
        if (is_null($cotisationEvenement)) {
            return response()->json([
                'message' => 'cotisationEvenement Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'cotisationEvenement Trouvee',
            'data' => $cotisationEvenement
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'montant'=> 'required',
            'motif' => 'required|string',
            // 'etat' =>'required',
            'user_id' =>'required',
            'evenement_id' =>'required',
            'reunion_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $cotisationEvenement = CotisationEvenement :: create($req->all());
        return response()->json([
            'message' => 'cotisationEvenement Ajoutee avec Success',
            'data' => $cotisationEvenement

        ],201);
    }

    public function update(Request $req, $id) {
        $cotisationEvenement = CotisationEvenement::find($id);
        if (is_null($cotisationEvenement)) {
            return response()->json([
                'message' => 'cotisationEvenement Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'montant'=> 'required',
            'motif' => 'required|string',
            // 'etat' =>'required',
            'user_id' =>'required',
            'evenement_id' =>'required',
            'reunion_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $cotisationEvenement -> update($req->all());
        return response()->json([
            'message' => 'cotisationEvenement d\'identifiant '. $id . ' modifie',
            'data' => $cotisationEvenement]);
        }

        public function destroy($id){
            $cotisationEvenement = cotisationEvenement::find($id);
            if (is_null($cotisationEvenement)) {
                return response()->json([
                    'message'=>'cotisationEvenement introuvable'
                ],404);
            }
            $copiecotisationEvenement = $cotisationEvenement;
            $cotisationEvenement->delete();
            return response()->json([
                'message'=>'cotisationEvenement d\'indentifiant '.$id.' supprimee',
                'data'=>$copiecotisationEvenement
            ]);
        }

        public function getcotisationEvenementsByUserId($userId){
            $userOwnerCotisationEvenements = CotisationEvenement::all()->where('user_id',$userId);
            return response()->json([
                'message'=>'cotisationEvenements crees par l\'user d\'id '. $userId,
                'data'=>$userOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsByReunionId($reunionId){
            $reunionOwnerCotisationEvenements = CotisationEvenement::all()->where('reunion_id',$reunionId);
            return response()->json([
                'message'=>'cotisationEvenements crees par la reunion d\'id '. $reunionId,
                'data'=>$reunionOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsByEvenementId($eventId){
            $eventOwnerCotisationEvenements = CotisationEvenement::all()->where('evenement_id',$eventId);
            return response()->json([
                'message'=>'cotisationEvenements crees pour l\'evenement d\'id '. $eventId,
                'data'=>$eventOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsUserByEventId($userId,$eventId){
            $userAndEventOwnerCotisationEvenements = CotisationEvenement::all()->where('user_id',$userId)
                                                                                ->where('evenement_id',$eventId);
            return response()->json([
                'message'=>'cotisationEvenements de l\'user d\'id '. $userId .' pour l\'evenement '.$eventId,
                'data'=>$userAndEventOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsUserByReunionId($userId,$reunionId){
            $userAndReunionOwnerCotisationEvenements = CotisationEvenement::all()->where('user_id',$userId)
                                                                                ->where('reunion_id',$reunionId);
            return response()->json([
                'message'=>'cotisationEvenements de l\'user d\'id '. $userId .' pour la reunion '.$reunionId,
                'data'=>$userAndReunionOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsReunionByEventId($reunionId,$eventId){
            $reunionAndEventOwnerCotisationEvenements = CotisationEvenement::all()->where('reunion_id',$reunionId)
                                                                                ->where('evenement_id',$eventId);
            return response()->json([
                'message'=>'cotisationEvenements de la reunion d\'id '. $reunionId .' pour l\'evenement '.$eventId,
                'data'=>$reunionAndEventOwnerCotisationEvenements
            ]);
        }

        public function getcotisationEvenementsUsersListByEventId($eventId){
            $cotisationEvenements = CotisationEvenement::all()
                                            ->where('evenement_id',$eventId);

            $usersId = [];
            $usersList = [];
            foreach($cotisationEvenements as $cotisationEvenement => $value){
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
                'message' => 'Liste des membres ayant cotise a l\'evenement d\'id '.$eventId,
                'data' => $usersList
            ]);
        }



}

