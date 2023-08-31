<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class pageController extends Controller
{
    public function users () {
        
        return User::all();;
    }
    public function login(Request $request) {
        $inputs = $request->all();
        $validator = Validator::make($input,[
            "email"=>"required|email",
            "password"=>"required",
        ]);
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => "Erreur de validation",
                "errors" => $validator->errors(),
            ], 422,);
        }
        if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                "status" => false,
                "message" => "Email ou mot de passe incorrect",
                "errors" => $validator->errors(),
            ], 401,); 
        }
        $user = User::where('email', $request->email)->first();
        return response()->json([
            "status" => true,
            "message" => "Utilisateur connecté avec succès",
            "data" => [
                "token" => $user->createToken('auth_user')->plainTextToken,
                "token_type"=>"Bearer",
            ],
        ]); 
    }
    public function register(Request $request) {
        $inputs = $request->all();
        $validator = Validator::make($input,[
            "name"=>"required",
            "phone"=>"required",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|confirmed",
            "password_confirmation"=>"required",
        ]);
        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => "Erreur de validation",
                "errors" => $validator->errors(),
            ], 422,);
        }
        $inputs['password']=Hash::make($request->password);
        $user = User::create($input);
        return response()->json([
            "status" => true,
            "message" => "Utilisateur créé avec succès",
            // "data" => [
            //     "token" => $user->createToken('auth_user')->plainTextToken,
            //     "token_type"=>"Bearer",
            // ],
        ]); 
    }
    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return response()->json([
            "status" => false,
            "message" => "Déconnexion reussie",
        ]);
    }
    public function profile(Request $request){

    }
}
