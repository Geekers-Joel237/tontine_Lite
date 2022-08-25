<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImagesCNI;
// use Validator;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    //
    public function fileUpload(Request $request){
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:doc,docx,pdf,txt,csv',
            'user_id'=>'required'
      ]);

      if($validator->fails()) {

          return response()->json(['error'=>$validator->errors()], 401);
       }


      if ($file = $request->file('file')) {
          $path = $file->store('public/images');
          $name = $file->getClientOriginalName();

          //store your file into directory and db
          $save = new ImagesCNI();
          $save->nomImage = $file;
          $save->filePath= $path;
          $save->user_id= intval($request->user_id) ;
          $save->save();

          return response()->json([
              "success" => true,
              "message" => "File successfully uploaded",
              "file" => $file
          ]);

      }


  }

   }

