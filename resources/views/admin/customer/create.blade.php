@extends('admin.include.master')
@section('title', 'Create Or Edit Customer')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ !empty($customer) ? 'Edit' : 'Add' }} Customer</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Loan Info</h5>
                            </div>
                            <div class="card-body">
                                @if (!empty($customer))
                                    <form id="customer-form"
                                        action="{{ isset($customer) ? route('admin.customers.update') : route('admin.customers.store') }}"
                                        method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="customer_id" class="form-control"
                                            value="{{ isset($customer) ? $customer->id : '' }}" />
                                        <div class="row g-2">
                                            <div class="col-md-12">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="form-select" name="status" id="stateSelect">
                                                        <option value="" disabled selected>Select Status</option>
                                                        @foreach ($statuses as $key => $status)
                                                            <option value="{{ $key }}"
                                                                {{ isset($customer) && $customer->loan_status == $key ? 'selected' : '' }}>
                                                                {{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('status')
                                                    <span id="status" class="error">{{ $message }}</span>
                                                @enderror
                                                <span id="status_error"></span>
                                            </div>
                                            <div class="col-md-12 mb-0">
                                                @if (empty($customer->expected_amount))
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" name="expected_amount" class="form-control"
                                                            placeholder="Enter Expected Loan Amount" />
                                                        <label for="expected_amount">Expected Loan<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                @if (empty($customer->assign_to))
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="form-select" name="agent" id="stateSelect">
                                                            <option value="" disabled selected>Select Agent</option>
                                                            @foreach ($agent as $agents)
                                                                <option value="{{ $agents->id }}">
                                                                    {{ $agents->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                @if (empty($customer->reason_to_reject))
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" name="reason" class="form-control"
                                                            placeholder="Enter Reason For Reject" />
                                                        <label for="reason">Reason For Reject<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                @if (empty($customer->loan_amount))
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" name="amount" class="form-control"
                                                            placeholder="Enter Loan Amount" />
                                                        <label for="amount">Loan Amount<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="file" name="documents[]" class="form-control"
                                                        multiple />
                                                    <label for="amount">Loan Document<span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-4">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($service) ? 'Update' : 'Submit' }}</button>
                                            <button type="reset" class="btn btn-label-secondary"
                                                onclick="window.location='{{ route('admin.customers.index') }}'">Cancel</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(function() {
                $("#customer-form").validate({
                    rules: {
                        status: {
                            required: true,
                        }
                    },
                    messages: {
                        status: {
                            required: "Please select status.",
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

            $(document).ready(function() {
                $('#stateSelect').on('change', function() {
                    var stateId = $(this).val();
                    if (stateId) {
                        $.ajax({
                            url: "{{ route('admin.agent.create') }}",
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                state_id: stateId
                            },
                            success: function(data) {
                                $('#cityContainer select').empty();
                                $.each(data, function(key, value) {
                                    $('#cityContainer select').append('<option value="' +
                                        value.id + '">' + value.city + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#cityContainer select').empty();
                        $('#cityContainer select').append(
                            '<option value="" disabled selected>Select City</option>');
                    }
                });
            });
        </script>
    @endpush
@endsection
