<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cotisation;

class CotisationController extends Controller
{

    public function index(){
        $Cotisations = Cotisation::all();
        return response()->json([
            'message' => 'Liste des Cotisations',
            'data'=> $Cotisations
        ],200);
    }

    public function show($id){
        $Cotisation = Cotisation::find($id);
        if (is_null($Cotisation)) {
            return response()->json([
                'message' => 'Cotisation Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Cotisation Trouvee',
            'data' => $Cotisation
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'intitule'=> 'required|unique:Cotisations',
            'motif' => 'required',
            'montant' =>'required',
            'modePaiement' =>'required',
            'seance_id'=>'required',
            'membre_id'=>'required',
            'retard_id'=>'sometimes',
            'echec_id'=>'sometimes',
            'caisse_id'=>'sometimes',

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Cotisation = Cotisation::create($req->all());

        return response()->json([
            'message' => 'Cotisation Ajoutee avec Success',
            'data' => $Cotisation

        ],201);
    }




    public function update(Request $req, $id) {
        $Cotisation = Cotisation::find($id);
        if (is_null($Cotisation)) {
            return response()->json([
                'message' => 'Cotisation Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'intitule'=> 'required|unique:Cotisations',
            'motif' => 'required',
            'montant' =>'required',
            'modePaiement' =>'required',
            'seance_id'=>'required',
            'membre_id'=>'required',
            'retard_id'=>'sometimes',
            'echec_id'=>'sometimes',
            'caisse_id'=>'sometimes',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Cotisation -> update($req->all());
        return response()->json([
            'message' => 'Cotisation d\'identifiant '. $id . ' modifiee',
            'data' => $Cotisation]);
        }

        public function destroy($id){
            $Cotisation = Cotisation::find($id);
            if (is_null($Cotisation)) {
                return response()->json([
                    'message'=>'Cotisation introuvable'
                ],404);
            }
            $copieCotisation = $Cotisation;
            $Cotisation->delete();
            return response()->json([
                'message'=>'Cotisation d\'indentifiant '.$id.' supprimee',
                'data'=>$copieCotisation
            ]);
        }

        public function search(Request $req){
            $Cotisations = [];
            $msg = '';
            if($req->seance_id){
                $Cotisations = Cotisation::where('seance_id', $req->seance_id)->get();
                $msg = 'Cotisations de la seance '.$req->seance_id;
            }
            if($req->membre_id){
                $Cotisations = Cotisation::where('membre_id', $req->membre_id)->get();
                $msg = 'Cotisations du membre'.$req->membre_id;
            }
            if($req->caisse_id){
                $Cotisations = Cotisation::where('caisse_id', $req->caisse_id)->get();
                $msg = 'Caisse'.$req->caisse_id;
            }
            if($req->seance_id and $req->membre_id){
                $Cotisations = Cotisation::where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->get();
                $msg = 'Cotisations de la seance  '.$req->seance_id .
                ' pour le membre '.$req->membre_id;
            }
            if($req->seance_id and $req->membre_id and $req->retard_id){
                $Cotisations = Cotisation::where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->where('retard_id', $req->retard_id)
                ->get();
                $msg = ' seance  '.$req->seance_id .
                ' membre '.$req->membre_id.' retard '.
                $req->retard_id;
            }
            if($req->seance_id and $req->membre_id and $req->echec_id){
                $Cotisations = Cotisation::where('seance_id', $req->seance_id)
                ->where('membre_id', $req->membre_id)
                ->where('echec_id', $req->echec_id)
                ->get();
                $msg = ' seance  '.$req->seance_id .
                ' membre '.$req->membre_id.' retard '.
                $req->echec_id;
            }

            return response()->json([
                'message'=>$msg,
                'data'=>$Cotisations
            ]);
        }
}
