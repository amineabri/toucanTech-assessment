@extends('layouts.main')
@section('content')
    @include("menu")
    <div class="max-w-7xl mx-auto p-6 lg:p-8 bg-white">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <form id="newMemberForm" action="{{ route('member.save') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
                    </div>
                    <div class="form-group">
                        <label for="school">Schools:</label>
                        <select class="form-control" id="school" name="school">
                            <option value="">Select your school</option>
                            @foreach ($schools as $school)
                                <option value="{{$school->uuid}}">{{$school->school_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn- bg-danger float-right" id="submitBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('pageScripts')
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="module" src="{{ asset('js/new-member.js') }}"></script>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
@endpush
