<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Beneficiaire;

class BeneficiaireController extends Controller
{
    public function index(){
        $Beneficiaires = Beneficiaire::all();
        return response()->json([
            'message' => 'Liste des Beneficiaires',
            'data'=> $Beneficiaires
        ],200);
    }

    public function show($id){
        $Beneficiaire = Beneficiaire::find($id);
        if (is_null($Beneficiaire)) {
            return response()->json([
                'message' => 'Beneficiaire Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Beneficiaire Trouvee',
            'data' => $Beneficiaire
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'dateSeance'=> 'required',
            'classement' => 'required',
            'montant' => 'required',
            // 'validation' => 'required',
            'membre_id' => 'required',
            'seance_id'=>'required',
            'exercice_id' => 'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Beneficiaire = Beneficiaire::create($req->all());

        return response()->json([
            'message' => 'Beneficiaire Ajoutee avec Success',
            'data' => $Beneficiaire

        ],201);
    }




    public function update(Request $req, $id) {
        $Beneficiaire = Beneficiaire::find($id);
        if (is_null($Beneficiaire)) {
            return response()->json([
                'message' => 'Beneficiaire Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'dateSeance'=> 'required',
            'classement' => 'required',
            'montant' => 'required',
            'validation' => 'required',
            'membre_id' => 'required',
            'seance_id'=>'required',
            'exercice_id' => 'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Beneficiaire -> update($req->all());
        return response()->json([
            'message' => 'Beneficiaire d\'identifiant '. $id . ' modifiee',
            'data' => $Beneficiaire]);
        }

        public function destroy($id){
            $Beneficiaire = Beneficiaire::find($id);
            if (is_null($Beneficiaire)) {
                return response()->json([
                    'message'=>'Beneficiaire introuvable'
                ],404);
            }
            $copieBeneficiaire = $Beneficiaire;
            $Beneficiaire->delete();
            return response()->json([
                'message'=>'Beneficiaire d\'indentifiant '.$id.' supprimee',
                'data'=>$copieBeneficiaire
            ]);
        }

        public function search(Request $req){
            $Beneficiaires = [];
            $msg = '';
            if($req->seance_id and $req->membre_id){
                $Beneficiaires = Beneficiaire::where('seance_id', $req->seance_id)
                                            ->where('membre_id', $req->membre_id)
                                            ->get();
                $msg = 'Beneficiaires de la tontine '.$req->seance_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Beneficiaires
            ]);
        }
}
