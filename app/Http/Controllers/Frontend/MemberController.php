<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\frontend\MemberLoginRequest;
use Illuminate\Http\JsonResponse;
class MemberController extends Controller
{
    public function indexLogin(){
        return view('frontend.member.login');
    }
    public function login(MemberLoginRequest $request){
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
            return redirect('/');
        } else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function register()
    {
        return view('frontend.member.register');
    }
    public function postRegister(MemberLoginRequest $request){
        $dataInsert = $request->all();
        $dataInsert['level'] = 0;
        if(User::create($dataInsert)) {
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->route('index')->with('msg', 'Không thêm được người dùng');
        }
    }
    public function profile(){
        return view('frontend.onepage.profile-page');
    }
}
