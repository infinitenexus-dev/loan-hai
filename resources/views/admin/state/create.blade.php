@extends('admin.include.master')
@section('title', 'Create Or Edit State')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ isset($state) ? 'Edit' : 'Add' }} State</h5>
            <form class="card-body" id="state-form"
                action="{{ isset($state) ? route('admin.state.update') : route('admin.state.store') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="state_id" class="form-control"
                    value="{{ isset($state) ? $state->id : '' }}" />
                <hr class="my-4 mx-n4" />
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="state_name" class="form-control" placeholder="Enter State Name"
                                value="{{ isset($state) ? $state->state : '' }}" />
                            <label for="state_name">State Name<span class="text-danger">*</span></label>
                        </div>
                        @error('state_name')
                            <span id="state_name" class="error">{{ $message }}</span>
                        @enderror
                        <span id="state_name_error"></span>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($state) ? 'Update' : 'Submit' }}</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @push('script')
        <script>
            $(function() {
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
                    errorPlacement: function(error, element) {
                        error.insertAfter($("#" + element.attr("name") + "_error"));
                    },
                    submitHandler: function(form) {
                        $(".proceed-btn").hide();
                        return true;
                    }
                });
            });
        </script>
    @endpush
@endsection
