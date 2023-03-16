@extends('layouts.main')
@section('content')
    @include("menu")
    <div class="max-w-7xl mx-auto p-6 lg:p-8 bg-white">
        <div class="row">
            <div class="col-md-12 float-right">
                <form class="float-right">
                    <div class="form-group">
                        @csrf
                        <select name="school" id="school" class="form-control">
                            <option value="">Filter by school</option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->uuid }}">{{ $school->school_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn- bg-danger">Filter</button>
                </form>
                <a href="{{ route('member.save.form') }}" class="btn btn- bg-danger float-left p-1 mr-1">Add a new member</a>
                <a href="{{ route("download.csv") }}" class="btn btn- bg-danger float-left p-1 mr-1">Download CSV</a>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>School Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->school->school_name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"><div class="text-center">{{ __('No Records Found :(') }}</div></td>
                        </tr>
                    @endforelse
                    <tfoot>
                    <tr>
                        <th>{{ $items->onEachSide(10)->links('pagination::bootstrap-4') }}</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('pageScripts')

@endpush
