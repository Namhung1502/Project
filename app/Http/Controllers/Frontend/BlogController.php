<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Comment;
use DB;
class BlogController extends Controller
{
    //
    public function index()
    {
        $data = Blog::paginate(3);
        return view('frontend.blog.blog', compact('data'));
    }

    public function show($id)
    {
        if(!empty($id)){
            // get the curent Blog
            $data = Blog::findOrFail($id);

            //get previous Blog id
            $previous = Blog::where('id', '<', $id)->max('id');

            //get next Blog id
            $next = Blog::where('id', '>', $id)->min('id');

            $dataRate = Rate::where('id_blog', $id)->avg('rate');

        }

        $dataCommentUser = DB::table('comments')
                            ->join('users', 'comments.id_user','=','users.id')
                            ->select('comments.*','users.name', 'users.avatar')
                            ->where("id_blog", $id)
                            ->get()->toArray();

        // dd($dataCommentUser);
        return view('frontend.blog.blog-detail', compact('data','dataRate','dataCommentUser'))->with('previous', $previous)->with('next', $next);
    }

    public function rate(Request $request){
        $data = $request->all();
        if(empty($data['id_user'])){
            $data['id_user'] = Auth::id();
        } else {
            $data['id_user'] = Auth::id();
        }
        $rate = Rate::create($data);
        if($rate){
            return response()->json(['msg' => "thanh cong"]);
        }
    }

    public function comment(Request $request){
        $data = $request->all();
        if($data['up'] == 1){
            // Tạo bản ghi mới trong bảng 'comments'
            if(Comment::create($data)){

                // Lấy id_user từ dữ liệu gửi đến
                $id_user = $data['id_user'];

                // Truy vấn để lấy dữ liệu từ bảng 'comments' và 'users'
                $dataCommentUser = DB::table('comments')
                                ->join('users', 'comments.id_user','=','users.id')
                                ->where("id_blog", $data['id_blog'])
                                ->Where("id_user", $id_user)
                                ->orderBy('comments.created_at', 'DESC')->limit(1)
                                ->get()->toArray();

                // dd($dataCommentUser);
                return response()->json([
                    'msg' => "thanh cong",
                    'data' => $dataCommentUser,
                    'up' => 1
                ]);
            }
        } else if($data['up'] == 2){
            if(!empty($data['level'])){
                $data['level'] = $data['id_cmt'];
            } else {
                $data['level'] = $data['id_cmt'];
            }
            if(Comment::create($data)){
                // Lấy id_user từ dữ liệu gửi đến
                $id_user = $data['id_user'];

                // Truy vấn để lấy dữ liệu từ bảng 'comments' và 'users'
                $dataCommentUser = DB::table('comments')
                                ->join('users', 'comments.id_user','=','users.id')
                                ->where("id_blog", $data['id_blog'])
                                ->Where("id_user", $id_user)
                                ->orderBy('comments.created_at', 'DESC')->limit(1)
                                ->get()->toArray();

                // dd($dataCommentUser);
                return response()->json([
                    'msg' => "thanh cong",
                    'data' => $dataCommentUser,
                    'up' => 2
                ]);
            }
        }

    }
}
