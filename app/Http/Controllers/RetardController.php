<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Retard;

class RetardController extends Controller
{
    public function index(){
        $Retards = Retard::all();
        return response()->json([
            'message' => 'Liste des Retards',
            'data'=> $Retards
        ],200);
    }

    public function show($id){
        $Retard = Retard::find($id);
        if (is_null($Retard)) {
            return response()->json([
                'message' => 'Retard Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Retard Trouvee',
            'data' => $Retard
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'seance_id' =>'required',
            'exercice_id' =>'required',
            'membre_id'=>'required',
            'tontine_id' =>'required'


        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Retard = Retard::create($req->all());

        return response()->json([
            'message' => 'Retard Ajoutee avec Success',
            'data' => $Retard

        ],201);
    }




    public function update(Request $req, $id) {
        $Retard = Retard::find($id);
        if (is_null($Retard)) {
            return response()->json([
                'message' => 'Retard Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            // 'seance_id' =>'required',
            // 'exercice_id' =>'required',
            // 'membre_id'=>'required',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Retard -> update($req->all());
        return response()->json([
            'message' => 'Retard d\'identifiant '. $id . ' modifiee',
            'data' => $Retard]);
        }

        public function destroy($id){
            $Retard = Retard::find($id);
            if (is_null($Retard)) {
                return response()->json([
                    'message'=>'Retard introuvable'
                ],404);
            }
            $copieRetard = $Retard;
            $Retard->delete();
            return response()->json([
                'message'=>'Retard d\'indentifiant '.$id.' supprimee',
                'data'=>$copieRetard
            ]);
        }

        public function search(Request $req){
            $Retards = [];
            $msg = '';

            if($req->exercice_id){
                $Retards = Retard::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Retards de l\'exercice '.$req->exercice_id;
            }
            if($req->membre_id){
                $Retards = Retard::where('membre_id', $req->membre_id)->get();
                $msg = 'Retards du membre'.$req->membre_id;
            }
            if($req->seance_id){
                $Retards = Retard::where('seance_id', $req->seance_id)->get();
                $msg = 'Caisse'.$req->seance_id;
            }
            if($req->exercice_id and $req->membre_id){
                $Retards = Retard::where('exercice_id', $req->exercice_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Retards de l\'exercice  '.$req->exercice_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->seance_id and $req->membre_id){
                $Retards = Retard::where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Retards de la seance  '.$req->seance_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->exercice_id and $req->seance_id and $req->membre_id){
                $Retards = Retard::where('exercice_id', $req->exercice_id)
                ->where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = ' exercice  '.$req->exercice_id .
                ' seance '.$req->seance_id.' membre '.
                $req->membre_id;
            }


            return response()->json([
                'message'=>$msg,
                'data'=>$Retards
            ]);
        }
}
