@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="text-center">
                <a class="btn btn-success" href="{{ route('lights.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Years</th>
            <th>Details</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        {{-- Defind variable --}}
        @foreach ($lights as $light)
            <tr>
                <td>{{ ++$i }}</td>
                <th><img src="{{ asset('images/' . $light->image) }}" style="width: 150px; height:65px">
                <td>{{ substr($light->name, 0, 15) }}</td>
                <td>{{ $light->years }}</td>
                <td>{{ substr($light->details, 0, 15) }}</td>
                <td>{{ $light->price }}</td>
                <td>
                    <form action="{{ route('lights.destroy', $light->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('lights.show', $light->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('lights.edit', $light->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>
    {{-- {!! $lights->links() !!} --}}
@endsection
{{-- CSS --}}
<style>
    table {
        width: 60%;
        max-width: 1200px;
        margin: 0 auto;

    }

    .navbar {
        height: 60px;

    }

    .navbar-search {
        display: flex;
        align-items: center;
        margin-left: -10px;
    }
</style>
