<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\admin\BlogRequest;
use App\Models\Blog;
class BlogController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $listBlog = Blog::all();
            return view('admin.blog.blog', compact('listBlog'));
        }
    }

    public function getBlog(){
        return view('admin.blog.add-blog');
    }
    public function postBlog(BlogRequest $request){
        // lấy all thông tin từ form nhập vào
        $dataBlog = $request->all();

        $file = $request->file('avatar');
        if(!empty($file)){
            $dataBlog['avatar'] = $file->getClientOriginalName();
        }
        if(Blog::create($dataBlog)){
            // if(!empty($file)){
            //     $file->move('uploads/user/avatar', $file->getClientOriginalName());
            // }
            if(!empty($file)){
                $file->move('uploads/user/blog', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Add Blog success.'));
        } else {
            return redirect()->back()->withErrors('Add Blog error.');
        }
    }

    public function editBlog(Request $request,$id){
        if(!empty($id)){
            $dataBlog = Blog::find($id);
            $request->session()->put('id', $id);
        } else {
            return redirect()->back()->with('success', __('edit Blog success.'));
        }
        return view('admin.blog.edit-Blog',compact('dataBlog'));
    }

    public function updateBlog(Request $request) {
        $id = session('id');
        $blog = Blog::findOrFail($id);
        $dataBlog = $request->all();
        $file = $request->file('avatar');
        if(!empty($file)){
            $dataBlog['avatar'] = $file->getClientOriginalName();
        }
        if($blog->update($dataBlog)){
            if(!empty($file)){
                $file->move('uploads/user/blog', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update Blog success.'));
        }
    }

    public function delete($id){
        if(!empty($id)){
            $data = Blog::findOrFail($id);
            if(!empty($data)){
                Blog::where('id', $id)->delete();
            }
        }
        return redirect()->back()->with('success', __('Delete Blog success.'));
    }
}
