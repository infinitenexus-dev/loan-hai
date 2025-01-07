@extends('admin.include.master')
@section('title', 'Customer Detail')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Customer Detail</h5>
                        </div>
                        <div class="card-body text-nowrap">
                            @if (!empty($customer))
                            <table class="table table-striped">
                                <tr>
                                    <td><b style="color: black;">Name:</b></td>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Email:</b></td>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Phone:</b></td>
                                    <td>{{ $customer->tel }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Age:</b></td>
                                    <td>{{ $customer->age }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">City:</b></td>
                                    <td>{{ $customer->cities->city }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Service:</b></td>
                                    <td>{{ $customer->service->service_name }}</td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Income:</b></td>
                                    <td>{{ $customer->income }}</td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Loan Status</h5>
                        </div>
                        <div class="card-body text-nowrap">
                            <table class="table table-striped">
                                <tr>
                                    <td><b style="color: black;">Expected Loan Amount:</b></td>
                                    @if (!empty($customer->expected_amount))
                                    <td>{{ $customer->expected_amount }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Assign For Agent:</b></td>
                                    <td>
                                        @if (!empty($agent))
                                        @foreach ($agent as $agents)
                                        @if ($customer->assign_to == $agents->id)
                                        {{ $agents->name }}
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Reason For Reject:</b></td>
                                    @if (!empty($customer->reason_to_reject))
                                    <td>{{ $customer->reason_to_reject }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b style="color: black;">Loan Amount Pass:</b></td>
                                    @if (!empty($customer->loan_amount))
                                    <td>{{ $customer->loan_amount }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Loan Documents</h5>
                        </div>
                        @if (!empty($customer['documents']))
                        <div class="card-body text-nowrap">
                            <div class="d-flex flex-wrap">
                                @php
                                $documentNames = explode(',', $customer['documents']);
                                @endphp
                                @foreach ($documentNames as $documentName)
                                <div class="col-md-4 p-2" style="border: 5px solid; hight:200px">
                                    <a href="{{ url('uploads/documents/' . trim($documentName)) }}" download="{{ $documentName }}">
                                        <img src="{{ url('uploads/documents/' . trim($documentName)) }}" alt="{{ $documentName }}" class="img-fluid document-image" style="height: 464px;">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection