<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        try{
            
            return view('frontend.index');
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }
}
