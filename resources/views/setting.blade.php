@extends('layouts.app')

@section('stylesheet')
    <style>
        .set_width{
            width: 60%;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="set_width">
        @if (Session::has('success'))
            <div class="alert alert-success">
                <span>{{ Session::get('success') }}</span>
            </div>
        @endif

        @if (Session::has('fail'))
            <div class="alert alert-danger">
                <span>{{ Session::get('fail') }}</span>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <span>Change Password</span>
            </div>
            <div class="card-body">
                <form action="{{ route('change_password') }}" method="post">
                    @csrf
                    
                    <div class="input-group mb-3"> 
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Current Password
                            </span>
                        </div>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                New Password
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                Re-enter Password
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <span>Update City</span>
            </div>
            <div class="card-body">
                <h6>Current City: {{ Auth::user()->city }}</h6>
                <form action="{{ route('change_city') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                City Name
                            </span>
                        </div>
                        <input type="text" name="city_name" class="form-control @error('city_name') is-invalid @enderror">
                        @error('city_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
