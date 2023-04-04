@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Years</th>
                <th>price</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($lights as $light)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ substr($light->name, 0, 15) }}</td>
                    <td>{{ $light->years }}</td>
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
        </tbody>
        @endforeach
    </table>
@endsection
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
