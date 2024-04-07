<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Http\Requests\admin\AddCountryRequest;
class CountryController extends Controller
{
    private $countries;
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

    public function index(){
        if(Auth::check()){
            $listCountry = Countries::all();
            // dd($listCountry);
            return view('admin.country.country', compact('listCountry'));
        }
    }

    /**
     * Display Add Country
     */
    public function getCountry(){
        return view('admin.country.add-country');
    }
    public function postAdd(AddCountryRequest $request)
    {
        $dataCoutry = $request->all();
        if(Countries::create($dataCoutry)){
            return redirect()->back()->with('success',  __('Add Country success.'));
        } else {
            return redirect()->back()->withErrors('Add Country error.');
        }

    }
    /**
     * Delete Country
     */
    public function deleteCountry($id = 0)
    {
        if(!empty($id)){
            $delete = Countries::where('id', $id)->delete();
            if ($delete) {
                return redirect()->route('dashboard.country.index')->with('success',  __('Delete Country success.'));
            } else {
                return redirect()->back()->withErrors('Delete Country error.');
            }
        } else {
            return redirect()->back()->withErrors('Link does not exist.');
        }
    }
}
