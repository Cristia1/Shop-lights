@extends('lights.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('lights.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="form-group">
                <strong></strong>
                <img src="/images/{{ $light->image }}" width="500px">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 pull-right">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $light->name }}
            </div>

            <div class="form-group">
                <strong>Years:</strong>
                {{ $light->years }}
            </div>

            <div class="form-group">
                <strong>Details:</strong>
                {{ $light->details }}
            </div>

            <div class="form-group">
                <strong>Price:</strong>
                {{ $light->price }}
            </div>
        </div>
    </div>
@endsection
