@extends('template/layout-two')

@section('title', 'Product')
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
        <a href="{{ route('product.new.show') }}" class="btn btn-primary position-absolute mt-3">+ Add Product</a>
    @endif

        <h4 class="text-center py-3">Our Products</h4>
        
        {{ $products->links('pagination::bootstrap-5') }}

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

    </div>
</div>
@endsection