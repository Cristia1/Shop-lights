@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="text-center">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
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
            <th width="180px">Image</th>
            <th width="160px">Name</th>
            <th>Brand</th>
            <th width="40px">Wattage</th>
            <th>Price</th>
            <th>Descriptions</th>
            <th width="210px">Action</th>
        </tr>
        {{-- Defind variable --}}
        @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <th><img src="{{ asset('images/' . $product->image) }}" style="width: 150px; height:90px">
                <td>{{ substr($product->name, 0, 15) }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->wattage }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ substr($product->descriptions, 0, 15) }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
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
