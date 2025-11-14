@extends('template/layout-two')

@section('title', 'Location')
@section('sub-content')
<div class="mb-5 row g-0 justify-content-center">
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

    <div style="width:90%">
        @if(auth()->user()->roles->name == 'Admin')
        <a href="{{ route('location.new.show') }}" class="btn btn-primary position-absolute mt-3">+ Add Location</a>
        @endif
        <h4 class="text-center py-3">Our Locations</h4>
        <div class="row row-cols-1 row-cols-md-4 g-2">
            @foreach($locations as $location)
                <div class="col">
                    <div class="card" style="height:100%">
                    <div style="height: 25vh; overflow:hidden; display: flex; justify-content: center;">
                        <img src="/locations_image/{{ $location->image }}" class="card-img-top" alt="[ IMAGE ]">
                    </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $location->city }}</h5>
                            <p class="card-text">{{ $location->address }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <div class="card-text mb-4">{{ $location->opening_hours }} - {{ $location->closing_hours }}</div>

                            @if(auth()->user()->roles->name == 'Admin')
                            <a href="{{ route('location.edit.show',['id' => $location->id]) }}" class="btn btn-primary">Edit</a>
                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $location->id }}">Delete</a>

                            <form action="{{ route('location.delete',['id' => $location->id]) }}" method="POST">
                                @csrf
                                <div class="modal fade" id="confirmDeleteModal{{ $location->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure want to delete this location?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="btnYes">Yes</button>
                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="btnCancel">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection