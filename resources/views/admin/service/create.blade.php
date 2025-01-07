
@extends('admin.include.master')
@section('title', 'Create Or Edit Service')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ isset($service) ? 'Edit' : 'Add' }} Service</h5>
            <form class="card-body" id="service-form" action="{{ isset($service) ? route('admin.services.update') : route('admin.services.store') }}" method="post"
                  enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="service_id" class="form-control" value="{{ isset($service) ? $service->id : '' }}"/>
                <hr class="my-4 mx-n4"/>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="service_name" class="form-control" placeholder="Enter Name" value="{{ isset($service) ? $service->service_name : '' }}"/>
                            <label for="service_name">Service Name<span class="text-danger">*</span></label>
                        </div>
                        @error('service_name')
                        <span id="service_name" class="error">{{ $message }}</span>
                        @enderror
                        <span id="service_name_error"></span>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($service) ? 'Update' : 'Submit' }}</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @push('script')
        <script>

            $(function () {
                $("#service-form").validate({
                    rules: {
                        service_name: {
                            required: true,
                        }
                    },
                    messages: {
                        service_name: {
                            required: "Please enter service name.",
                        }
                    },
                    errorPlacement: function (error, element) {
                        error.insertAfter($("#" + element.attr("name") + "_error"));
                    },
                    submitHandler: function (form) {
                        $(".proceed-btn").hide();
                        return true;
                    }
                });
            });


        </script>
    @endpush
@endsection
