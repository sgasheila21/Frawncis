@extends('template/layout-one')

@section('title', 'Register')
@section('sub-content')
    <form action="{{ route('register.auth') }}" method="POST">
        @csrf
        <div class="container position-absolute top-50 start-50 translate-middle" style="background-color: rgba(255, 255, 255, 0.4); backdrop-filter: blur(5px); width: 50%; padding: 15px;">
            <h4 class="mb-3" style="color:white;">Register</h4>
            <input type="text" class="form-control mb-3" id="fullname" name="fullname" placeholder="Full Name" value="{{ old('fullname') }}">
            <input type="email" class="form-control mb-3" id="emailAddress" name="emailAddress" placeholder="Email Address" value="{{ old('emailAddress') }}">
            <input type="password" class="form-control mb-3" id="password" name="passwords" placeholder="Password" value="{{ old('passwords') }}">
            <input type="password" class="form-control mb-3" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" value="{{ old('confirmPassword') }}">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="termsAndConditions" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault" style="color:white;">
                    I Agree To The Terms and Conditions.
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Register</button>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <hr style="color:white;">
            <p style="color:white;">Already Have an Account Yet? Click <a href="{{ route('login.show') }}">Here</a> to Login.</p>
        </div>
    </form>
@endsection