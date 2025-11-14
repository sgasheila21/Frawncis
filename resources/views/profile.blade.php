@extends('template/layout-two')

@section('title', 'Profile')
@section('sub-content')

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('failure'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>{{ session()->get('failure') }}</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container bg-body p-3 mt-3 mb-5 shadow" style="width:60%">
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center mb-3">
            <img src="/image/{{ auth()->user()->profile_picture }}" alt="[[ PROFILE PICTURE ]]" style="width:30vh; height:30vh;" class="rounded">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Input your name here" value="{{ old('name', auth()->user()->fullname) }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Input your email address here" value="{{ old('email', auth()->user()->email) }}">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3 input-group">
            <input class="form-control" type="file" id="formFile" name="profilePicture">
            <div class="input-group-text">Profile Picture</div>
        </div>

        @if ($errors->submitProfile->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->submitProfile->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary" style="width:100%" name="submit" value="submitBtn">Submit</button>
    </form>

    <hr>

    <form action="{{ route('profile.change.password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Enter Current Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">Enter New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword">
        </div>
        <div class="mb-3">
            <label for="reNewPassword" class="form-label">Re-enter New Password</label>
            <input type="password" class="form-control" id="reNewPassword" name="reNewPassword">
        </div>
 
        @if ($errors->changePasswordErrors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->changePasswordErrors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-danger" style="width:100%" name="submit" value="changePasswordBtn">Change Password</button>
    </form>
</div>
@endsection