@extends('layouts.app')
@section('content')
    <div class="product-details">
        <div class="product-details-left">
            <img class="image" src="{{ asset('images/' . $product->image) }}" style="width: 500px">
            <div class="product-info">
                <div class="product-names">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-brand">
                        <h1>{{ $product->brand }}</h1>
                    </div>
                    <div class="product-wattage">{{ $product->wattage }}</div>
                </div>
                <div class="product-price-container">
                    <div class="product-price">{{ $product->price }}$</div>
                </div>
            </div>
        </div>
        <div class="product-details-right">
            <div class="product-descriptions">
                <div>{{ $product->descriptions }}</div>
            </div>
            <form method="POST" action="{{ route('orders.store') }}" class="my-form">
                @csrf
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="product_price" value="{{ $product->price }}">
                <input type="number" name="quantity" value="1">
                <button type="submit">Add to Cart</button>
            </form>

        </div>
    </div>
@endsection

<script>
    function addToCart() {
        const form = document.querySelector('.my-form');
        const formData = new FormData(form);
        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // actualizează numărul de produse din coș
                    $('.navbar-nav .badge').text(sessionStorage.getItem('cart_count'));
                    $('#cart-count-menu').text(sessionStorage.getItem('cart_count'));
                } else {
                    throw new Error('A apărut o eroare! Vă rugăm să încercați din nou mai târziu.');
                }
            })
            .catch(error => {
                alert(error.message);
            });
    }

    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            addToCart();
        });

        $('input[name="quantity"]').change(function() {
            sessionStorage.setItem('cart_count', $(this).val());
        });
    });
</script>

<style>
    .image {
        margin-left: 20%;
        margin-top: 3%;
    }

    .product-price {
        font-size: 20px;
        font-weight: bold;
        margin-top: 2%;
        color: rgb(210, 106, 8);
        font-family: Arial, sans-serif;
        margin-right: 20px;
    }

    .product-name {
        position: absolute;
        top: 29;
        right: 100;
        font-size: 20px;
        font-weight: bold;
        color: rgb(16, 1, 9);
        font-family: Arial, sans-serif;
        margin-top: 120px;
        margin-right: 500px;
        /* Schimbați această valoare pentru a ajusta distanța între nume și margine */
    }

    .product-brand {
        position: absolute;
        top: 10;
        right: -200;
        font-size: 16px;
        color: rgb(16, 1, 9);
        font-family: Arial, sans-serif;
        margin-top: 80px;
        /* Ajustați această valoare pentru a poziționa marca */
        margin-right: 650px;
        /* Schimbați această valoare pentru a ajusta distanța între marcă și margine */
    }

    .product-wattage {
        position: absolute;
        top: -77;
        right: -150;
        font-size: 22px;
        color: rgb(16, 1, 9);
        font-family: Arial, sans-serif;
        margin-top: 450px;
        /* Ajustați această valoare pentru a poziționa wattage-ul */
        margin-right: 700px;
        /* Schimbați această valoare pentru a ajusta distanța între wattage și margine */
    }

    .product-price-container {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .product-price {
        font-size: 30px;
        font-weight: bold;
        margin-top: 200%;
        color: rgb(210, 106, 8);
        font-family: Arial, sans-serif;
        margin-left: -750%;
    }

    .product-details-right {
        margin-top: -10%;
        margin-left: 47%;
        font-size: 20px;
    }

    .my-form {


        margin-top: 20;

    }
</style>
