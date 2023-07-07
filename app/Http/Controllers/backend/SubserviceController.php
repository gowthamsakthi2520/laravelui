<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Subservices;
use App\Models\Services;
use Illuminate\Http\Request;

class SubserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            
            $service = Services::orderBy('id','desc')->get();
            return view('backend.subservice.view',compact('service'));
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'service_id'=>'required',
            'subservice_name'=>'required',
            'subservice_description'=>'required',
        ],
        [
            'service_id'=>'The service name field is required.',
        ]);


        try{
              Subservices::create($validate); 
              $msg = "Subservice has been Added!";
              redirect()->route('sub-service.index')->with(['suucess'=>$msg]);
              return response()->json(['status'=>true,'success'=>$msg],200);
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }

    }

    public function subservice_list(Request $request){

        $subservice = Subservices::select('*');
        $subservice_count = Subservices::select('*');
        
        $totalcount = $subservice->get();
        $totalcount = count($totalcount);
        
        $subservices = $subservice->orderBy('id','desc')
        ->take($request->length)->skip($request->start)->get();

        $array =array();
        
        $i = $request->start+1;
        foreach($subservices as $value){
           $sub_arr['id']=$value->id;
           $sub_arr['service']= (!empty($value))? $value->services->service_name : '';
        //    (!empty($value))? $value->services->service_name : ''
           $sub_arr['subservice_name'] = (!empty($value))?$value->subservice_name : '';
           $sub_arr['description'] = (!empty($value))? $value->subservice_description : '';
           $sub_arr['index']=$i++;
          array_push($array,$sub_arr);
        }
        
        $data['data']=$array;
        $data['draw']= $request->draw;
        $data['recordsTotal']=$totalcount;
        $data['recordsFiltered']=$totalcount;
   

        return json_encode($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // try{
           
            $subservice = Subservices::where('id',$id)->get();

            
            return response()->json([$subservice]);
        // }
        // catch(\Exception $e){
        //     return back()->with('error',$e->getMessage())->withInput();
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subservices = Subservices::where('id',$id)->get();
            
        return response()->json([$subservices]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       
        $validate = $request->validate([
            'service_id'=>'required',
            'subservice_name'=>'required',
            'subservice_description'=>'required',
        ],
        [
            'service_id'=>'The service name field is required.',
        ]);

        $subservice = Subservices::find($id);
        $subservice->update($validate);
        $msg = "Subservice has been Updated!";
        return response()->json(['status'=>true,'success'=>$msg],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
           
            $subservice = Subservices::find($id);
            $subservice->delete();
            $msg = "Subservice has been Deleted!";
            return response()->json(['status'=>true,'success'=>$msg],200);
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }
}
