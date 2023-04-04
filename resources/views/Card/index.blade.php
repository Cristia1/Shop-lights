@extends('layouts.app')

@section('content')
    <div class="products">
        @if (count($products) > 0)
            @foreach ($products as $product)
                <div class="product">
                    <img class="image" src="/images/{{ $product->image }}" style="width: 200px">
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-divider"></div>
                        <div class="product-price">{{ $product->price }}</div>
                        <div class="product-details">
                            <div>{{ $product->details }}</div>
                        </div>
                        <button class="remove-from-cart-button">Remove from Cart</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-products">No products in cart.</div>
        @endif
    </div>
    <script>
        const xhr = new XMLHttpRequest();
        const removeFromCartUrl = '{{ route('cart.remove') }}';
        const data = JSON.stringify({
            id: productId,
        });

        function removeFromCart(productId) {
            xhr.open('POST', removeFromCartUrl, true);
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log('Produs sters din cosul de cumparaturi!');
                }
            };
            xhr.send(data);
        }

        const removeButtons = document.querySelectorAll('.remove-from-cart-button');
        removeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.parentNode.parentNode.getAttribute('data-id');
                removeFromCart(productId);
            });
        });
    </script>
@endsection

<style>
    .products {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .product {
        margin: 20px;
        display: flex;
        flex-direction: column;
    }
</style>
