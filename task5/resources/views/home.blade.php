@extends('layouts.main')
@section('content')
    @include("menu")
    @include("list.list")
@endsection
@push('pageScripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endpush
