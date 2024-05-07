<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\api\MemberRequest;
use App\Http\Requests\api\LoginRequest;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    public function indexLogin(){
        return view('frontend.member.login');
    }
    public function login(LoginRequest $request)
    {

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
                ], JsonResponse::HTTP_OK);

        } else {
            return response()->json([
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ],  JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function postRegister(MemberRequest $request){
        $dataInsert = $request->all();
        $dataInsert['level'] = 0;
        if(User::create($dataInsert)) {
            return response()->json([
                'message' => 'success',
                $getUser
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json(['errors' => 'error sever'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
