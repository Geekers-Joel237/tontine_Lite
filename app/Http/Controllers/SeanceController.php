<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seance;

class SeanceController extends Controller
{

    public function index(){
        $Seances = Seance::all();
        return response()->json([
            'message' => 'Liste des Seances',
            'data'=> $Seances
        ],200);
    }

    public function show($id){
        $Seance = Seance::find($id);
        if (is_null($Seance)) {
            return response()->json([
                'message' => 'Seance Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Seance Trouvee',
            'data' => $Seance
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomS'=> 'required|unique:Seances',
            'dateS' => 'required',
            'exercice_id'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Seance = Seance::create($req->all());

        return response()->json([
            'message' => 'Seance Ajoutee avec Success',
            'data' => $Seance

        ],201);
    }




    public function update(Request $req, $id) {
        $Seance = Seance::find($id);
        if (is_null($Seance)) {
            return response()->json([
                'message' => 'Seance Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomS'=> 'required|unique:Seances',
            'dateS' => 'required',
            'exercice_id'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Seance -> update($req->all());
        return response()->json([
            'message' => 'Seance d\'identifiant '. $id . ' modifiee',
            'data' => $Seance]);
        }

        public function destroy($id){
            $Seance = Seance::find($id);
            if (is_null($Seance)) {
                return response()->json([
                    'message'=>'Seance introuvable'
                ],404);
            }
            $copieSeance = $Seance;
            $Seance->delete();
            return response()->json([
                'message'=>'Seance d\'indentifiant '.$id.' supprimee',
                'data'=>$copieSeance
            ]);
        }

        public function search(Request $req){
            $Seances = [];
            $msg = '';
            if($req->exercice_id){
                $Seances = Seance::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Seances de l\'exercice '.$req->exercice_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Seances
            ]);
        }
}
