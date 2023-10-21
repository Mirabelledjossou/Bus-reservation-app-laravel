<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $data_to_store = [
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ];

        $user = User::create($data_to_store);

        return json_encode(
            ["status" => true],
        );
    }

    public function login(Request $request){
        $user  = User::where('phone', '=', $request->phone)->first();
        if($user){
            if($user->password == Hash($request->password)){
                $token = $user->createToken("user_token");
                return json_encode(
                    [
                        'status' =>true,
                        'token' => $token->plainTextToken
                    ]
                    );
            }else{
                return json_encode(
                    [
                        'status' =>false,
                    ]
                    );
            }
        }else{
            return json_encode(
                [
                    'status' =>false,
                ]
                );
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return json_encode(
            [
                "status" => true,
            ]
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
