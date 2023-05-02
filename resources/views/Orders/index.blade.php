able File  98 lines (86 sloc)  2.85 KB


@extends('layouts.app')

@section('content')
    <h1>Orders</h1>

    <table class="table" route"{{ 'updete' }}">
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
                            <a href="{{ route('orders.show', $order) }}">Show</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <tr>
        <div class="btn back-to-shop"><a href="{{ route('shop') }}">Back to Shop</a></div>
    </tr>
    <script>
        // Obțineți toate elementele de câmp de cantitate
        const quantityFields = document.querySelectorAll('.order-quantity');
        // Parcurgeți toate elementele de câmp de cantitate și adăugați un eveniment de schimbare a valorii
        quantityFields.forEach(quantityField => {
            quantityField.addEventListener('change', (event) => {
                const newQuantity = event.target.value; // Obțineți noua cantitate
                const price = event.target.parentNode.previousElementSibling.textContent; // Obțineți prețul
                const totalField = event.target.parentNode.nextElementSibling; // Obțineți câmpul de total
                // Actualizați valoarea câmpului de total
                totalField.textContent = (price * newQuantity).toFixed(2);
            });
        });
        $(document).ready(function() {
            $("#myButton").click(function() {
                var val = $("myButton").val();
                alert('Are you sure you want to delete', val);
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

    .back-to-shop {
        position: fixed;
        bottom: 50px;
        right: 600px;
        font-size: 24px;
    }

    .back-to-shop {
        position: fixed;
        bottom: 20px;
        right: 100px;
        top: 100px;
        font-size: 24px;
    }
</style>
