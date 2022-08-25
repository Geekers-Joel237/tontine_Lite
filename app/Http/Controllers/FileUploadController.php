<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichier;
// use Validator;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    //
    public function fileUpload(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg',
            'user_id'=>'sometimes',
            'evenement_id'=>'sometimes',
            'rapport_id'=>'sometimes'


      ]);

      if($validator->fails()) {

          return response()->json(['error'=>$validator->errors()], 401);
       }


      if ($files = $request->file('file')) {
        foreach ($files as $file) {
          $path = $file->store('public/images');
          $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

          //store your file into directory and db
          $save = new Fichier();
          $save->nomFichier = $name;
          $save->filePath= $path;
          $save->extension = $extension;
          $save->user_id= intval($request->user_id) ;
          $save->save();
        }
          return response()->json([
              "success" => true,
              "message" => "File successfully uploaded",
              "file" => $files,
            //   "name" => $path,
          ]);


          //   }
    //     $documents = [];
    // if($request->hasFile('file')){
    //     $files = $request->file('file');
    //     // foreach ($variable as $key => $value) {
    //     //     # code...
    //     // }
    //     foreach($files as $file){
    //         // return response()->json($file);
    //         $filename = $file->getClientOriginalName();
    //         $extension = $file->getClientOriginalExtension();
    //         $path = $file->store('public/images');
    //         // $file->move(public_path().'/images/', $name);
    //         $save = new Fichier;
    //         $save->nomFichier = $filename;
    //         $save->extension = $extension;
    //         $save->filePath = $path;
    //         if(isset($user_id)){
    //             $save->userId = $user_id;
    //         }else if(isset($rapport_id)){
    //             $save->rapportId = $rapport_id;
    //         }else if(isset($evenement_id)){
    //             $save->evenementId = $evenement_id;
    //         }
    //         $save-> save();
    //         // $documents [] = $save;

    //     }
        //       return response()->json([
        //       "success" => true,
        //       "message" => "File successfully uploaded",
        //       "files" => $files
        //     //   "name" => $path,
        //   ]);

    }


}


public function store(Request $request)
{

    $validator = Validator::make($request->all(),[
        'files' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,jpeg',
        'user_id'=>'sometimes',
        'evenement_id'=>'sometimes',
        'rapport_id'=>'sometimes'


  ]);

  if($validator->fails()) {

      return response()->json(['error'=>$validator->errors()], 401);
   }

    if($request->hasfile('files'))
     {
        $files = $request->file('files');
        foreach($files as $file){
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->store('public/images');
            $extension =  $file->getClientOriginalExtension();
            $request['nomFichier'] = $filename;
            $request['filePath'] = $path;
            $request[extension] = $extension;
            $file->move(\public_path("images"),$filename);
            Fichier::create($request->all());
        }
     }

     return response()->json([
        "success" => true,
        "message" => "File successfully uploaded",
        "file" => $files,
      //   "name" => $path,
    ]);
  }

  public function getDocumentsByCustomId($user_id,$rapport_id,$event_id){
    $data = [];
    $message = '';
    if(isset($rapport_id) && !isset($user_id) && !isset($event_id)){
        $message = 'Liste des documents du rapport d\'id '.$rapport_id;
        $data = Fichier::all()->where('rapport_id',$rapport_id);
    }else if(isset($user_id) && !isset($event_id) && !isset($rapport_id)){
        $message = 'Liste des images cni du user d\'id '.$user_id;
        $data = Fichier::all()->where('user_id',$user_id);
    }else if (isset($event_id) && !isset($rapport_id) && !isset($user_id)){
        $message = 'Liste des images de l\'evenement d\'id '.$event_id;
        $data = Fichier::all()->where('event_id',$event_id);
    }
    return response()->json($data);
  }



}


