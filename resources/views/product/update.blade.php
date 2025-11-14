@extends('template/layout-two')

@section('title', 'Product')
@section('sub-content')
<div class="container bg-body p-3 mt-3 mb-5 shadow" style="width:60%">
    <h4><b>Edit Product</b></h4>
    <form action="{{ route('product.edit', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="productType">Product Type</label>
            <select class="form-select" id="productType" name="productType">
                <option disabled>- Select a Product Type -</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $product->product_type_id == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach   
            </select>
        </div>
        <div class="input-group">
            <input class="form-control" type="file" id="formFile" name="prodImage">
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
        
        <button type="submit" class="btn btn-primary" style="width:100%">Edit Product</button>
    </form>
</div>
@endsection