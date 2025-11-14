@extends('template/layout-two')

@section('title', 'Location')
@section('sub-content')
<div class="container bg-body p-3 mt-3 mb-5 shadow" style="width:60%">
    <h4><b>Edit Location</b></h4>
    <form action="{{ route('location.edit', ['id' => $location->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $location->city }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $location->address }}">
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="openHours" class="form-label">Opening Hours</label>
                <input type="time" class="form-control" id="openHours" name="openHours" value="{{ $location->opening_hours }}">
            </div>
            <div class="col-6">
                <label for="closeHours" class="form-label">Closing Hours</label>
                <input type="time" class="form-control" id="closeHours" name="closeHours" value="{{ $location->closing_hours }}">
            </div>
        </div>
        <div class="input-group">
            <input class="form-control" type="file" id="formFile" name="locImage">
            <div class="input-group-text">Image</div>
        </div>
        <div class="mb-3">
            @if(!$hasChanged)
                <a href="{{ $imageSource }}" target="_blank"><b>Lihat File</b></a>
            @endif
            @if($hasChanged)
                <input type="hidden" name="isChanged" value="changed">
            @endif
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>   
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary" style="width:100%">Edit Location</button>
    </form>
</div>
@endsection