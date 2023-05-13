@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Order Details</div>
                    <div class="panel-body order-details">
                        <form method="POST" action="{{ route('orders.update', $order) }}">
                            @csrf
                            @method('PUT')
                            <div class="name">
                                <label>Name:</label>
                                <span>{{ $order->name }}</span>
                            </div>
                            <div class="price">
                                <label>Price:</label>
                                <span>{{ $order->price }}</span>
                            </div>
                            <div class="quantity">
                                <label>Quantity:</label>
                                <span>{{ $order->quantity }}</span>
                            </div>
                            <div class="total">
                                <label>Total:</label>
                                <span>{{ $order->total }}</span>
                            </div>
                            <div class="btn">
                                <a class="buttonOrders" href="{{ route('orders.index') }}">Back to Orders</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .order-details label {
        font-size: 20px;
        font-weight: bold;
    }

    .order-details span {
        font-size: 24px;
        margin-left: 20px;
    }



    .buttonOrders {
        margin-left: 400px;
    }
</style>
