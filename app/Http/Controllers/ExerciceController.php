<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Exercice;
use Illuminate\Support\Facades\DB;


class ExerciceController extends Controller
{
    public function index(){
        $Exercices = Exercice::all();
        return response()->json([
            'message' => 'Liste des Exercices',
            'data'=> $Exercices
        ],200);
    }

    public function show($id){
        $Exercice = Exercice::find($id);
        if (is_null($Exercice)) {
            return response()->json([
                'message' => 'Exercice Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Exercice Trouvee',
            'data' => $Exercice
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            // 'nomE'=> 'required|unique:Exercices',
            'frequence' => 'required',
            'dateDebutE' =>'required',
            'duree' =>'required',
            'periodicite'=>'required',
            'lieuTontine'=>'required',
            'heureTontine' =>'required',
            'tontine_id'=>'required',
            'nbreBenef'=>'required'
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }



        $Exercice = Exercice::create($req->all());

        return response()->json([
            'message' => 'Exercice Ajoutee avec Success',
            'data' => $Exercice

        ],201);
    }




    public function update(Request $req, $id) {
        $Exercice = Exercice::find($id);
        if (is_null($Exercice)) {
            return response()->json([
                'message' => 'Exercice Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            // 'nomE'=> 'required|unique:Exercices',
            // 'frequence' => 'required',
            // 'dateDebutE' =>'required',
            // 'duree' =>'required',
            // 'lieuTontine'=>'required',
            // 'periodicite'=>'required',
            // 'heureTontine' =>'required',
            // 'tontine_id'=>'required',
            // 'nbreBenef'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $Exercice -> update($req->all());
        return response()->json([
            'message' => 'Exercice d\'identifiant '. $id . ' modifiee',
            'data' => $Exercice]);
        }

        public function destroy($id){
            $exercice = Exercice::find($id);
            if (is_null($exercice)) {
                return response()->json([
                    'message'=>'Exercice introuvable'
                ],404);
            }
            $copieExercice = $exercice;
            $exercice->delete();
            return response()->json([
                'message'=>'Exercice d\'indentifiant '.$id.' supprimee',
                'data'=>$copieExercice
            ]);
        }

        public function search(Request $req){
            $Exercices = [];
            $msg = '';
            if($req->tontine_id){
                $Exercices = Exercice::where('tontine_id', $req->tontine_id)->get();
                $msg = 'Exercices de la tontine '.$req->tontine_id;
            }
            return response()->json([
                'message'=>$msg,
                'data'=>$Exercices
            ]);
        }


        public function allExercicesInfo($id){
            $exercice = Exercice::find($id);
            if (is_null($exercice)) {
                return response()->json([
                    'message' => 'exercice Introuvable'
                ],404);
            }

            $exercice -> cotisations = DB::table('cotisations')
            ->join('membres','membres.id','=','cotisations.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('cotisations.exercice_id',$id)
            ->select('cotisations.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> retards = DB::table('retards')
            ->join('membres','membres.id','=','retards.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('retards.exercice_id',$id)
            ->select('retards.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> retardsNonPayes = DB::table('retards')
            ->join('membres','membres.id','=','retards.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('retards.exercice_id',$id)
            ->where('retards.statut','0')
            ->select('retards.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> retardsPayes = DB::table('retards')
            ->join('membres','membres.id','=','retards.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('retards.exercice_id',$id)
            ->where('retards.statut','1')
            ->select('retards.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> echecs = DB::table('echecs')
            ->join('membres','membres.id','=','echecs.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('echecs.exercice_id',$id)
            ->select('echecs.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> echecsNonPayes = DB::table('echecs')
            ->join('membres','membres.id','=','echecs.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('echecs.exercice_id',$id)
            ->where('echecs.statut','0')
            ->select('echecs.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> echecsPayes = DB::table('echecs')
            ->join('membres','membres.id','=','echecs.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('echecs.exercice_id',$id)
            ->where('echecs.statut','1')
            ->select('echecs.*','membres.*','users.nom','users.prenom')
            ->get();
            $exercice -> seances = DB::table('seances')
            ->where('exercice_id',$id)
            ->get();
            $exercice->membres = DB::table('membres')
            ->join('users','users.id','=','membres.user_id')
            ->where('exercice_id', $id)
            ->select('membres.*','users.nom','users.prenom')
            ->get();

            return response()->json(
                ['data'=>$exercice]
            );

        }
}
