<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Membre;

class MembreController extends Controller
{
    public function index(){
        $Membres = Membre::all();
        return response()->json([
            'message' => 'Liste des Membres',
            'data'=> $Membres
        ],200);
    }

    public function show($id){
        $Membre = Membre::find($id);
        if (is_null($Membre)) {
            return response()->json([
                'message' => 'Membre Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Membre Trouvee',
            'data' => $Membre
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'tontine_id' =>'required',
            'exercice_id' =>'sometimes',
            'user_id' =>'required',
            'demande_id' =>'required',


        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Membre = Membre::create($req->all());

        return response()->json([
            'message' => 'Membre Ajoutee avec Success',
            'data' => $Membre

        ],201);
    }




    public function update(Request $req, $id) {
        $Membre = Membre::find($id);
        if (is_null($Membre)) {
            return response()->json([
                'message' => 'Membre Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'tontine_id' =>'required',
            'exercice_id' =>'sometimes',
            'user_id' =>'required',
            'demande_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Membre -> update($req->all());
        return response()->json([
            'message' => 'Membre d\'identifiant '. $id . ' modifiee',
            'data' => $Membre]);
        }

        public function destroy($id){
            $Membre = Membre::find($id);
            if (is_null($Membre)) {
                return response()->json([
                    'message'=>'Membre introuvable'
                ],404);
            }
            $copieMembre = $Membre;
            $Membre->delete();
            return response()->json([
                'message'=>'Membre d\'indentifiant '.$id.' supprimee',
                'data'=>$copieMembre
            ]);
        }

        public function search(Request $req){
            $Membres = [];
            $msg = '';
            if($req->tontine_id){
                $Membres = Membre::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Membres de la tontine '.$req->tontine_id;
            }
            if($req->tontine_id and $req->estActif){
                $Membres = Membre::where('tontine_id', $req->tontine_id)
                                    ->where('estActif', $req->estActif)
                                    ->get();
                $msg = 'Membres actifs de la tontine '.$req->tontine_id;
            }
            if($req->exercice_id){
                $Membres = Membre::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Membres de l\'exercice '.$req->exercice_id;
            }



            return response()->json([
                'message'=>$msg,
                'data'=>$Membres
            ]);
        }
}
