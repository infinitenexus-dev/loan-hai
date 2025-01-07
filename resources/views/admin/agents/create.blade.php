@extends('admin.include.master')
@section('title', 'Create Or Edit Agent')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <h5 class="card-header">{{ isset($agent) ? 'Edit' : 'Add' }} Agent</h5>
            <form class="card-body" id="agent-form"
                action="{{ isset($agent) ? route('admin.agent.update') : route('admin.agent.store') }}" method="post"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <input type="hidden" name="agent_id" class="form-control" value="{{ isset($agent) ? $agent->id : '' }}" />
                <hr class="my-4 mx-n4" />
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="agent_name" class="form-control" placeholder="Enter Name"
                                value="{{ isset($agent) ? $agent->name : '' }}" />
                            <label for="agent_name">Agent Name<span class="text-danger">*</span></label>
                        </div>
                        @error('agent_name')
                            <span id="service_name" class="error">{{ $message }}</span>
                        @enderror
                        <span id="service_name_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="agent_number" class="form-control" placeholder="Enter Phone"
                                value="{{ isset($agent) ? $agent->number : '' }}" />
                            <label for="agent_number">Phone<span class="text-danger">*</span></label>
                        </div>
                        @error('agent_number')
                            <span id="agent_number" class="error">{{ $message }}</span>
                        @enderror
                        <span id="agent_number_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" name="agent_address" class="form-control" placeholder="Enter Address"
                                value="{{ isset($agent) ? $agent->address : '' }}" />
                            <label for="agent_address">Address<span class="text-danger">*</span></label>
                        </div>
                        @error('agent_address')
                            <span id="agent_address" class="error">{{ $message }}</span>
                        @enderror
                        <span id="agent_address_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select class="form-select" name="agent_state" id="stateSelect">
                                <option value="" disabled selected>Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ isset($state) && $state->id == isset($agent) && $agent->state ? 'selected' : '' }}>
                                        {{ $state->state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('agent_state')
                            <span id="agent_state" class="error">{{ $message }}</span>
                        @enderror
                        <span id="agent_state_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline" id="cityContainer">
                            <select class="form-select" name="agent_city">
                                <option value="" disabled selected>Select City</option>
                                @if (!empty($city))
                                    @foreach ($city as $citys)
                                        <option value="{{ $citys->id }}"
                                            {{ isset($citys) && $citys->id == isset($agent) && $agent->city ? 'selected' : '' }}>
                                            {{ $citys->city }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @error('agent_city')
                            <span id="agent_city" class="error">{{ $message }}</span>
                        @enderror
                        <span id="agent_city_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="file" name="document[]" class="form-control" multiple />
                            <label for="amount">Agent Document<span class="text-danger">*</span></label>
                        </div>
                        @error('document')
                            <span id="document" class="error">{{ $message }}</span>
                        @enderror
                        <span id="document_error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline" id="servicesContainer">
                            <div id="servicesCheckboxes">
                                @if (!empty($services))
                                    @foreach ($services as $service)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="services[]"
                                                value="{{ $service->id }}"
                                                {{ isset($agentServices) && in_array($service->id, $agentServices) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $service->service_name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @error('services')
                            <span id="services" class="error">{{ $message }}</span>
                        @enderror
                        <span id="services_error"></span>
                    </div>
                    @if (!empty($agent['document']))
                        @php
                            $documentNames = explode(',', $agent['document']);
                        @endphp
                        @foreach ($documentNames as $documentName)
                            <div class="col-md-2">
                                <div style="border: 5px solid; hight:200px">
                                    <a href="{{ url('uploads/documents/' . trim($documentName)) }}"
                                        download="{{ $documentName }}">
                                        <img src="{{ url('uploads/agent/documents/' . trim($documentName)) }}"
                                            alt="{{ $documentName }}" class="img-fluid document-image"
                                            style="height: 200px;">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 proceed-btn">{{ isset($service) ? 'Update' : 'Submit' }}</button>
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
