@section('content')

<div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Sub Services</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="row g-3" id="edit_subservice" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="url" value="">
                    <div class="col-md-12">
                        <label for="inputName" class="form-label pt-3 fw-bold">Service Name</label>
                        <select class="form-select" id="service_id" name="service_id">
                            <option value="">Select a Service</option>
                            @foreach($service as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->service_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger service_id"></span>

                        <label for="inputName" class="form-label pt-3 fw-bold">Sub Service Name</label>
                        <input type="text" class="form-control" id="subservice_name" name="subservice_name"
                            value="{{$subservices->subservice_name}}">
                        <span class="text-danger subservice_name"></span>

                        <label for="inputName" class="form-label pt-3 fw-bold">Description</label>
                        <textarea id="desc" class="form-control" id="subservice_description"
                            name="subservice_description" rows="4" cols="50"></textarea>
                        <span class="text-danger subservice_description"></span>

                    </div>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Submit">
                </form>
                <!-- form end -->
            </div>
        </div>

@endsection