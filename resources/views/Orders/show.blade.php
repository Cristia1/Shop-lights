@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Order Details</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price:</td>
                                    <td>{{ $order->price }}</td>
                                </tr>
                                <tr>
                                    <td>Quantity:</td>
                                    <td>{{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    <td>{{ $order->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('orders.index') }}" class="btn btn-default">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
