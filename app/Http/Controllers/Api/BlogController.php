<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use DB;

class BlogController extends Controller
{
    //
    public function index()
    {
        $data = Blog::paginate(3);
        return response()->json([
            'blog' => $data
        ]);
    }
}
