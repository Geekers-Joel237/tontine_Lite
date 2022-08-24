<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reunion;


class ReunionController extends Controller
{
    public function index(){
        $reunions = Reunion::all();
        return response()->json([
            'message' => 'Liste des reunions',
            'data'=> $reunions
        ],200);
    }

    public function show($id){
        $reunion = Reunion::find($id);
        if (is_null($reunion)) {
            return response()->json([
                'message' => 'reunion Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'reunion Trouvee',
            'data' => $reunion
        ]);
    }

    //check`
    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomReunion'=> 'required|unique:reunions',
            'reglement' => 'required',
            'slogan' =>'required',
            'maxEffectif' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $reunion = Reunion :: create($req->all());
        return response()->json([
            'message' => 'reunion Ajoutee avec Success',
            'data' => $reunion

        ],201);
    }

    public function update(Request $req, $id) {
        $reunion = Reunion::find($id);
        if (is_null($reunion)) {
            return response()->json([
                'message' => 'reunion Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomReunion'=> 'required|unique:reunions',
            'reglement' => 'required',
            'slogan' =>'required',
            'maxEffectif' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $reunion -> update($req->all());
        return response()->json([
            'message' => 'reunion d\'identifiant '. $id . ' modifie',
            'data' => $reunion]);
        }

        public function destroy($id){
            $reunion = Reunion::find($id);
            if (is_null($reunion)) {
                return response()->json([
                    'message'=>'reunion introuvable'
                ],404);
            }
            $copiereunion = $reunion;
            $reunion->delete();
            return response()->json([
                'message'=>'reunion d\'indentifiant '.$id.' supprimee',
                'data'=>$copiereunion
            ]);
        }

        public function getUserOwnerReunions($userId){
            $userOwnerReunions = Reunion::all()->where('user_id',$userId);
            return response()->json([
                'message'=>'reunions crees par l\'user d\'id '. $userId,
                'data'=>$userOwnerReunions
            ]);
        }


}
