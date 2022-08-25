<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //   ]);

    //   if($validator->fails()) {

    //       return response()->json(['error'=>$validator->errors()], 401);
    //    }
    //     // $request->validate([
    //     //     'email' => 'required|string|email',
    //     //     'password' => 'required|string',
    //     // ]);
    //     $credentials = $request->only('email', 'password');

    //     $token = Auth::attempt($credentials);
    //     if (!$token) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Unauthorized',
    //         ], 401);
    //     }

    //     $user = Auth::user();
    //     // return response()->json($token);

    //     return response()->json([
    //             'status' => 'success',
    //             'user' => $user,
    //             'authorisation' => [
    //                 'token' => $token,
    //                 'type' => 'bearer',
    //             ]
    //         ]);

    // }

    // public function register(Request $request){

    //     $validator = Validator::make($request->all(),[
    //         'nom' => 'required|string|max:255',
    //         'prenom' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //         'telephone' => 'required|string|max:255',
    //         'addresse'=>'required|string',
    //         'ville'=>'required|string',
    //         'pays'=>'required|string',
    //         'numCni'=>'required|string'
    //   ]);

    //   if($validator->fails()) {

    //       return response()->json(['error'=>$validator->errors()], 401);
    //    }
    //     // $request->validate([
    //     //     'nom' => 'required|string|max:255',
    //     //     'prenom' => 'required|string|max:255',
    //     //     'email' => 'required|string|email|max:255|unique:users',
    //     //     'password' => 'required|string|min:6',
    //     //     'telephone' => 'required|string|max:255',
    //     //     'addresse'=>'required|string',
    //     //     'ville'=>'required|string',
    //     //     'pays'=>'required|string',
    //     //     'numCni'=>'required|string'
    //     // ]);

    //     $user = User::create([
    //         'nom' => $request->nom,
    //         'prenom' => $request->prenom,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'telephone' => $request->telephone,
    //         'addresse'=>$request->addresse,
    //         'ville'=>$request->ville,
    //         'pays'=>$request->pays,
    //         'numCni'=>$request->numCni

    //     ]);

    //     $token = Auth::login($user);
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'User created successfully',
    //         'user' => $user,
    //         'authorisation' => [
    //             'token' => $token,
    //             'type' => 'bearer',
    //         ]
    //     ]);
    // }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request){
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'telephone' => 'required|string|max:255',
                'addresse'=>'required|string',
                'ville'=>'required|string',
                'pays'=>'required|string',
                'numCni'=>'required|string'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'addresse'=>$request->addresse,
                'ville'=>$request->ville,
                'pays'=>$request->pays,
                'numCni'=>$request->numCni
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


     /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // {
    //     Auth::user()->tokens->each(function($token){             $token->delete();             });             return response()->json([                 'message'=>'logout successfully'             ],200);
    // }
}


