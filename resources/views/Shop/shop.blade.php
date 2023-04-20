@extends('layouts.app')

@section('content')
    <div class="container product-list">
        <div class="image-grid">
            @foreach ($products as $product)
                @csrf

                @php
                    $details = [
                        'name' => $product->Name,
                        'image' => $product->image,
                        'descriptions' => $product->descriptions,
                    ];

                    $details['price'] = $product->price;
                @endphp

                <div class="image">
                    <div class="image-border">
                        <div class="grid-item product-name">
                            {{ \Illuminate\Support\Str::limit($product->name, $limit = 15, $end = '...') }}</div>
                        <div class="grid-item"></div>
                    </div>
                    <img src="/images/{{ $product->image }}" style="width: 500px" data-id="{{ $product->id }}">
                </div>
            @endforeach

        </div>
    </div>

    <script>
        // pune evenimentul de click pe fiecare imagine
        const images = document.querySelectorAll('.image');
        images.forEach(image => {
            image.addEventListener('click', () => {
                // ia id-ul imaginii din atributul data-id
                const id = image.querySelector('img').getAttribute('data-id');
                // redirectioneaza utilizatorul la ruta corespunzatoare
                window.location.href = `/shop/bag/${id}`;
            });
        });
    </script>
@endsection

<!-- CSS -->
<style>
    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
        position: relative;
    }

    .image {
        max-width: 100%;
        cursor: pointer;
        z-index: 2;
        position: relative;
    }

    .image:after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .image img {
        max-width: 100%;
        height: auto;
        transition: transform 0.2s ease-in-out;
    }

    .image:hover img {
        transform: scale(1.05);
    }

    .image-border {
        position: absolute;
        top: 10px;
        left: 25px;
        right: 25px;
        bottom: 425px;
        background-color: rgba(240, 237, 237, 0.5);
    }

    .div {
        display: grid;
        grid-gap: 20px;
        position: relative;
        z-index: 3;
    }

    .product-name {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
