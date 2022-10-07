<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tontine;
use Illuminate\Support\Facades\DB;

class TontineController extends Controller
{

    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
        }

        return $token;
    }


    public function index(){
        $tontines = DB::table('tontines')->latest()->get();
        foreach($tontines as $key => $value){
            $value->membres = DB::table('membres')
            ->where('membres.tontine_id',$value->id)
                ->get();
                $value->exercices = DB::table('exercices')
            ->where('exercices.tontine_id',$value->id)
                ->get();
        }
        return response()->json([
            'message' => 'Liste des tontines',
            'data'=> $tontines
        ],200);
    }

    public function show($id){
        $tontine = Tontine::find($id);
        if (is_null($tontine)) {
            return response()->json([
                'message' => 'Tontine Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'Tontine Trouvee',
            'data' => $tontine
        ]);
    }


    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'nomT'=> 'required',
            'montantT' => 'required',
            'slogan' =>'required',
            'reglement' =>'sometimes',
            'maxT' =>'required',
            'retard'=>'required',
            'sanction'=>'required',
            'echec'=>'required',
            'type'=>'required',
            'user_id'=>'required'

        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }

        if ($req->type == 'Fermee') {
            $req->codeAdhesion = $this->getToken(10);
            $req->validation = null;
        }else{
            $req->codeAdhesion = null;
            $req->validation = false;
        }

        $tontine = new Tontine;
        $tontine->nomT = $req->nomT;
        $tontine->montantT = $req->montantT;
        $tontine->slogan = $req->slogan;
        $tontine->reglement = $req->reglement;
        $tontine->maxT = $req->maxT;
        $tontine->retard = $req->retard;
        $tontine->sanction = $req->sanction;
        $tontine->echec = $req->echec;
        $tontine->type = $req->type;
        $tontine->codeAdhesion = $req->codeAdhesion;
        $tontine->validation = $req->validation;
        $tontine->user_id = $req->user_id;

        $tontine->save();
        return response()->json([
            'message' => 'tontine Ajoutee avec Success',
            'data' => $tontine

        ],201);
    }




    public function update(Request $req, $id) {
        $tontine = Tontine::find($id);
        if (is_null($tontine)) {
            return response()->json([
                'message' => 'tontine Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'nomT'=> 'required',
            'montantT' => 'required',
            'slogan' =>'required',
            'reglement' =>'sometimes',
            'maxT' =>'required',
            'retard'=>'required',
            'sanction'=>'required',
            'echec'=>'required',
            'type'=>'required',
            // 'user_id'=>'required',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $tontine -> update($req->all());
        return response()->json([
            'message' => 'tontine d\'identifiant '. $id . ' modifiee',
            'data' => $tontine]);
        }

        public function destroy($id){
            $tontine = Tontine::find($id);
            if (is_null($tontine)) {
                return response()->json([
                    'message'=>'tontine introuvable'
                ],404);
            }
            $copietontine = $tontine;
            $tontine->delete();
            return response()->json([
                'message'=>'tontine d\'indentifiant '.$id.' supprimee',
                'data'=>$copietontine
            ]);
        }

        public function search(Request $req){
            $tontines = [];
            $msg = '';
            if($req->user_id and !$req->type ){
                $tontines = Tontine::where('user_id', $req->user_id)->get();
                foreach ($tontines as $key => $value) {
                    $value->demandes = DB::table('demandes')
                    ->join('users','users.id','=','demandes.user_id')
                    ->where('demandes.tontine_id',$value->id)
                    ->where('demandes.validation','0')
                    ->select('demandes.*','users.nom','users.prenom','users.id as idutilisateurs')
                    ->get();
                }
                $msg = 'tontine de l\'user '.$req->user_id;
            }else if($req->type and !$req->user_id){
                $tontines = Tontine::where('type', $req->type)->get();
                $msg = 'tontine de type '.$req->type;

            }else if($req->user_id and $req->type){
                $tontines = Tontine::where('user_id', $req->user_id)->where('type', $req->type)->get();
                foreach ($tontines as $key => $value) {
                    $value->demandes = DB::table('demandes')
                    ->join('users','users.id','=','demandes.user_id')
                    ->where('demandes.tontine_id',$value->id)
                    ->where('demandes.validation','0')
                    ->select('demandes.*','users.nom','users.prenom','users.id as idutilisateurs')
                    ->get();
                }
                $msg = 'tontine de type '.$req->type.' l\'user '.$req->user_id;
            }

            // $tontines = Tontine::where('user_id', $req->user_id)->where('type', $req->type)->get();
            //     foreach ($tontines as $key => $value) {
            //         $value->demandes = DB::table('demandes')
            //         ->join('users','users.id','=','demandes.user_id')
            //         ->where('demandes.tontine_id',$value->id)
            //         ->select('demandes.*','users.nom','users.prenom','users.id as idutilisateurs')
            //         ->get();
            //     }

            return response()->json([
                'message'=>$msg,
                'data'=>$tontines
            ]);
        }

        public function allTontinesInfo($id){
            $tontine = Tontine::find($id);
            if (is_null($tontine)) {
                return response()->json([
                    'message' => 'tontine Introuvable'
                ],404);
            }
            $tontine->exercices = DB::table('exercices')
            ->join('membres','membres.exercice_id','exercices.id')
            ->join('users','users.id','membres.user_id')
            ->where('exercices.tontine_id', $id)
            ->select('membres.*','exercices.*','users.nom','users.prenom','users.id as idutilisateurs')
            ->paginate(5);
            // ->get();
            $tontine->exercicesAll = DB::table('exercices')
            ->join('membres','membres.exercice_id','exercices.id')
            ->join('users','users.id','membres.user_id')
            ->where('exercices.tontine_id', $id)
            ->select('membres.*','exercices.*','users.nom','users.prenom','users.id as idutilisateurs')
            ->get();
            $tontine->membres = DB::table('membres')
            ->join('users','users.id','=','membres.user_id')
            ->where('tontine_id', $id)
            ->select('membres.*','users.nom','users.prenom')
            ->get();
            $tontine -> demandes = DB::table('demandes')
            ->join('users','users.id','=','demandes.user_id')
            ->where('demandes.tontine_id',$id)
            ->where('demandes.validation','0')
            ->select('demandes.*','users.nom','users.prenom','users.id as idutilisateurs')
            ->get();
            $tontine -> retards = DB::table('retards')
            ->join('membres','membres.id','=','retards.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('retards.tontine_id',$id)
            ->select('retards.*','membres.*','users.nom','users.prenom')
            ->get();
            $tontine -> echecs = DB::table('echecs')
            ->join('membres','membres.id','=','echecs.membre_id')
            ->join('users','users.id','=','membres.user_id')
            ->where('echecs.tontine_id',$id)
            ->select('echecs.*','membres.*','users.nom','users.prenom')
            ->get();
            $tontine -> cotisations = DB::table('cotisations')
                ->join('membres','membres.id','=','cotisations.membre_id')
                ->join('users','users.id','=','membres.user_id')
                ->where('cotisations.tontine_id',$id)
                ->select('cotisations.*','membres.*','users.nom','users.prenom')
                ->get();


            return response()->json([
                'data'=>$tontine]
            );
        }

        public function filter(Request $req){
            $tontines = [];
            if(is_null($req->fermee)){
                if($req->ouverte || $req->membreMax || $req->montantMax ){
                    $tontines = Tontine::where('type','Ouverte')
                        ->where('maxT','<',$req->membreMax)
                        ->where('montantT','<',$req->montantMax)
                        ->get();
                }
            }else if(is_null($req->ouverte)){
                $tontines = Tontine::where('type','Fermee')
                    ->where('maxT','<',$req->membreMax)
                    ->where('montantT','<',$req->montantMax)
                    ->get();
            }
             else {
                $tontines = Tontine::where('maxT','<',$req->membreMax)
                    ->where('montantT','<',$req->montantMax)
                    ->get();
            }
            return response()->json([
                'data'=>$tontines]
            );
        }

}
