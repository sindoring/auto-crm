<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $accessToken = $this->token($request->user());
        
        return view('layouts.app')->with([
            'accessToken'=>$accessToken,
            'permission'=>$request->user()->permission
        ]);
    }

    private function token(User $user):string
    {
        $resultToken = $user->createToken('Personal Access Token');
        $token = $resultToken->token;
        
        $token->save();
        return $resultToken->accessToken;
    }
}
