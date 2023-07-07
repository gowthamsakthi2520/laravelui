<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        try{
           
            return view('backend.dashboard');
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }
}
