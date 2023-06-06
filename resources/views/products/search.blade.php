@extends('layouts.app')
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Wattage</th>
                <th>Price</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ substr($product->name, 0, 15) }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->wattage }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
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
