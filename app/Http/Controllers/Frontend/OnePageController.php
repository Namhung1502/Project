<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use DB;

class OnePageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            $data = Product::where('name', 'like', '%'.$keyword.'%')->get();
        } else {
            $data = Product::all();
        }
        // dd($data);
        return view('frontend.onepage.search-name', compact('data'));
    }
    public function searchAdvandce(Request $request)
    {
        $dataCategory = Category::all();
        $dataBrand = Brand::all();

        $name = $request->name;
        $price = $request->price;
        $id_category = $request->id_category;
        $id_brand = $request->id_brand;
        $status = $request->status;
        $product = Product::query();
        if(!empty($name)){
            $product->where('name', 'like', '%'.$name.'%');
        }
        if (!empty($price)) {
            $price_range = explode("-", $price);
            $product ->whereBetween('price', [$price_range[0], $price_range[1]]);
        }
        if(!empty($id_category)){
            $product ->where('id_category', $id_category);
        }
        if(!empty($id_brand)){
            $product ->where('id_brand', $id_brand);
        }
        if(!empty($status)){
            $product ->where('status', $status);
        }
        // if(empty($name) && empty($price) && empty($id_category) && empty($id_brand) && empty($status)){
        //     $product = $product->paginate(3);
        // }
        $products = $product->orderBy('created_at', 'DESC')->paginate(6);
        return view('frontend.onepage.search-advandce', compact('dataCategory', 'dataBrand', 'products'));
    }
    //
    public function searchPrice(Request $request)
    {
        $price_range = $request->price;
        $price_range = explode(':', $price_range);
        $price_range = array_map('trim', $price_range);
        $product = Product::query();
        if(!empty($price_range)){
            $product->whereBetween('price', [$price_range[0], $price_range[1]]);
        }
        $products = $product->orderBy('created_at', 'DESC')->get();
        return response()->json([
                    'data' => $products
                ]);
    }
}
