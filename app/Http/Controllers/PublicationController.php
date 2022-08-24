<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Publication;
use App\Http\Controllers\EvenementController;
use App\Models\Evenement;
use App\Models\Annonce;


class PublicationController extends Controller
{
    public function index(){
        $publications = Publication::all();
        return response()->json([
            'message' => 'Liste des publications',
            'data'=> $publications
        ],200);
    }

    public function show($id){
        $publication = Publication::find($id);
        if (is_null($publication)) {
            return response()->json([
                'message' => 'publication Introuvable'
            ],404);
        }
        return response()->json([
            'message' => 'publication Trouvee',
            'data' => $publication
        ]);
    }

    public function store(Request $req){
        $validated = Validator::make($req->all(),[
            'user_id'=> 'required',
            'reunion_id'=> 'required',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $evenement = Publication :: create($req->all());
        return response()->json([
            'message' => 'publication Ajoutee avec Success',
            'data' => $evenement

        ],201);
    }

    public function getEventsByUserId($userId){
        $userpubs = [];
        $userEventsId = [];
        $userEvents = [];
        $userpubs = Publication::all()->where('user_id',$userId);
        foreach ($userpubs as $userEvent => $value) {
            $userEventsId[] = $value->evenement_id;
        }
        foreach ($userEventsId as $userEventId) {
            if(is_null($userEventId)){

            }else{
                $event = Evenement::find($userEventId);
                if(!is_null($event)){
                    $userEvents[] = $event;
                }
            }
        }
        return response()->json([
            'message' => 'Liste des evenements de l\'user d\'id '.$userId,
            'data' => $userEvents
        ]);
    }


    public function getAnnoncesByUserId($userId){
        $userpubs = [];
        $userAnnoncesId = [];
        $userAnnonces = [];
        $userpubs = Publication::all()->where('user_id',$userId);
        foreach ($userpubs as $userAnnonce => $value) {
            $userAnnoncesId[] = $value->annonce_id;
        }
        foreach ($userAnnoncesId as $userAnnonceId) {
            if(is_null($userAnnonceId)){

            }else{
                $annonce = Annonce::find($userAnnonceId);
                if(!is_null($annonce)){
                    $userAnnonces[] = $annonce;
                }
            }
        }
        return response()->json([
            'message' =>'Liste des annonces de l\'user d\'id '.$userId,
            'data'=> $userAnnonces
        ]);
    }

    public function getAnnoncesByReunionId($reunionId){
        $userpubs = [];
        $userAnnoncesId = [];
        $userAnnonces = [];
        $userpubs = Publication::all()->where('reunion_id',$reunionId);
        foreach ($userpubs as $userAnnonce => $value) {
            $userAnnoncesId[] = $value->annonce_id;
        }
        foreach ($userAnnoncesId as $userAnnonceId) {
            if(is_null($userAnnonceId)){

            }else{
                $annonce = Annonce::find($userAnnonceId);
                if(!is_null($annonce)){
                    $userAnnonces[] = $annonce;
                }
            }
        }
        return response()->json([
            'message' => "Liste des annonces de la reunion d'id ".$reunionId,
            'data' => $userAnnonces
        ]);
    }

    public function getEventsByReunionId($reunionId){
        $userpubs = [];
        $userEventsId = [];
        $userEvents = [];
        $userpubs = Publication::all()->where('reunion_id',$reunionId);
        foreach ($userpubs as $userEvent => $value) {
            $userEventsId[] = $value->evenement_id;
        }
        $userEventsId = array_unique($userEventsId);
        foreach ($userEventsId as $userEventId) {
            if(is_null($userEventId)){

            }else{
                $event = Evenement::find($userEventId);
                if(!is_null($event)){
                    $userEvents[] = $event;
                }
            }
        }
        return response()->json([
            'message' => 'Liste des evenements de la reunion d\'id '.$reunionId,
            'data' => $userEvents
        ]);
    }

    public function getEventsByUserIdAndReunionId($userId,$reunionId){
        $userpubs = [];
        $userEventsId = [];
        $userEvents = [];
        $userpubs = Publication::all()->where('user_id',$userId)
                                                            ->where('reunion_id',$reunionId);
        foreach ($userpubs as $userEvent => $value) {
            $userEventsId[] = $value->evenement_id;
        }
        foreach ($userEventsId as $userEventId) {
            if(is_null($userEventId)){

            }else{
                $event = Evenement::find($userEventId);
                if(!is_null($event)){
                    $userEvents[] = $event;
                }
            }
        }
        return response()->json([
            'message' => 'Liste des evenements de l\'user d\'id '.$userId.' dans la reunion d\'id '.$reunionId,
            'data' => $userEvents
        ]);
    }

    public function getAnnoncesByUserIdAndReunionId($userId,$reunionId){
        $userpubs = [];
        $userAnnoncesId = [];
        $userAnnonces = [];
        $userpubs = Publication::all()->where('reunion_id',$reunionId)
                                        ->where('user_id',$userId);
        foreach ($userpubs as $userAnnonce => $value) {
            $userAnnoncesId[] = $value->annonce_id;
        }
        foreach ($userAnnoncesId as $userAnnonceId) {
            if(is_null($userAnnonceId)){

            }else{
                $annonce = Annonce::find($userAnnonceId);
                if(!is_null($annonce)){
                    $userAnnonces[] = $annonce;
                }
            }
        }
        return response()->json([
            'message' => "Liste des annonces de la reunion d'id ".$reunionId .' pour l\'user d\'id '.$userId,
            'data' => $userAnnonces
        ]);
    }

    public function update(Request $req, $id) {
        $publication = publication::find($id);
        if (is_null($publication)) {
            return response()->json([
                'message' => 'publication Introuvable'
            ],404);
        }
        $validated = Validator::make($req->all(),[
            'user_id'=> 'required',
            'reunion_id'=> 'required',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(), 400);
        }
        $publication -> update($req->all());
        return response()->json([
            'message' => 'publication d\'identifiant '. $id . ' modifie',
            'data' => $publication]);
        }

        public function destroy($id){
            $publication = publication::find($id);
            if (is_null($publication)) {
                return response()->json([
                    'message'=>'publication introuvable'
                ],404);
            }
            $copiepublication = $publication;
            $publication->delete();
            return response()->json([
                'message'=>'publication d\'indentifiant '.$id.' supprimee',
                'data'=>$copiepublication
            ]);
        }

}
