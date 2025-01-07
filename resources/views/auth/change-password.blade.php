@extends('admin.include.master')
@section('title', 'Change Password')
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card col-md-6">
        <div class="card-header">
            <h2>Change Password</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.updatePassword') }}" method="POST">
                @csrf
                <!-- Add the form fields here -->
                <div class="form-group mb-2">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group mb-2">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group mb-4">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
