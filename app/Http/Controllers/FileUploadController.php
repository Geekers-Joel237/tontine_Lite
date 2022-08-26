<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichier;
// use Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class FileUploadController extends Controller
{


    public function fileUpload1(Request $req){
        $req->validate([
            'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
            'user_id'=>'sometimes',
            'evenement_id'=>'sometimes',
            'rapport_id'=>'sometimes'
        ]);
        $fileModel = new Fichier;
        if($req->file()) {

            $fileName = time().'_'.$req->file->getClientOriginalName();
            $extension = $req->file->getClientOriginalExtension();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->nomFichier = $fileName;
            $fileModel->filePath = '/storage/' . $filePath;
            $fileModel->extension = $extension;

            if($req->user_id)   $fileModel->user_id = $req->user_id;
            if($req->rapport_id)   $fileModel->rapport_id = $req->rapport_id;
            if($req->evenement_id)   $fileModel->evenement_id = $req->evenement_id;

            $fileModel->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $fileName,
            ]);

        }
   }

   public function fileUpload(Request $req){
    $req->validate([
      'files' => 'required',
      'files.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,doc,docx,pdf|max:2048'
    ]);
     if($req->hasfile('files')) {
         foreach($req->file('files') as $file)
         {

            $fileName = time().'_'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModal = new Fichier();
            $fileModal->nomFichier = json_encode($fileName);
            $fileModal->filePath = json_encode($filePath);
            $fileModal->extension = json_encode($extension);

            if(isset($req->rapport_id) && !isset($req->user_id) && !isset($req->event_id)){
                $fileModal->rapport_id = $req->rapport_id;
            }else if(isset($req->user_id) && !isset($req->event_id) && !isset($req->rapport_id)){
                $fileModal->user_id = $req->user_id;

            }else if (isset($req->event_id) && !isset($req->rapport_id) && !isset($req->user_id)){
                $fileModal->evenement_id = $req->event_id;

            }

            $fileModal->save();
        }




        return response()->json([
            "success" => true,
            "message" => "File successfully uploaded",
            "file" => $req->files,
        ]);

    }
  }




  public function getDocumentsByCustomId(Request $req){
    $req->validate([
        'user_id'=>'sometimes',
        'event_id'=>'sometimes',
        'rapport_id'=>'sometimes'
    ]);
    $data = [];
    $message = '';
    if(isset($req->rapport_id) && !isset($req->user_id) && !isset($req->event_id)){
        $message = 'Liste des documents du rapport d\'id '.$req->rapport_id;
        $data = Fichier::all()->where('rapport_id',$req->rapport_id);
    }else if(isset($req->user_id) && !isset($req->event_id) && !isset($req->rapport_id)){
        $message = 'Liste des images cni du user d\'id '.$req->user_id;
        $data = Fichier::all()->where('user_id',$req->user_id);
    }else if (isset($req->event_id) && !isset($req->rapport_id) && !isset($req->user_id)){
        $message = 'Liste des images de l\'evenement d\'id '.$req->event_id;
        $data = Fichier::all()->where('evenement_id',$req->event_id);
    }
    return response()->json($data);
  }

  public function deleteFile($id){
    $files=Fichier::findOrFail($id);
    if (File::exists(public_path("storage/uploads/".$files->nomFichier))) {
       File::delete(public_path("storage/uploads/".$files->nomFichier));
       Fichier::find($id)->delete();
       return response()->json('ok');
   }else{
    return response()->json('not found');

   }

}

public function updateFile($id,Request $req){
    $req->validate([
        'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
        'user_id'=>'sometimes',
        'evenement_id'=>'sometimes',
        'rapport_id'=>'sometimes'
    ]);
    $files=Fichier::findOrFail($id);
    if (File::exists("storage/uploads/".$files->nomFichier)) {
       File::delete("storage/uploads/".$files->nomFichier);

          Fichier::find($id)->delete();


       $fileModel = new Fichier;
       if($req->file()) {
           $fileName = time().'_'.$req->file->getClientOriginalName();
           $extension = $req->file->getClientOriginalExtension();
           $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
           $fileModel->nomFichier = time().'_'.$req->file->getClientOriginalName();
           $fileModel->filePath = '/storage/' . $filePath;
           $fileModel->extension = $extension;

           if($req->user_id)   $fileModel->user_id = $req->user_id;
           if($req->rapport_id)   $fileModel->rapport_id = $req->rapport_id;
           if($req->evenement_id)   $fileModel->evenement_id = $req->evenement_id;

           $fileModel->save();

           return response()->json([
               "success" => true,
               "message" => "File successfully uploaded",
               "file" => $fileName,
           ]);
   }else{
    return response()->json([
        "success" => false,
        "message" => "File required",
        "file" => 'null',
    ],404);
   }
}else{
    return response()->json([
        "success" => false,
        "message" => "File not found",
        "file" => 'null',
    ]);
}



}


}
