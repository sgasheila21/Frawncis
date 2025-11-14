@extends('template/layout-two')

@section('title', 'Search')
@section('sub-content')
<div class="mb-5 row g-0 justify-content-center">
    <div style="width:90%">
        @if(is_string($locations))
            <h4 class="py-3">{{ $locations }} {{ $real_input }}</h4>
        @else
        <h4 class="py-3">Showing Location Result(s) for {{ $real_input }}</h4>
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
        @endif

        @if(is_string($products))
            <h4 class="py-3">{{ $products }} {{ $real_input }}</h4>
        @else
        <h4 class="py-3">Showing Product Result(s) for {{ $real_input }}</h4>
        <div class="row row-cols-1 row-cols-md-4 g-2">
            @foreach($products as $product)
                <div class="col">
                    <div class="card" style="height:100%">
                    <div style="height: 25vh; overflow:hidden; display: flex; justify-content: center;">
                        <img src="/products_image/{{ $product->image }}" class="card-img-top" alt="[ IMAGE ]">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                
                @if(auth()->user()->roles->name == 'Member')
                    <div class="card-footer bg-transparent border-0">
                        <h4 class="mb-4">Rp. {{ $product->price }}</h4>
                        <form action="{{ route('update.product.cart',[$product->id]) }}" method="POST">
                            @csrf
                            @php
                                $i = 0;
                            @endphp
                            
                            @foreach(auth()->user()->carts as $cart)
                                @if($cart->products->id == $product->id)
                                    @php
                                        $i++;
                                    @endphp
                                @endif
                            @endforeach

                            @if($i > 0)
                                <button type="submit" class="btn btn-danger" style="width:100%" name="btnRemove">- Remove From Cart</button>
                            @else
                                <button type="submit" class="btn btn-primary" style="width:100%" name="btnAdd">+ Add To Cart</button>
                            @endif
                        </form>
                    </div>
                @elseif(auth()->user()->roles->name == 'Admin')
                    <div class="card-footer bg-transparent border-0">
                        <h4 class="mb-4">Rp. {{ $product->price }}</h4>
                        <a href="{{ route('product.edit.show', ['id' => $product->id]) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $product->id }}">Delete</a>

                        <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Delete Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to delete this product?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="btnYes">Yes</button>
                                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="btnCancel">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection