<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart.cart');
    }
    public function ajax(Request $request){
        $data = $request->all();

        if(session()->has('cart')){
            $getSession = session()->get('cart');
        }
        if($data['up'] == 1){
            foreach($getSession as $key => $value){
                if($value['id'] == $data['id']){
                    // dd($value['id']);
                    $getSession[$key]['qty'] = $data['qty'];
                    session()->put('cart', $getSession);
                }
            }
        }
        if($data['up'] == 2){
            foreach($getSession as $key => $value){
                if($data['qty'] > 0){
                    if($value['id'] == $data['id']){
                        // dd($value['id']);
                        $getSession[$key]['qty'] = $data['qty'];
                        session()->put('cart', $getSession);
                    }
                } else {
                    foreach($getSession as $key => $value){
                        if($value['id'] == $data['id']){
                            unset($getSession[$key]);
                            $getSession = array_values($getSession);
                            session()->put('cart', $getSession);
                        }
                    }
                }
            }
        }
        if($data['up'] == 3){
            foreach($getSession as $key => $value){
                if($value['id'] == $data['id']){
                    unset($getSession[$key]);
                    $getSession = array_values($getSession);
                    session()->put('cart', $getSession);
                }
            }
        }
    }

}
