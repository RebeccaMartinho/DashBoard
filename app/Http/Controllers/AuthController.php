<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){


        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return response()->json(['error' => "Esse email ja existe em nossa base dados"], 422);
        }

        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL))
        {
           return response()->json(['error' => "Insira um email valido"], 422);
        }

        if(!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $request->input('password')))
        {
           return response()->json(['error' => "A senha precisa ter letras e números"], 422);
        }

        if(strlen($request->input('password')) < 6)
        {
           return response()->json(['error' => "A senha precisa ter mais de 6 digitos"], 422);
        }


       return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json(['error' => "Email incorreto"], 422);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['error' => "Senha Incorreta"], 422);
        }
    
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success'=> 'true']);
    }
}
