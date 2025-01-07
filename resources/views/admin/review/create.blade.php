@extends('admin.include.master')
@section('title', 'Create Or Edit Review')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ isset($review) ? 'Edit' : 'Add' }} Agent</h5>
            <form class="card-body" id="review-form"
                action="{{ isset($review) ? route('admin.review.update') : route('admin.review.store') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="review_id" class="form-control"
                    value="{{ isset($review) ? $review->id : '' }}" />
                <hr class="my-4 mx-n4" />
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="review_name" class="form-control" placeholder="Enter Customer Name"
                                value="{{ isset($review) ? $review->name : '' }}" />
                            <label for="customer_name">Customer Name<span class="text-danger">*</span></label>
                        </div>
                        @error('customer_name')
                            <span id="customer_name" class="error">{{ $message }}</span>
                        @enderror
                        <span id="customer_name_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select class="form-select" name="service_id" required>
                                <option value="" disabled selected>Select service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ isset($review) && $review->service == $service->id ? 'selected' : '' }}>
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('agent_number')
                            <span id="agent_number" class="error">{{ $message }}</span>
                        @enderror
                        <span id="agent_number_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="review_discription" class="form-control" placeholder="Enter Discription"
                                value="{{ isset($review) ? $review->description : '' }}" />
                            <label for="review_discription">Discription<span class="text-danger">*</span></label>
                        </div>
                        @error('review_discription')
                            <span id="review_discription" class="error">{{ $message }}</span>
                        @enderror
                        <span id="review_discription_error"></span>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($review) ? 'Update' : 'Submit' }}</button>
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
