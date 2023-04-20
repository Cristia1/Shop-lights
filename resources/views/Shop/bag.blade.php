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
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_image" value="{{ $product->image }}">
                        <input type="hidden" name="product_name" value="{{ $product->name }}">
                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                        <input type="number" name="quantity" value="1">
                        <button type="submit">Add to Cart</button>
                    </form>

                </div>
            </div>
        @endsection

        <style>
            .image {
                margin-left: 60px;
                margin-top: 0%;
            }

            .product-price {
                font-size: 30px;
                font-weight: bold;
                margin-top: 1%;
                color: rgb(210, 106, 8);
                font-family: Arial, sans-serif;
                margin-right: 20px;
            }

            .product-name {
                position: absolute;
                top: 0;
                right: 0;
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
                top: 0;
                right: 0;
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
                top: 0;
                right: 0;
                font-size: 16px;
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
                margin-left: -300%;
            }

            .product-details-right {
                margin-top: -6%;
                margin-left: 45%;
                font-size: 20px;
            }

            .my-form {
                background-color: #f49b9b;
                padding: 10px;
                margin-top: -10px;
                border: 1px solid rgb(177, 187, 239);
            }
        </style>
