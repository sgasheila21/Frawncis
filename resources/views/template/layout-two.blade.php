@extends('template/main-layout')

@section('content')
    @include('template/navbar')
    @yield('sub-content')
@endsection

@include('template/footer')