<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seance;

class SeanceController extends Controller
{
    public function index(){
        $seances = Seance::all();
        return response()->json([
            'message' => 'Liste des seances',
            'data'=> $seances
        ],200);
    }

    public function show($id){
        $seance = seance::find($id);
        if (is_null($seance)) {
            return response()->json([
                'message' => 'seance Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'seance Trouvee',
            'data' => $seance
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'dateSeance'=> 'required',
            'heureSeance' => 'required',
            'etat' =>'required',
            'reunion_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $seance = Seance :: create($req->all());
        return response()->json([
            'message' => 'seance Ajoutee avec Success',
            'data' => $seance

        ],201);
    }

    public function update(Request $req, $id) {
        $seance = Seance::find($id);
        if (is_null($seance)) {
            return response()->json([
                'message' => 'seance Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'dateSeance'=> 'required',
            'heureSeance' => 'required',
            'etat' =>'required',
            'reunion_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $seance -> update($req->all());
        return response()->json([
            'message' => 'seance d\'identifiant '. $id . ' modifie',
            'data' => $seance]);
        }

        public function destroy($id){
            $seance = seance::find($id);
            if (is_null($seance)) {
                return response()->json([
                    'message'=>'seance introuvable'
                ],404);
            }
            $copieseance = $seance;
            $seance->delete();
            return response()->json([
                'message'=>'seance d\'indentifiant '.$id.' supprimee',
                'data'=>$copieseance
            ]);
        }

        public function getSeancesByReunionId($reunionId){
            $reunionsOwnerSeances = Seance::all()->where('reunion_id',$reunionId);
            return response()->json([
                'message'=>'seances crees par la reunion d\'id '. $reunionId,
                'data'=>$reunionsOwnerSeances
            ]);
        }
}
