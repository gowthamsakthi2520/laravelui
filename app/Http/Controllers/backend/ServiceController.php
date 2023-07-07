<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use Str;
use Barryvdh\DomPDF\Facade\Pdf;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serices= Services::get();
        return view('backend.service.view',compact('serices'));
    }

    public function createPDF(){
        $services = Services::all();
        $data = [
            'title' => 'Main Services',
            'date' => date('m/d/Y'),
            'services' => $services
        ]; 
            
  
        // view()->share('services',$services);
        $pdf = PDF::loadView('pdf.servicepdf',$data);
        return $pdf->download('laravelsample'.rand(1,50).'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   
        try{
           
            return view('backend.service.add');
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'service_name'=>'required',
            'service_description'=>'required',
            'big_description'=>'required',
            'image'=>'required',
        ]);

        try{
            $slug = Str::slug($request->service_name);
            $slug_count = Services::where('slug',$slug)->count();
            if($slug_count > 0){
                $slug = time().rand(1,50).'-'.$slug;
            }

           $images=[];
            // if($request->hasFile('image')){
            //     foreach($request->file('image') as $img){
            //         $name = time().rand(1,50).'.'.$img->extension();
            //         $img->move(public_path('service_images/'),$name);
            //         $images[]='service_images/'.$name;
            //     }
            // }
            $name = time().rand(1,50).'.'.$request->image->extension();
            $request->image->move(public_path('service_images/'),$name);
            $validate['slug'] = $slug;
            $validate['image']='service_images/'.$name;
            Services::create($validate);
            $msg = "Service Added Successfully!";
            redirect()->route('service')->with(['success'=>$msg]);
            return response()->json(['success'=>true]);
            
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    public function service_list(Request $request){
       
        $service = Services::select('*');
        $servicecount = Services::select('*');

        if (isset($request->searchdata) && $request->searchdata != '') {
            $service->where('service_name', 'like', '%' . $request->searchdata . '%');
            $servicecount->where('service_name', 'like', '%' . $request->searchdata . '%');
        }

        $totalcount = $servicecount->get();
        $totalcount = count($totalcount);

        $allemp = $service->orderBy('id', 'desc')
            ->take($request->length)->skip($request->start)->get();

        $arr = array();
        $i = $request->start + 1;
        foreach ($allemp as $val) {
            $var['id'] = $val->id;
            $var['service_name'] = (!empty($val->service_name)) ? $val->service_name : '';
            $var['service_description'] =(!empty($val->service_description)) ? $val->service_description : '';
            $var['index'] = $i++;
            array_push($arr, $var);
        }

        $data['draw'] = $request->draw;
        $data['recordsTotal'] = $totalcount;
        $data['recordsFiltered'] = $totalcount;
        $data['data'] = $arr;

        return json_encode($data);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            
            $service = Services::find($id);
            return view('backend.service.edit',compact('service'));
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
   
    {
        $validate = $request->validate([
            'service_name'=>'required',
            'service_description'=>'required',
            'big_description'=>'required',
            'image'=>'',
        ]);
        
        $service = Services::find($id);
            
        if(!empty($validate['image'])){
       
            $img_name = time().'.'.$request->image->extension();
            $request->image->move(public_path('services'),$img_name);
            $validate['image']="services".'/'.$img_name;

            // $image = $service->image;
            // $remove = ltrim($image,'services/');

            // if(File::exists(public_path('services/'.$remove))){
            //     File::delete(public_path('services/'.$remove));
            // }
        }
        $service->update($validate);
        $msg = "Service updated successfully";
        redirect('service')->with(['success' => $msg]);
         return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
          
            $service = Services::find($id);
            $service->delete();
            $msg = 'Service has been Deleted';
            return response()->json(['success'=>$msg]);
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage())->withInput();
        }
    }
}
