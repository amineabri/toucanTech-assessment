<div class="max-w-7xl mx-auto p-6 lg:p-8 bg-white">
    <div class="row">
        <div class="col-md-12 float-right">
            <form>
                <div class="form-group">
                    @csrf
                    <select name="country" id="country" class="form-control">
                        <option value="">Filter by Countries</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->uuid }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn- bg-danger float-right">Filter</button>
            </form>
        </div>
    </div>
    <div class="row p-5">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>School Name</th>
                    <th>Number of members</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $item->school_name }}</td>
                        <td>{{ isset($item->members) ? $item->members->count() : 0 }}</td>
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
