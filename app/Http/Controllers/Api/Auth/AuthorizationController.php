<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller{

      public function login(Request $request){
            $credentials = request(['phone','password']);

            if(!Auth::attempt($credentials)){
                  return response()->json([
                        'message'=>'Неверный номер телефона или пароль'
                  ], 403);
            }
            
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
        
            if ($request->remember_me)
                  $token->expires_at = Carbon::now()->addWeeks(1);
            
            $token->save();
            
            return response()->json([
                  'access_token' => $tokenResult->accessToken,
                  'token_type' => 'Bearer',
                  'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ]);
      }

      public function registration(Request $request){
            
            $request->validate([
                  'phone' => 'required|string|unique:users',
                  'password' => 'required|string'
            ]);

            $user = new User([
                  'phone' => $request->phone,
                  'password' => bcrypt($request->password)
            ]);

            $user->save();

              
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                  'access_token' => $tokenResult->accessToken,
                  'message' => 'Пользователь успешно зарегистрирован'
            ], 201);
      }

      public function logout(Request $request){
            
            $request->user()->token()->revoke();

            return response()->json([
                'message' => 'Successfully logged out'
            ]);
      }

}