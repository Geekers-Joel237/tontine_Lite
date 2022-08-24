<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Rapport;

class RapportController extends Controller
{
    public function index(){
        $rapports = Rapport::all();
        return response()->json([
            'message' => 'Liste des rapports',
            'data'=> $rapports
        ],200);
    }

    public function show($id){
        $rapport = Rapport::find($id);
        if (is_null($rapport)) {
            return response()->json([
                'message' => 'rapport Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'rapport Trouvee',
            'data' => $rapport
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'motif'=> 'required|unique:rapports',
            'description' => 'required',
            'seance_id' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $rapport = Rapport :: create($req->all());
        return response()->json([
            'message' => 'rapport Ajoutee avec Success',
            'data' => $rapport

        ],201);
    }

    public function update(Request $req, $id) {
        $rapport = Rapport::find($id);
        if (is_null($rapport)) {
            return response()->json([
                'message' => 'rapport Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'motif'=> 'required|unique:rapports',
            'description' => 'required',
            'seance_id' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $rapport -> update($req->all());
        return response()->json([
            'message' => 'rapport d\'identifiant '. $id . ' modifie',
            'data' => $rapport]);
        }

        public function destroy($id){
            $rapport = Rapport::find($id);
            if (is_null($rapport)) {
                return response()->json([
                    'message'=>'rapport introuvable'
                ],404);
            }
            $copierapport = $rapport;
            $rapport->delete();
            return response()->json([
                'message'=>'rapport d\'indentifiant '.$id.' supprimee',
                'data'=>$copierapport
            ]);
        }

        public function getRapportsBySeanceId($seanceId) {
            $rapports = Rapport::all()->where('seance_id', $seanceId);
            return response()->json([
                'message'=>'rapports de la seance d\'id '. $seanceId,
                'data'=>$rapports
            ]);
        }

}
