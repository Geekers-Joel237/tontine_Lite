<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Membre;
use Illuminate\Support\Facades\DB;


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
            // 'exercice_id' =>'sometimes',
            'user_id' =>'required',
            'demande_id' =>'sometimes',


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
            // 'tontine_id' =>'required',
            // // 'exercice_id' =>'sometimes',
            // 'user_id' =>'required',
            // 'demande_id' =>'sometimes',

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
            if($req->user_id){
                $Membres = DB::table('tontines')
                        ->join('membres','tontines.id','=','membres.tontine_id')
                        ->select('membres.*','tontines.*')
                        ->where('membres.user_id', $req->user_id)
                        ->get();

                // $membres = Demande::where('user_id', $req->user_id)->get();
                $msg = 'tontines du user'.$req->user_id;
            }



            return response()->json([
                'message'=>$msg,
                'data'=>$Membres
            ]);
        }

        public function allMembresInfos($id){
            $membre = Membre::find($id);
            if (is_null($membre)) {
                return response()->json([
                    'message' => 'membre Introuvable'
                ],404);
            }

            $membre -> retards = DB::table('retards')
            ->join('membres','membres.id','=','retards.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('retards.membre_id',$id)
            ->select('retards.*','membres.*','users.nom','users.prenom')
            ->get();

            $membre -> echecs = DB::table('echecs')
            ->join('membres','membres.id','=','echecs.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('echecs.membre_id',$id)
            ->select('echecs.*','membres.*','users.nom','users.prenom')
            ->get();

            $membre -> cotisations = DB::table('cotisations')
            ->join('membres','membres.id','=','cotisations.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('cotisations.membre_id',$id)
            ->select('cotisations.*','membres.*','users.nom','users.prenom')
            ->get();

            return response()->json([
                'data'=>$membre
            ]);


        }
}
