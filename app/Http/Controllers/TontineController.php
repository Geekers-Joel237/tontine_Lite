<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tontine;

class TontineController extends Controller
{
    public function index(){
        $tontines = Tontine::all();
        return response()->json([
            'message' => 'Liste des tontines',
            'data'=> $tontines
        ],200);
    }

    public function show($id){
        $tontine = Tontine::find($id);
        if (is_null($tontine)) {
            return response()->json([
                'message' => 'Tontine Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Tontine Trouvee',
            'data' => $tontine
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'intitule'=> 'required|unique:tontines',
            'monnaie' => 'required',
            'modePaiement' =>'required',
            'reglement' =>'required',
            'numeroCompte' =>'required',
            'effectifMax'=>'required',
            'montant'=>'required',
            'reunion_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $tontine = Tontine :: create($req->all());
        return response()->json([
            'message' => 'tontine Ajoutee avec Success',
            'data' => $tontine

        ],201);
    }

    public function update(Request $req, $id) {
        $tontine = Tontine::find($id);
        if (is_null($tontine)) {
            return response()->json([
                'message' => 'tontine Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'intitule'=> 'required|unique:tontines',
            'monnaie' => 'required',
            'modePaiement' =>'required',
            'reglement' =>'required',
            'numeroCompte' =>'required',
            'effectifMax'=>'required',
            'montant'=>'required',
            'reunion_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $tontine -> update($req->all());
        return response()->json([
            'message' => 'tontine d\'identifiant '. $id . ' modifie',
            'data' => $tontine]);
        }

        public function destroy($id){
            $tontine = Tontine::find($id);
            if (is_null($tontine)) {
                return response()->json([
                    'message'=>'tontine introuvable'
                ],404);
            }
            $copietontine = $tontine;
            $tontine->delete();
            return response()->json([
                'message'=>'tontine d\'indentifiant '.$id.' supprimee',
                'data'=>$copietontine
            ]);
        }

        public function getTontinesByReunionId($reunionId){
            $tontines = Tontine::all()->where('reunion_id',$reunionId);
            return response()->json([
                'message'=>'tontines appartenant a la reunion d\'id '. $reunionId,
                'data'=>$tontines
            ]);
        }
}
