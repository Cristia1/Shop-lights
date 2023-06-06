@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="form-group">
                <strong></strong>
                <img src="/images/{{ $product->image }}" width="500px">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 pull-right">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
            <div class="form-group">
                <strong>Brand:</strong>
                {{ $product->brand }}
            </div>
            <div class="form-group">
                <strong>Wattage:</strong>
                {{ $product->wattage }}
            </div>
            <div class="form-group">
                <strong>Price:</strong>
                {{ $product->price }}
            </div>
            <div class="form-group">
                <strong>Descriptions:</strong>
                {{ $product->descriptions }}
            </div>
        </div>
    </div>
@endsection
