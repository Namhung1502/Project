<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Countries;
use App\Http\Requests\admin\UpdateProfileRequest;

class DashboardController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            return view('admin.dashboard');
        }
    }
    /**
     * Profile
     */
    public function getProfile(Request $request){
        if(Auth::check()){
            $dataCountry = Countries::all();
            return view('admin.onepage.pages-profile', compact('dataCountry'));
        }
    }
    public function update(UpdateProfileRequest $request){
        //Lấy id của user
        $userId = Auth::id();

        //hàm sql lấy all thông tin của user có id = id truyền vào
        $user = User::findOrFail($userId);

        // lấy all thông tin từ form nhập vào
        $data = $request->all();

        //Lấy thông tin của file upload
        $file = $request->file('avatar');
        // kiểm tra nếu có file upload lên thì lấy tên file đưa vào mảng data
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        // dd($data);
        // Kiểm tra thông tin password có được nhập mới hay khkoong
        if ($data['password']) {
            // Nếu có thì mã hóa và đưa vào lại mảng data
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('uploads/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }
    /**
     * List User
     */
    public function getListUser(){
        return view('admin.user.list-user');
    }
    /**
     * Form Basic
     */
    public function getForm(){
        return view('admin.onepage.form-basic');
    }

    /**
     * Table Basic
     */
    public function getTable(){
        return view('admin.onepage.table-basic');
    }

    /**
     * Icon Material
     */
    public function getIcon(){
        return view('admin.onepage.icon-material');
    }

    /**
     * Starter Page
     */
    public function getBlank(){
        return view('admin.onepage.started-ket');
    }

    /**
     * Error 404
     */
    public function getError(){
        return view('admin.onepage.error-404');
    }
}
