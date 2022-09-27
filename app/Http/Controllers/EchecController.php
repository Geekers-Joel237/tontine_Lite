<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Echec;

class EchecController extends Controller
{
    public function index(){
        $Echecs = Echec::all();
        return response()->json([
            'message' => 'Liste des Echecs',
            'data'=> $Echecs
        ],200);
    }

    public function show($id){
        $Echec = Echec::find($id);
        if (is_null($Echec)) {
            return response()->json([
                'message' => 'Echec Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Echec Trouvee',
            'data' => $Echec
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'seance_id' =>'required',
            'exercice_id' =>'required',
            'membre_id'=>'required',
            'tontine_id' =>'required',


        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Echec = Echec::create($req->all());

        return response()->json([
            'message' => 'Echec Ajoutee avec Success',
            'data' => $Echec

        ],201);
    }




    public function update(Request $req, $id) {
        $Echec = Echec::find($id);
        if (is_null($Echec)) {
            return response()->json([
                'message' => 'Echec Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'seance_id' =>'required',
            'exercice_id' =>'required',
            'membre_id'=>'required',
            'tontine_id' =>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Echec -> update($req->all());
        return response()->json([
            'message' => 'Echec d\'identifiant '. $id . ' modifiee',
            'data' => $Echec]);
        }

        public function destroy($id){
            $Echec = Echec::find($id);
            if (is_null($Echec)) {
                return response()->json([
                    'message'=>'Echec introuvable'
                ],404);
            }
            $copieEchec = $Echec;
            $Echec->delete();
            return response()->json([
                'message'=>'Echec d\'indentifiant '.$id.' supprimee',
                'data'=>$copieEchec
            ]);
        }

        public function search(Request $req){
            $Echecs = [];
            $msg = '';

            if($req->exercice_id){
                $Echecs = Echec::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Echecs de l\'exercice '.$req->exercice_id;
            }
            if($req->membre_id){
                $Echecs = Echec::where('membre_id', $req->membre_id)->get();
                $msg = 'Echecs du membre'.$req->membre_id;
            }
            if($req->seance_id){
                $Echecs = Echec::where('seance_id', $req->seance_id)->get();
                $msg = 'Caisse'.$req->seance_id;
            }
            if($req->exercice_id and $req->membre_id){
                $Echecs = Echec::where('exercice_id', $req->exercice_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Echecs de l\'exercice  '.$req->exercice_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->seance_id and $req->membre_id){
                $Echecs = Echec::where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Echecs de la seance  '.$req->seance_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->exercice_id and $req->seance_id and $req->membre_id){
                $Echecs = Echec::where('exercice_id', $req->exercice_id)
                ->where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = ' exerxice  '.$req->exercice_id .
                ' seance '.$req->seance_id.' membre '.
                $req->membre_id;
            }


            return response()->json([
                'message'=>$msg,
                'data'=>$Echecs
            ]);
        }
}
