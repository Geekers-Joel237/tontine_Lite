<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sanction;

class SanctionController extends Controller
{
    public function index(){
        $sanctions = Sanction::all();
        return response()->json([
            'message' => 'Liste des sanctions',
            'data'=> $sanctions
        ],200);
    }

    public function show($id){
        $sanction = Sanction::find($id);
        if (is_null($sanction)) {
            return response()->json([
                'message' => 'sanction Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'sanction Trouvee',
            'data' => $sanction
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'motif'=> 'required|unique:sanctions',
            'dateSanction' => 'required',
            'montantSanction' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $sanction = Sanction :: create($req->all());
        return response()->json([
            'message' => 'sanction Ajoutee avec Success',
            'data' => $sanction

        ],201);
    }

    public function update(Request $req, $id) {
        $sanction = Sanction::find($id);
        if (is_null($sanction)) {
            return response()->json([
                'message' => 'sanction Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'motif'=> 'required|unique:sanctions',
            'dateSanction' => 'required',
            'montantSanction' =>'required',
            'user_id' =>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $sanction -> update($req->all());
        return response()->json([
            'message' => 'sanction d\'identifiant '. $id . ' modifie',
            'data' => $sanction]);
        }

        public function destroy($id){
            $sanction = sanction::find($id);
            if (is_null($sanction)) {
                return response()->json([
                    'message'=>'sanction introuvable'
                ],404);
            }
            $copiesanction = $sanction;
            $sanction->delete();
            return response()->json([
                'message'=>'sanction d\'indentifiant '.$id.' supprimee',
                'data'=>$copiesanction
            ]);
        }

        public function getsanctionsByUserId($userId){
            $sanctionsOwnerUser = Sanction::all()->where('user_id',$userId);
            return response()->json([
                'message'=>'sanctions de l\'user d\'id '. $userId,
                'data'=>$sanctionsOwnerUser
            ]);
        }
}
