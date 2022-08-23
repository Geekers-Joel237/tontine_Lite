<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Evenement;

class EvenementController extends Controller
{
    public function index(){
        $evenements = Evenement::all();
        return response()->json([
            'message' => 'Liste des evenements',
            'data'=> $evenements
        ],200);
    }

    public function show($id){
        $evenement = Evenement::find($id);
        if (is_null($evenement)) {
            return response()->json([
                'message' => 'evenement Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'evenement Trouvee',
            'data' => $evenement
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'titre'=> 'required|unique:evenements',
            'dateEvenement' => 'required',
            'image' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $evenement = Evenement :: create($req->all());
        return response()->json([
            'message' => 'evenement Ajoutee avec Success',
            'data' => $evenement

        ],201);
    }

    public function update(Request $req, $id) {
        $evenement = Evenement::find($id);
        if (is_null($evenement)) {
            return response()->json([
                'message' => 'evenement Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'titre'=> 'required|unique:evenements',
            'dateEvenement' => 'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $evenement -> update($req->all());
        return response()->json([
            'message' => 'evenement d\'identifiant '. $id . ' modifie',
            'data' => $evenement]);
        }

        public function destroy($id){
            $evenement = Evenement::find($id);
            if (is_null($evenement)) {
                return response()->json([
                    'message'=>'evenement introuvable'
                ],404);
            }
            $copieevenement = $evenement;
            $evenement->delete();
            return response()->json([
                'message'=>'evenement d\'indentifiant '.$id.' supprimee',
                'data'=>$copieevenement
            ],204);
        }
}
