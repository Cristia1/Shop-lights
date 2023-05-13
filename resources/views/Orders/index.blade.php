@extends('layouts.app')

@section('content')
    <h1>Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->price }}</td>
                    <td><input type="number" name="quantity" value="{{ $order->quantity }}" min="1" max="10"
                            class="order-quantity"></td>

                    <td class="order-total">{{ $order->total }}</td>

                    <td></td>
                    <td>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST">
                            {{-- <a href="{{ route('orders.show', $order) }}">Show</a> --}}
                            @csrf
                            @method('DELETE')
                            <button id="#myButton" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="btn btn-info back-to-shop"><a href="{{ route('shop') }}">Back to Shop</a></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const quantityFields = document.querySelectorAll('.order-quantity');
        quantityFields.forEach(quantityField => {
            quantityField.addEventListener('change', (event) => {
                const newQuantity = event.target.value;
                const price = event.target.parentNode.previousElementSibling.textContent;
                const totalField = event.target.parentNode.nextElementSibling;
                totalField.textContent = (price * newQuantity).toFixed(2);
            });
        });
    </script>
@endsection

<style>
    table {
        width: 60%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 10;
        width: 100%;
        z-index: 999;
        font-size: 15px;
    }

    .navbar-search {
        display: flex;
        align-items: center;
        margin-left: -10px;
        font-size: 24px;
    }

    .btn-info {
        position: fixed;
        bottom: 30px;
        right: 50px;
        font-size: 24px;

    }
</style>
