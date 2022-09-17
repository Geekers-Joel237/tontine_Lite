<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Exercice;

class ExerciceController extends Controller
{
    public function index(){
        $Exercices = Exercice::all();
        return response()->json([
            'message' => 'Liste des Exercices',
            'data'=> $Exercices
        ],200);
    }

    public function show($id){
        $Exercice = Exercice::find($id);
        if (is_null($Exercice)) {
            return response()->json([
                'message' => 'Exercice Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Exercice Trouvee',
            'data' => $Exercice
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomE'=> 'required|unique:Exercices',
            'frequence' => 'required',
            'dateDebutE' =>'required',
            'dateFinE' =>'required',
            'heureTontine' =>'required',
            'tontine_id'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Exercice = Exercice::create($req->all());

        return response()->json([
            'message' => 'Exercice Ajoutee avec Success',
            'data' => $Exercice

        ],201);
    }




    public function update(Request $req, $id) {
        $Exercice = Exercice::find($id);
        if (is_null($Exercice)) {
            return response()->json([
                'message' => 'Exercice Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomE'=> 'required|unique:Exercices',
            'frequence' => 'required',
            'dateDebutE' =>'required',
            'dateFinE' =>'required',
            'heureTontine' =>'required',
            'tontine_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Exercice -> update($req->all());
        return response()->json([
            'message' => 'Exercice d\'identifiant '. $id . ' modifiee',
            'data' => $Exercice]);
        }

        public function destroy($id){
            $exercice = Exercice::find($id);
            if (is_null($exercice)) {
                return response()->json([
                    'message'=>'Exercice introuvable'
                ],404);
            }
            $copieExercice = $exercice;
            $exercice->delete();
            return response()->json([
                'message'=>'Exercice d\'indentifiant '.$id.' supprimee',
                'data'=>$copieExercice
            ]);
        }

        public function search(Request $req){
            $Exercices = [];
            $msg = '';
            if($req->tontine_id){
                $Exercices = Exercice::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Exercices de la tontine '.$req->tontine_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Exercices
            ]);
        }


}
