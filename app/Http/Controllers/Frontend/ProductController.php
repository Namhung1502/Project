<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function index(){

        return view('frontend.product.shop');
    }
    public function indexProductDetail($id){
        $data = DB::table('products')
                ->join('categorys', 'products.id_category','=','categorys.id')
                ->join('brands', 'products.id_brand','=','brands.id')
                ->select('products.*', 'categorys.category', 'brands.brand')
                ->where('products.id', $id)
                ->get();
        // dd($data);
        return view('frontend.product.product-details', compact('data'));
    }

}
