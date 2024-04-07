<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class HomeController extends Controller
{
    //
    public function index(){
        // session()->forget('cart');
        $data = DB::table('products')
                ->orderBy('created_at', 'DESC')->limit(6)
                ->get();
        // dd($data);
        return view('frontend.onepage.home', compact('data'));
    }
    public function ajaxProduct(Request $request){
        $id = $request->id;
        $product = Product::find($id)->toArray();
        $product['qty'] = 1;
        $isValid = true;
        if(session()->has('cart')){
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                if ($value['id'] == $id) {
                    $getSession[$key]['qty'] += 1;
                    session()->put('cart', $getSession);
                    $isValid = false;
                }
            }
        }
        if($isValid == true){
            session()->push('cart',$product);
        }
        $sumQty = 0;
        foreach(session()->get('cart') as $value){
            $sumQty += $value['qty'];
        }
        return $sumQty;
    }
}
