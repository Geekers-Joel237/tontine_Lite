<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Dette;

class DetteController extends Controller
{
    public function index(){
        $Dettes = Dette::all();
        return response()->json([
            'message' => 'Liste des Dettes',
            'data'=> $Dettes
        ],200);
    }

    public function show($id){
        $Dette = Dette::find($id);
        if (is_null($Dette)) {
            return response()->json([
                'message' => 'Dette Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Dette Trouvee',
            'data' => $Dette
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'montant'=> 'required',
            'modePaiement' => 'required',
            'tontine_id' =>'required',
            'exercice_id' =>'required',
            'membre_id'=>'required',
            'retard_id'=>'sometimes',
            'echec_id'=>'sometimes',
            'caisse_id'=>'sometimes',
            'cotisation_id'=>'required',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Dette = Dette::create($req->all());

        return response()->json([
            'message' => 'Dette Ajoutee avec Success',
            'data' => $Dette

        ],201);
    }




    public function update(Request $req, $id) {
        $Dette = Dette::find($id);
        if (is_null($Dette)) {
            return response()->json([
                'message' => 'Dette Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'montant'=> 'required',
            'modePaiement' => 'required',
            'tontine_id' =>'required',
            'exercice_id' =>'required',
            'membre_id'=>'required',
            'retard_id'=>'sometimes',
            'echec_id'=>'sometimes',
            'caisse_id'=>'sometimes',
            'cotisation_id'=>'required',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Dette -> update($req->all());
        return response()->json([
            'message' => 'Dette d\'identifiant '. $id . ' modifiee',
            'data' => $Dette]);
        }

        public function destroy($id){
            $Dette = Dette::find($id);
            if (is_null($Dette)) {
                return response()->json([
                    'message'=>'Dette introuvable'
                ],404);
            }
            $copieDette = $Dette;
            $Dette->delete();
            return response()->json([
                'message'=>'Dette d\'indentifiant '.$id.' supprimee',
                'data'=>$copieDette
            ]);
        }

        public function search(Request $req){
            $Dettes = [];
            $msg = '';
            if($req->tontine_id){
                $Dettes = Dette::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Dettes de la tontine '.$req->tontine_id;
            }
            if($req->exercice_id){
                $Dettes = Dette::where('exercice_id', $req->exercice_id)->get();
                $msg = 'Dettes de l\'exercice '.$req->exercice_id;
            }
            if($req->membre_id){
                $Dettes = Dette::where('membre_id', $req->membre_id)->get();
                $msg = 'Dettes du membre'.$req->membre_id;
            }
            if($req->caisse_id){
                $Dettes = Dette::where('caisse_id', $req->caisse_id)->get();
                $msg = 'Caisse'.$req->caisse_id;
            }
            if($req->exercice_id and $req->membre_id){
                $Dettes = Dette::where('exercice_id', $req->exercice_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Dettes de l\'exercice  '.$req->exercice_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->exercice_id and $req->membre_id and $req->retard_id){
                $Dettes = Dette::where('exercice_id', $req->exercice_id)
                ->where('membre_id', $req->membre_id)
                ->where('retard_id', $req->retard_id)
                ->get();
                $msg = ' exercice  '.$req->exercice_id .
                ' membre '.$req->membre_id.' retard '.
                $req->retard_id;
            }
            if($req->exercice_id and $req->membre_id and $req->echec_id){
                $Dettes = Dette::where('exercice_id', $req->exercice_id)
                ->where('membre_id', $req->membre_id)
                ->where('echec_id', $req->echec_id)
                ->get();
                $msg = ' exercice  '.$req->exercice_id .
                ' membre '.$req->membre_id.' echec '.
                $req->echec_id;
            }

            return response()->json([
                'message'=>$msg,
                'data'=>$Dettes
            ]);
        }


}
