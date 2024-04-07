<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\MailNotify;
use DB;
class MailController extends Controller
{
    public function index(){
        //mảng dữ liệu chứa các thông tin về emai
        // subject (chủ đề của email)
        // body (nội dung của email)
        $getSession = session()->get('cart');
        $data = [
            'subject' => 'Xác nhận đơn hàng',
            'body' => $getSession
        ];
        try {
            $id = Auth::id();
            $email = DB::table('users')->select('email')->where('id', $id)->get();
            //sử dụng class mail laravel gửi email đến địa chỉ .....
            //phương thức to() để chỉ định địa chỉ email nhận
            //phương thức send() để gửi email
            //Đối số của phương thức send() là một instance của một lớp Mailable()
            //-> ở đây được gọi là MailNotify, được truyền vào với dữ liệu từ biến $data.
            Mail::to($email)->send(new MailNotify($data));
            return response()->json(['Greate check your mail box']);
        } catch (Exception $th) {
            return response()->json(['sory']);
        }
    }
}
