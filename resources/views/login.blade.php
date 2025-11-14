@extends('template/layout-one')

@section('title', 'Login')
@section('sub-content')
    <form action="{{ route('login.auth') }}" method="POST">
        @csrf
        <div class="container position-absolute top-50 start-50 translate-middle" style="background-color: rgba(255, 255, 255, 0.4); backdrop-filter: blur(5px); width: 50%; padding: 15px;">
            <h4 class="mb-3" style="color:white;">Log In</h4>
            <input type="email" class="form-control mb-3" name="emailAddress" id="emailAddress" placeholder="Email Address" value="{{ old('emailAddress') }}">
            <input type="password" class="form-control mb-3" name="passwords" id="password" placeholder="Password" value="{{ old('passwords') }}">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="rememberMe" id="flexCheckDefault" @if(old('rememberMe')) checked @endif>
                <label class="form-check-label" for="flexCheckDefault" style="color:white;">
                    Remember Me
                </label>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Log In</button>

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
            <p style="color:white;">Don't Have an Account Yet? Click <a href="{{ route('register.show') }}">Here</a> to Register.</p>
        </div>
    </form>
@endsection