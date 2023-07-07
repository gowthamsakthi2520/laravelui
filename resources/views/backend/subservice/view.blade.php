@extends('backend.layouts.master')
@section('content')

<!-- The Modal -->
<div class="modal" id="sub_service_popup">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sub Services</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="row g-3" id="add_subservice" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="url" value="{{ route('sub-service.store') }}">
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
                            placeholder="Service Name">
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
    </div>
</div>

<!-- view model -->
<div class="modal fade" id="subserviceview_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Subservice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="serviceview_content">

                </span>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Submit</button> -->
            </div>
        </div>
    </div>
</div>

</div>
<!-- End modal-->




<!-- edit popup model -->

<!-- The Modal -->
<div class="modal" id="edit_sub_service_popup">
    <div class="modal-dialog">
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
                    @method('PUT')
                    
                    <div class="col-md-12">
                    <input type="hidden" id="subservice_id" class="form-control">
                        <label for="inputName" class="form-label pt-3 fw-bold">Service Name</label>
                        <select class="form-select" id="service_id" name="service_id">
                            
                            @foreach($service as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->service_name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger service_id"></span>

                        <label for="inputName" class="form-label pt-3 fw-bold">Sub Service Name</label>
                        <input type="text" class="form-control" id="edit_subservice_name" name="subservice_name">
                        <span class="text-danger subservice_name"></span>

                        <label for="inputName" class="form-label pt-3 fw-bold">Description</label>
                        <textarea  class="form-control" id="edit_subservice_description"
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
    </div>
</div>

<!-- edit popup end -->
<main class="page-content">


    <div class="card">
        <div class="card-header bg-transparent">
            <div class="d-flex align-items-center  justify-content-between">
                <div class="">
                    <h6 class="mb-0 fw-bold dashboard-title">Sub Service</h6>
                </div>
                <div class="add-custmer">
                    <div>

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sub_service_popup"> Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="table-responsivse">
                    <div class="table-responsive white-space-nowrap">
                        <table class="table align-middle" id="serviceList">
                            <thead class="table-light">
                                <tr>
                                    <th>S NO</th>
                                    <th>Services</th>
                                    <th>Sub Services</th>
                                    <th class="sm-desc">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</main>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        var reporttables = $('#serviceList').DataTable({
            "order": [
                [0, "desc"]
            ],
            "serverSide": true,
            "stateSave": true,
            'processing': true,
            oLanguage: {
                sProcessing: '<div class="lds-css"><div style="width:100%;height:100%" class="lds-eclipse"><div></div><p>Please wait while we are processing your request.</p></div></div>'
            },
            "ajax": {
                'type': 'GET',
                'url': '{{ route('subservice_list') }}',
                "data": function (d) {
                    d.searchdata = d.search.value
                }
            },
            searching: true,
            "iDisplayLength": 10,
            "columnDefs": [{
                    "targets": 0,
                    data: 'index',
                },
                {
                    "targets": 1,
                    orderable: false,
                    "render": function (data, type, row, meta) {
                        return '<p class="mb-0 customer-name fw-bold">' + row.service + '</p>';
                    }
                },
                {
                    "targets": 2,
                    orderable: false,
                    "render": function (data, type, row, meta) {
                        //  return' <div id="app-cover"><div class="toggle-button-cover"><div class="button-cover"><div class="button r" id="button-1"><input type="checkbox" data-banner_id='+row.id+' checked=true id="banner_status_id" name="banner_status_id" class="checkbox" value='+row.id+' /><div class="knobs"></div><div class="layer"></div> </div></div></div></div>';

                        return '<p class="mb-0 customer-name">' + row.subservice_name + '</p>';

                    }
                    // "'+row.status == 'active' ? 'active' : 'inactive'+'"
                },
                {
                    "targets": 3,
                    orderable: false,
                    "render": function (data, type, row, meta) {

                        //  return' <div id="app-cover"><div class="toggle-button-cover"><div class="button-cover"><div class="button r" id="button-1"><input type="checkbox" data-banner_id='+row.id+' checked=true id="banner_status_id" name="banner_status_id" class="checkbox" value='+row.id+' /><div class="knobs"></div><div class="layer"></div> </div></div></div></div>';

                        return '<p class="mb-0 customer-name">' + row.description + '</p>';

                    }
                    // "'+row.status == 'active' ? 'active' : 'inactive'+'"
                },
                {
                    "targets": 4,
                    orderable: false,
                    "render": function (data, type, row, meta) {

                        return '<div class="action d-inline"><a href="#" class="edit subservice_edit" data-id="' + row.id +
                            '" data-bs-toggle="modal" data-bs-target="#edit_sub_service_popup"> <i class="bi bi-pencil-square d-inline"></i></a> <a href="javascript:void(0)" data-id=' +
                            row.id +
                            ' class="view text-info subservice_view" type="button"> <i class="bi bi-eye-fill"></i></a><a href="#" class="delete" onclick="deleteOrder(' +
                            row.id + ')"> <i class="bi bi-trash d-inline"></i></a></div>';

                    }
                }
            ],
            rowId: 'id'
        });
    });

    function deleteOrder(id) {

        swal({
                title: "Are you sure?",
                text: "Confirm to delete this Subservice?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    var token = $('meta[name="csrf-token"]').attr("content");
                    var formData = new FormData();
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("id", id);
                    $.ajax({
                        url: "{{ route('sub-service.destroy','') }}" +
                            "/" + id,
                        data: formData,
                        type: 'DELETE',
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (res) {
                            if (res) {
                                swal("Deleted!", "Your Subservice has been deleted.", "success");
                                $('#serviceList').DataTable().ajax.reload();
                            } else {
                                swal("Subservice Delete Failed", "Please try again. :)", "error");
                            }
                        }
                    });

                } else {
                    swal("Cancelled", "Cancelled", "error");
                }
            });
    }

</script>
@endsection
