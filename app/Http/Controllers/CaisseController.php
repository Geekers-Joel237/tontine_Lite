<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Caisse;

use Illuminate\Http\Request;

class CaisseController extends Controller
{

    public function index(){
        $Caisses = Caisse::all();
        return response()->json([
            'message' => 'Liste des Caisses',
            'data'=> $Caisses
        ],200);
    }

    public function show($id){
        $Caisse = Caisse::find($id);
        if (is_null($Caisse)) {
            return response()->json([
                'message' => 'Caisse Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Caisse Trouvee',
            'data' => $Caisse
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomC'=> 'required|unique:Caisses',
            'solde' => 'required',
            'tontine_id'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Caisse = Caisse::create($req->all());

        return response()->json([
            'message' => 'Caisse Ajoutee avec Success',
            'data' => $Caisse

        ],201);
    }




    public function update(Request $req, $id) {
        $Caisse = Caisse::find($id);
        if (is_null($Caisse)) {
            return response()->json([
                'message' => 'Caisse Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomC'=> 'required|unique:Caisses',
            'solde' => 'required',
            'tontine_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Caisse -> update($req->all());
        return response()->json([
            'message' => 'Caisse d\'identifiant '. $id . ' modifiee',
            'data' => $Caisse]);
        }

        public function destroy($id){
            $Caisse = Caisse::find($id);
            if (is_null($Caisse)) {
                return response()->json([
                    'message'=>'Caisse introuvable'
                ],404);
            }
            $copieCaisse = $Caisse;
            $Caisse->delete();
            return response()->json([
                'message'=>'Caisse d\'indentifiant '.$id.' supprimee',
                'data'=>$copieCaisse
            ]);
        }

        public function search(Request $req){
            $Caisses = [];
            $msg = '';
            if($req->tontine_id){
                $Caisses = Caisse::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Caisses de la tontine '.$req->tontine_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Caisses
            ]);
        }

}
