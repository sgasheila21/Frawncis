@extends('template/layout-two')

@section('title', 'Cart')
@section('sub-content')
<h4 class="text-center py-3">Your Cart</h4>
<div class="container bg-light mb-5 shadow" style="height:70vh">
    <div class="row">
        <div class="overflow-auto col-6 p-3" style="max-height:70vh;">
            @php
                $total_price = 0;
                $total_qty = 0;
            @endphp
            @foreach($carts as $cart)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="max-height: 24vh; overflow:hidden; display: flex; justify-content: center;">
                            <img src="/products_image/{{ $cart->products->image }}" class="img-fluid rounded-start" alt="[ IMAGE ]">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cart->products->name }}</h5>
                            <p class="card-text"><b>Price: {{$cart->products->price}}</b></p>
                            <form action="{{ route('update.quantity', ['id' => $cart->id ]) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-append me-1">
                                        <button class="btn btn-danger decrementBtn" name="decrementBtn" type="submit" style="height: 5vh; width: 6vh; padding: 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <input style="height: 5vh; width: 9vh" class="form-control text-center quantityInput" name="quantity" value="{{ old('quantity', $cart->quantity) }}" min="1">
                                    </div>
                                    <div class="input-group-prepend ms-1">
                                        <button class="btn btn-primary incrementBtn" name="incrementBtn" type="submit" style="height: 5vh; width: 6vh; padding: 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="input-group-prepend ms-1">
                                        <button class="btn btn-danger trashBtn" name="trashBtn" type="submit" style="height: 5vh; width: 6vh; padding: 0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                @php
                    $total_price += ($cart->products->price * $cart->quantity);
                    $total_qty += $cart->quantity;
                @endphp
            @endforeach
        </div>
        
        <div class="col-6 p-3">
            <h5 class="text-center"><b>Cart Summary</b></h5>
            <div>Total Price : Rp{{ $total_price }}</div>
            <div>Total Item : {{ $total_qty }} item(s)</div>
            <hr>
            <h6 class="text-center"><b>Choose Pickup Location</b></h6>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <label class="input-group-text" for="ddlLocation">Location</label>
                    <select class="form-select" id="ddlLocation" name="ddlLocation">
                        <option selected disabled>- Select Location Here -</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">
                                {{ $location->address }}, {{ $location->city }}
                            </option>
                        @endforeach                
                    </select>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary" style="width:100%">Checkout</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var decrementButtons = document.querySelectorAll(".decrementBtn");
        var incrementButtons = document.querySelectorAll(".incrementBtn");
        var quantityInputs = document.querySelectorAll(".quantityInput");

        decrementButtons.forEach(function(button, index) {
            button.addEventListener("click", function() {
                var quantityInput = quantityInputs[index];
                var quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantityInput.value = quantity - 1;
                }
            });
        });

        incrementButtons.forEach(function(button, index) {
            button.addEventListener("click", function() {
                var quantityInput = quantityInputs[index];
                var quantity = parseInt(quantityInput.value);
                quantityInput.value = quantity + 1;
            });
        });
    });
</script>
@endsection