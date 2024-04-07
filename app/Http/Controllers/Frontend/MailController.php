<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use App\Models\User;
use Mail;
use App\Mail\MailNotify;
use DB;
class MailController extends Controller
{

    public function index(){
        return view('frontend.sendmail.checkout');
    }
    public function sendMail(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        $price = 0;
        $totalPrice = 0;
        if(session()->has('cart')){
            $getSession = session()->get('cart');
            foreach($getSession as $value){
                $price = $value['price'] * $value['qty'];
                $totalPrice += $price;
            }
        }

        $purchaseHistory = [
            'email' =>  $user->email,
            'phone' => $user->phone,
            'name' => $user->name,
            'id_user'=> $user->id,
            'price' => $totalPrice
        ];
        $checkId = History::where('id_user', $id)->exists();
        if(empty($checkId)){
            History::create($purchaseHistory);
        } else {
            $history = DB::table('historys')->where('id_user', $id)->get();
            $purchaseHistory['price'] = $history[0]->price + $totalPrice;
            History::where('id_user', $id)->update(['price' => $purchaseHistory['price']]);
        }
        $data = [
            'subject' => 'Xác nhận đơn hàng',
            'body' => $getSession
        ];
        try {
            $email = DB::table('users')->select('email')->where('id', $id)->get();
            Mail::to($email)->send(new MailNotify($data));
            return response()->json(['Greate check your mail box']);
        } catch (Exception $th) {
            return response()->json(['sory']);
        }
    }
}
