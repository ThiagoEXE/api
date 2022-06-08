<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller{

        //Registrar um novo usuário
         public function register(Request $request){

         $request->validate([
         'name' => 'required|string',
         'email' => 'required|string|unique:users,email',
         'password' => 'required|string|confirmed' // confirmed para validar a senha duas vezes

         ]);


         $user = User::create([

         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password) //$bcrypt() para criptografar a senha

         ]);

         //gereando o token de acesso
         $token = $user->createToken('primeirotoken')->plainTextToken;

         $response = [
            'user' => $user,
            'token' => $token
         ];

         return response($response, 201);
    }
        //Login do usuário

        public function login(Request $request){

            $request->validate([
              'name' => 'required|string',
              'email' => 'required|string|unique:users,email',
              )];

        }
}
