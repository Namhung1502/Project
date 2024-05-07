<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use DB;
use Intervention\Image\ImageManagerStatic as Image;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $account = User::all();
            return view('frontend.account.account', compact('account'));
        } else {
            return view('frontend.error.error-404');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Display the specified resource.
     */
    public function updateAccount(Request $request)
    {
        $id = Auth::id();

        //ấy all thông tin của user có id = id truyền vào
        $user = User::findOrFail($id);

        //Lấy tất cả thông tin từ form nhập vào
        $data = $request->all();
         // Kiểm tra thông tin password có được nhập mới hay khkoong
        if ($data['password']) {
            // Nếu có thì mã hóa và đưa vào lại mảng data
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        //Lấy thông tin của file upload
        $file = $request->file('avatar');
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        if($user->update($data)){
            if(!empty($file)){
                $file->move('uploads/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    public function showMyProduct()
    {
        $id_user = Auth::id();
        $dataProduct = DB::table('products')
        ->where('id_user', $id_user)
        ->get();
        return view('frontend.account.my-product', compact('dataProduct'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function addProduct()
    {
        $listCategory = Category::all();
        $listBrand = Brand::all();
        return view('frontend.account.add-product', compact('listCategory', 'listBrand'));
    }
    public function postProduct(ProductRequest $request)
    {
        $data = $request->all();
        if(empty($data['id_user'])){
            $data['id_user'] = Auth::id();
        }
        if($request->hasfile('image')){
            $uploadedImages = $request->file('image');

            if(count($uploadedImages) > 3){
                return redirect()->back()->withErrors('Chỉ được phép upload tối đa 3 hình ảnh');
            } else {
                $data['image'] = [];
                foreach ($request->file('image') as $image) {
                    $name = $image->getClientOriginalName();
                    $name_2 = "hinh80_".$image->getClientOriginalName();
                    $name_3 = "hinh300_".$image->getClientOriginalName();

                    $path = public_path('uploads/product/' . $name);
                    $path_2 = public_path('uploads/product/' . $name_2);
                    $path_3 = public_path('uploads/product/' . $name_3);

                    //nhận vào đường dẫn tạm thời của tệp hình ảnh đã được tải lên
                    //getRealPath() trả về đường dẫn tuyệt đối đến tệp hình ảnh trên hệ thống tệp của máy chủ
                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(85, 84)->save($path_2);
                    Image::make($image->getRealPath())->resize(329, 380)->save($path_3);
                    $data['image'][] = $name;
                }
                $data['image'] = json_encode($data['image'], true);
                if(Product::create($data)){
                   return redirect()->route('account.myproduct')->with('success', 'Your created has been successfully');
               }
           }
       }

   }
    public function editProduct(Request $request, $id)
    {
        if(!empty($id)){
            $request->session()->put('id', $id);
            $listCategory = Category::all();
            $listBrand = Brand::all();
            $dataProduct = DB::table('products')
            ->join('categorys', 'products.id_category','=','categorys.id')
            ->join('brands', 'products.id_brand','=','brands.id')
            ->select('products.*', 'categorys.category', 'brands.brand')
            ->where('products.id', $id)
            ->get();
        }
        // dd($dataProduct);
    return view('frontend.account.edit-product', compact('dataProduct','listCategory' ,'listBrand'));
    }
    public function updateProduct(Request $request)
    {
        $data = $request->all();
        $id = session('id');
        $dataProduct =  Product::find($id)->toArray();
        if($dataProduct['image']){
            $dataProduct['image'] = json_decode($dataProduct['image'], true);
        }
        if(!empty($data['image'])){
            if($request->hasfile('image')){
                $uploadedImages = $request->file('image');
                if(count($uploadedImages) > 3){
                    return redirect()->back()->withErrors('Chỉ được phép upload tối đa 3 hình ảnh');
                }
                $data['image'] = [];
                foreach($request->file('image') as $image){
                    $name = $image->getClientOriginalName();
                    $name_2 = "hinh80_".$image->getClientOriginalName();
                    $name_3 = "hinh300_".$image->getClientOriginalName();

                    $path = public_path('uploads/product/' . $name);
                    $path_2 = public_path('uploads/product/' . $name_2);
                    $path_3 = public_path('uploads/product/' . $name_3);

                    Image::make($image->getRealPath())->save($path);
                    Image::make($image->getRealPath())->resize(85, 84)->save($path_2);
                    Image::make($image->getRealPath())->resize(329,380)->save($path_3);
                    $data['image'][] = $name;
                }
                if(!empty($data['delete_images'])){
                    foreach($data['delete_images'] as $element){
                        // Tìm vị trí của phần tử đó trong mảng
                        $key = array_search($element, $dataProduct['image']);
                        if($key !== false ){
                            unset($dataProduct['image'][$key]);
                            $dataProduct['image'] = array_values($dataProduct['image']);
                        }
                    }
                }
                $data['image'] = array_merge($data['image'],$dataProduct['image']);
            }
        }
        $data['image'] = json_encode($data['image'], true);
        $dataProduct = Product::hydrate([$dataProduct])->first();
        if($dataProduct->update($data)){
            return redirect()->route('account.myproduct')->with('success', __('Update product success.'));
        } else {
            return redirect()->back()->withErrors('Update product error.');
        }
    }
    public function deleteProduct($id)
    {
        if(!empty($id)){
            Product::where('id', $id)->delete();
        }
        return redirect()->back()->with('success', __('Delete Product success.'));
    }
}
