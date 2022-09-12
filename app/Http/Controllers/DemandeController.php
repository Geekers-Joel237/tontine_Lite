<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Demande;

class DemandeController extends Controller
{

    public function index(){
        $Demandes = Demande::all();
        return response()->json([
            'message' => 'Liste des Demandes',
            'data'=> $Demandes
        ],200);
    }

    public function show($id){
        $Demande = Demande::find($id);
        if (is_null($Demande)) {
            return response()->json([
                'message' => 'Demande Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Demande Trouvee',
            'data' => $Demande
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[

            'exercice_id' =>'sometimes',
            'user_id'=>'required',
            'tontine_id'=>'sometimes'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Demande = Demande::create($req->all());

        return response()->json([
            'message' => 'Demande Ajoutee avec Success',
            'data' => $Demande

        ],201);
    }




    public function update(Request $req, $id) {
        $Demande = Demande::find($id);
        if (is_null($Demande)) {
            return response()->json([
                'message' => 'Demande Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'exercice_id' =>'sometimes',
            'user_id'=>'required',
            'tontine_id'=>'sometimes'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Demande -> update($req->all());
        return response()->json([
            'message' => 'Demande d\'identifiant '. $id . ' modifiee',
            'data' => $Demande]);
        }

        public function destroy($id){
            $Demande = Demande::find($id);
            if (is_null($Demande)) {
                return response()->json([
                    'message'=>'Demande introuvable'
                ],404);
            }
            $copieDemande = $Demande;
            $Demande->delete();
            return response()->json([
                'message'=>'Demande d\'indentifiant '.$id.' supprimee',
                'data'=>$copieDemande
            ]);
        }

        public function search(Request $req){
            $Demandes = [];
            $msg = '';
            if($req->tontine_id){
                $Demandes = Demande::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Demandes de la tontine '.$req->tontine_id;
            }
            if($req->exercice_id){
                $Demandes = Demande::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Demandes de l\'exercice '.$req->exercice_id;
            }
            if($req->user_id){
                $Demandes = Demande::where('user_id', $req->user_id)->get();
                $msg = 'Demandes du user'.$req->user_id;
            }
            if($req->user_id and $req->validation){
                echo(0);
                if($req->validation == 'false'){
                    echo(1);
                    $Demandes = Demande::where('user_id', $req->user_id)
                                        ->where('validation',false)
                                        ->get();
                }else {
                    echo(2);

                    $Demandes = Demande::where('user_id', $req->user_id)
                                        ->where('validation',true)
                                        ->get();
                }
                $msg = 'Demandes du user'.$req->user_id;
            }
           
            if($req->exercice_id and $req->user_id){
                $Demandes = Demande::where('exercice_id', $req->exercice_id)
                ->where('user_id', $req->user_id)
                ->get();
                $msg = 'Demandes de l\'exercice  '.$req->exercice_id .
                ' pour le user '.$req->user_id;
            }
            if($req->tontine_id and $req->user_id ){
                $Demandes = Demande::where('tontine_id', $req->tontine_id)
                ->where('user_id', $req->user_id)
                ->get();
                $msg = ' tontine  '.$req->tontine_id .
                ' user '.$req->user_id;
            }



            return response()->json([
                'message'=>$msg,
                'data'=>$Demandes
            ]);
        }

}
