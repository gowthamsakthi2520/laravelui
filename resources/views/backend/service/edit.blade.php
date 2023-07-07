@extends('backend.layouts.master')
@section('content')

      <!--start main content-->
      <main class="page-content">
         <!--end row-->
         <div class="add-custmer d-none">
            <div>
               <button class="btn btn-primary"> <a href=""> Add Service</a> <i class="bi bi-plus-lg"></i></button>
            </div>
         </div>
         <div class="card">
            <div class="card-header bg-transparent">
               <div class="d-flex align-items-center">
                  <div class="">
                     <h6 class="mb-0 fw-bold dashboard-title">Edit Service</h6>
                  </div>
               </div>
            </div>
            <div class="card border-0">
               <div class="card-body">
                 <!-- Form details -->
                  <form class="row g-3" id="edit_service_form"   enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="url" value="{{route('service.update','').'/'.$service->id}}">
                    <input type="hidden" id="id" value="{{$service->id}}">
                     <div class="col-md-12">
                        <label for="inputName" class="form-label pt-3 fw-bold">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name" value="{{$service->service_name}}" placeholder="Service Name">
                        <span class="text-danger service_name"></span>

                    

                        <label for="inputName" class="form-label pt-3 fw-bold">Small Description</label>
                        <textarea id="desc" class="form-control" id="service_description" name="service_description" rows="4" cols="50">{{$service->service_description}}</textarea>
                        <span class="text-danger service_description"></span>

                        <div class="col-md-12">
                           <!-- <label for="inputDesc" class="form-label pt-3 fw-bold">Big Description</label>
                           <input type="text" class="form-control" name="big_description" id="big_description"> -->
                           <label for="inputName" class="form-label pt-3 fw-bold">Big Description</label>
                        <textarea id="desc" class="form-control" id="big_description" name="big_description" rows="4" cols="50">{{$service->big_description}}</textarea>

                           <span class="text-danger big_description"></span>
                        </div>
                        <div class="col-md-12">
                        <label for="inputName" class="form-label pt-3 fw-bold">Image</label>
                       <input type="file" class="form-control" id="image" name="image" placeholder=" Add Gallery Image">

                       <img src="{{asset($service->image)}}" width="50" height="50">
                       <span class="text-danger image"></span>
                    </div>
                        <div class="col-12 pt-5">
                           <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                     </div>
                  </form> 
               </div>
            </div>
         </div>
      </main>
      <!--end main content-->
@endsection