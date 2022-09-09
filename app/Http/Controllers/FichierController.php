<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class FichierController extends Controller
{
    //
    public function upload(Request $req){
        $req->validate([
            'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
            'user_id'=>'sometimes',
            'tontine_id'=>'sometimes',
        ]);
        $reglements = ['doc','docx','pdf','txt','csv'];
        $images = ['png','jpg','jpeg'];
        $fileModel = new Fichier;
        if($req->file()) {

            $fileName = time().'_'.$req->file->getClientOriginalName();
            $extension = $req->file->getClientOriginalExtension();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->fileName = $fileName;
            $fileModel->filePath = '/storage/' . $filePath;
            $fileModel->extension = $extension;

            if(in_array($fileModel->extension,$reglements)){
                $fileModel->type = 'reglement';
            }else if(in_array($fileModel->extention,$images)){
                $fileModel->type = 'image';
            }
            if($req->user_id)   $fileModel->user_id = $req->user_id;
            if($req->tontine_id)   $fileModel->tontine_id = $req->tontine_id;

            $fileModel->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $fileModel,
            ]);

        }
   }

   public function fileUpload(Request $req){
    $req->validate([
      'files' => 'required',
      'files.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,doc,docx,pdf|max:2048'
    ]);
    $reglements = ['doc','docx','pdf','txt','csv'];
        $images = ['png','jpg','jpeg'];
     if($req->hasfile('files')) {
         foreach($req->file('files') as $file)
         {

            $fileName = time().'_'.$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModal = new Fichier();
            $fileModal->fileName = json_encode($fileName);
            $fileModal->filePath = json_encode($filePath);
            $fileModal->extension = json_encode($extension);

            if(in_array($extension,$reglements)){
                $fileModal->type = 'reglement';
            }else if(in_array($extension,$images)){
                $fileModal->type = 'image';
            }

            if(isset($req->user_id)){
                $fileModal->user_id = $req->user_id;
            }else if(isset($req->tontine_id)){
                $fileModal->tontine_id = $req->tontine_id;

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
        'tontine_id'=>'sometimes',
    ]);
    $data = [];
    $message = '';
    if(isset($req->user_id) && !isset($req->tontine_id) ){
        $message = 'Liste des images cni du user d\'id '.$req->user_id;
        $data = Fichier::where('user_id',$req->user_id)->get();
    }else if (isset($req->tontine_id)  && !isset($req->user_id)){
        $message = 'Liste des fichiers de la tontine d\'id '.$req->tontine_id;
        $data = Fichier::where('tontine_id',$req->tontine_id)->get();
    }
    return response()->json($data);
  }

  public function deleteFile($id){
    $files=Fichier::findOrFail($id);
    if (File::exists(public_path("storage/uploads/".$files->fileName))) {
       File::delete(public_path("storage/uploads/".$files->fileName));
       Fichier::find($id)->delete();
       return response()->json('file deleted');
   }else{
    return response()->json('not found');

   }

}

public function updateFile($id,Request $req){
    $req->validate([
        'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg|max:2048',
        'user_id'=>'sometimes',
        'tontine_id'=>'sometimes'
    ]);
    $files=Fichier::findOrFail($id);
    if (File::exists("storage/uploads/".$files->fileName)) {
       File::delete("storage/uploads/".$files->fileName);

          Fichier::find($id)->delete();


       $fileModel = new Fichier;
       $reglements = ['doc','docx','pdf','txt','csv'];
        $images = ['png','jpg','jpeg'];
       if($req->file()) {
           $fileName = time().'_'.$req->file->getClientOriginalName();
           $extension = $req->file->getClientOriginalExtension();
           $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
           $fileModel->fileName = time().'_'.$req->file->getClientOriginalName();
           $fileModel->filePath = '/storage/' . $filePath;
           $fileModel->extension = $extension;

           if($req->user_id)   $fileModel->user_id = $req->user_id;
           if($req->tontine_id)   $fileModel->tontine_id = $req->tontine_id;

           if(in_array($extension,$reglements)){
            $fileModel->type = 'reglement';
        }else if(in_array($extension,$images)){
            $fileModel->type = 'image';
        }
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
