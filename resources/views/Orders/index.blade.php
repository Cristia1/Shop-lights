@extends('layouts.app')

@section('content')
    <h1>
        <div class="TotalPayment"> Total payment <span id="totalAmount"></span>$</div>
    </h1>

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
                    <td>
                        <input type="number" name="quantity" value="{{ $order->quantity }}" min="1" max="10"
                            class="order-quantity">
                    </td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <form action="{{ route('orders.destroy', $order->id_order) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="btn btn-angular GoTo">
        <a href="{{ route('payment.card') }}" method="POST">Go to the payment</a>
    </div>

    <div class="btn btn-info back-to-shop">
        <a href="{{ route('shop') }}">Back to Shop</a>
    </div>


    <script>
        const quantityFields = document.querySelectorAll('.order-quantity');
        const totalAmountField = document.getElementById('totalAmount');

        function calculateTotalAmount() {
            let totalAmount = 0;

            quantityFields.forEach(quantityField => {
                const quantity = parseInt(quantityField.value);
                const price = parseFloat(quantityField.parentNode.previousElementSibling.textContent);
                const total = price * quantity;
                totalAmount += total;
            });

            return totalAmount.toFixed(2);
        }

        quantityFields.forEach(quantityField => {
            quantityField.addEventListener('change', () => {
                const totalAmount = calculateTotalAmount();
                totalAmountField.textContent = totalAmount;
            });
        });

        const initialTotalAmount = calculateTotalAmount();
        totalAmountField.textContent = initialTotalAmount;
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
        font-size: 29%;

    }

    .TotalPayment {
        margin-left: 450px;
    }

    .GoTo {
        margin-left: 450px;
        background-color: rgb(255, 255, 0);
        color: black;
        top: 0;
        left: 33%;
        width: 200px;
        height: 60px;
        z-index: 999;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
