@extends('template/layout-two')

@section('title', 'Product')
@section('sub-content')
<div class="container bg-body p-3 mt-3 mb-5 shadow" style="width:60%">
    <h4><b>Add Product</b></h4>
    <form action="{{ route('product.new') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Request::get("name") ? Request::get("name") : null }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ Request::get("price") ? Request::get("price") : null }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ Request::get("description") ? Request::get("description") : null }}">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="productType">Product Type</label>
            <select class="form-select" id="productType" name="productType">
                <option selected disabled>- Select a Product Type -</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ Request::get("productType") == $type->id ? 'selected' : '' }}>
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
            @if($hasImage)
                <a href="/temp/{{ $namaFileTemp }}" target="_blank"><b>Lihat File</b></a>
                <input type="hidden" name="oldImage" value="{{ $namaFileTemp }}">
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

        <button type="submit" class="btn btn-primary" style="width:100%">Add Product</button>
    </form>
</div>
@endsection