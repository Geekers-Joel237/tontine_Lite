<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Parametre;

class ParametreController extends Controller
{
    public function index(){
        $Parametres = Parametre::all();
        return response()->json([
            'message' => 'Liste des Parametres',
            'data'=> $Parametres
        ],200);
    }

    public function show($id){
        $Parametre = Parametre::find($id);
        if (is_null($Parametre)) {
            return response()->json([
                'message' => 'Parametre Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Parametre Trouvee',
            'data' => $Parametre
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomP'=> 'required|unique:Parametres',
            'montant' => 'required',
            'tontine_id'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Parametre = Parametre::create($req->all());

        return response()->json([
            'message' => 'Parametre Ajoutee avec Success',
            'data' => $Parametre

        ],201);
    }




    public function update(Request $req, $id) {
        $Parametre = Parametre::find($id);
        if (is_null($Parametre)) {
            return response()->json([
                'message' => 'Parametre Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomP'=> 'required|unique:Parametres',
            'montant' => 'required',
            'tontine_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Parametre -> update($req->all());
        return response()->json([
            'message' => 'Parametre d\'identifiant '. $id . ' modifiee',
            'data' => $Parametre]);
        }

        public function destroy($id){
            $Parametre = Parametre::find($id);
            if (is_null($Parametre)) {
                return response()->json([
                    'message'=>'Parametre introuvable'
                ],404);
            }
            $copieParametre = $Parametre;
            $Parametre->delete();
            return response()->json([
                'message'=>'Parametre d\'indentifiant '.$id.' supprimee',
                'data'=>$copieParametre
            ]);
        }

        public function search(Request $req){
            $Parametres = [];
            $msg = '';
            if($req->tontine_id){
                $Parametres = Parametre::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Parametres de la tontine '.$req->tontine_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Parametres
            ]);
        }
}
