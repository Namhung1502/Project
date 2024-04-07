<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\MemberLoginRequest;

class MemberController extends Controller
{
    public function indexLogin(){
        return view('frontend.member.login');
    }
    public function login(Request $request)
    {


        echo 111;
        exit;


        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if($request->remember_me){
            $remember = true;
        }
        if(Auth::attempt($login, $remember)){
            return response()->json([
                    'success' => 'success',
                    'Auth' => Auth::user()
                ]);

        } else {
            return response()->json([
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ]);
        }
    }
}
