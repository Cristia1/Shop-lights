@extends('layouts.app')
@section('content')
    <div class="product-details">
        <img class="image" src="/images/{{ $light->image }}" style="width: 500px">
        <div class="product-info">
            <div class="product-name">{{ $light->name }}</div>
            <div class="product-divider"></div>
            <div class="product-price">{{ $light->price }}</div>
            <div class="product-details">
                <div>{{ $light->details }}</div>
            </div>
            <button class="add-to-cart-button">Add to Cart</button>
        </div>
    </div>
    <script>
        const productId = 123;
        const xhr = new XMLHttpRequest();
        const addToCartUrl = '{{ route('cart.add') }}';
        const removeFromCartUrl = '{{ route('cart.remove') }}';
        const data = JSON.stringify({
            id: productId,
            image: '{{ $light->image }}',
            name: '{{ $light->name }}',
            price: '{{ $light->price }}',
            details: '{{ $light->details }}',
        });

        function addToCart() {
            xhr.open('POST', addToCartUrl, true);
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Produs adaugat in cosul de cumparaturi!');
                }
            };
            xhr.send(data);
        }

        function removeFromCart() {
            xhr.open('POST', removeFromCartUrl, true);
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Produs sters din cosul de cumparaturi!');
                }
            };
            xhr.send(data);
        }
    </script>
@endsection
<style>
    .image {
        margin-left: 60px;
        margin-top: -19%;
    }

    .product-details {
        display: flex;
        align-items: center;
    }

    .product-info {
        margin-left: 20px;
    }

    .product-name {
        font-size: 22px;
        font-weight: bold;
        margin-top: -57%;
    }

    .product-price {
        font-size: 30px;
        font-weight: bold;
        margin-top: 1%;
    }

    .product-price {
        color: rgb(210, 106, 8);
        font-family: Arial, sans-serif;
    }

    .product-name {
        color: rgb(16, 1, 9);
        font-family: Arial, sans-serif;
    }


    .product-details {
        margin-top: 250px;
        font-size: 13px;
    }

    .add-to-cart-button {
        display: block;
        margin: 0 auto;
        color: rgb(235, 28, 13);
        margin-top: -40%;
        font-size: 13px;
    }
</style>
