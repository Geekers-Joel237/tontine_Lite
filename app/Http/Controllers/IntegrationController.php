<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Integration;
use App\Models\User;
use App\Models\Reunion;



class IntegrationController extends Controller
{
    public function index(){
        $integrations = Integration::all();
        return response()->json([
            'message' => 'Liste des integrations',
            'data'=> $integrations
        ],200);
    }

    public function show($id){
        $integration = Integration::find($id);
        if (is_null($integration)) {
            return response()->json([
                'message' => 'integration Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'integration Trouvee',
            'data' => $integration
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'dateIntegration'=> 'required',
            // 'statutMembre'=> 'required',
            'user_id'=>'required',
            'reunion_id' => 'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $integration = Integration :: create($req->all());
        return response()->json([
            'message' => 'integration Ajoutee avec Success',
            'data' => $integration

        ],201);
    }

    public function update(Request $req, $id) {
        $integration = Integration::find($id);
        if (is_null($integration)) {
            return response()->json([
                'message' => 'integration Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'dateIntegration'=> 'required',
            // 'statutMembre'=> 'required',
            'user_id'=>'required',
            'reunion_id' => 'required'
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $integration -> update($req->all());
        return response()->json([
            'message' => 'integration d\'identifiant '. $id . ' modifie',
            'data' => $integration]);
        }

        public function destroy($id){
            $integration = Integration::find($id);
            if (is_null($integration)) {
                return response()->json([
                    'message'=>'integration introuvable'
                ],404);
            }
            $copieintegration = $integration;
            $integration->delete();
            return response()->json([
                'message'=>'integration d\'indentifiant '.$id.' supprimee',
                'data'=>$copieintegration
            ]);
        }

        public function getintegrationsByReunionId($reunionId){
            $integrations = Integration::all()->where('reunion_id',$reunionId);
            return response()->json([
                'message'=>'membes appartenant a la reunion d\'id '. $reunionId,
                'data'=>$integrations
            ]);
        }


        public function getUserListByReunionId($reunionId){
            $integrations = Integration::all()
                                            ->where('reunion_id',$reunionId);

            $usersId = [];
            $usersList = [];
            foreach($integrations as $integration => $value){
                $usersId[] = $value ->user_id;
            }
            $usersId = array_unique($usersId);
            foreach($usersId as $userId){
                $user = User::find($userId);
                if(!is_null($user)){
                    $usersList[] = $user;
                }
            }
            return response()->json([
                'message' => 'Liste des membres de la reunion d\'id '.$reunionId,
                'data' => $usersList
            ]);
        }

        public function getReunionListByUserId($userId){
            $integrations = Integration::all()
                                            ->where('user_id',$userId);

            $reunionsId = [];
            $reunionsList = [];
            foreach($integrations as $integration => $value){
                $reunionsId[] = $value ->reunion_id;
            }
            $reunionsId = array_unique($reunionsId);
            foreach($reunionsId as $reunionId){
                $reunion = Reunion::find($reunionId);
                if(!is_null($reunion)){
                    $reunionsList[] = $reunion;
                }
            }
            return response()->json([
                'message' => 'Liste des membres de la reunion d\'id '.$reunionId,
                'data' => $reunionsList
            ]);
        }

}
