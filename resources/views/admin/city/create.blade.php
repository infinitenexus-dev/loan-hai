@extends('admin.include.master')
@section('title', 'Create Or Edit City')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ isset($city) ? 'Edit' : 'Add' }} City</h5>
            <form class="card-body" id="state-form"
                action="{{ isset($city) ? route('admin.city.update') : route('admin.city.store') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="city_id" class="form-control" value="{{ isset($city) ? $city->id : '' }}" />
                <hr class="my-4 mx-n4" />
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="city_name" class="form-control" placeholder="Enter City Name"
                                value="{{ isset($city) ? $city->city : '' }}" />
                            <label for="city_name">City Name<span class="text-danger">*</span></label>
                        </div>
                        @error('city_name')
                            <span id="city_name" class="error">{{ $message }}</span>
                        @enderror
                        <span id="city_name_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select class="form-select" name="city_state" required>
                                <option value="" disabled selected>Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ isset($state) && $state->id == isset($city) && $city->state ? 'selected' : '' }}>
                                        {{ $state->state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_state')
                            <span id="city_state" class="error">{{ $message }}</span>
                        @enderror
                        <span id="city_state_error"></span>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($city) ? 'Update' : 'Submit' }}</button>
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
