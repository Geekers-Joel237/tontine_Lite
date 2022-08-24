<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Validator;

class AnnonceController extends Controller
{
    public function index(){
        $Annonces = Annonce::all();
        return response()->json([
            'message' => 'Liste des Annonces',
            'data'=> $Annonces
        ],200);
    }

    public function show($id){
        $Annonce = Annonce::find($id);
        if (is_null($Annonce)) {
            return response()->json([
                'message' => 'Annonce Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Annonce Trouvee',
            'data' => $Annonce
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'titre'=> 'required|unique:annonces',
            'description' => 'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $annonce = Annonce :: create($req->all());
        return response()->json([
            'message' => 'Annonce Ajoutee avec Success',
            'data' => $annonce

        ],201);
    }

    public function update(Request $req, $id) {
        $annonce = Annonce::find($id);
        if (is_null($annonce)) {
            return response()->json([
                'message' => 'Annonce Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'titre'=> 'required|unique:annonces',
            'description' => 'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $annonce -> update($req->all());
        return response()->json([
            'message' => 'Annonce d\'identifiant '. $id . ' modifiee',
            'data' => $annonce]);
        }

        public function destroy($id){
            $annonce = Annonce::find($id);
            if (is_null($annonce)) {
                return response()->json([
                    'message'=>'annonce introuvable'
                ],404);
            }
            $copieAnnonce = $annonce;
            $annonce->delete();
            return response()->json([
                'message'=>'annonce d\'indentifiant '.$id.' supprimee',
                'data'=>$copieAnnonce
            ]);
        }

    }
