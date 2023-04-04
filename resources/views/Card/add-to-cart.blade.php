@extends('layouts.app')

@section('content')

    {{-- <div class="product-details">
        <img class="image" src="/images/{{ $light->image }}" style="width: 500px">
        <div class="product-info">
            <div class="product-name">{{ $light->name }}</div>
            <div class="product-divider"></div>
            <div class="product-price">{{ $light->price }}</div>
            <div class="product-details">
                <div>{{ $light->details }}</div>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="name" value="{{ $light->name }}">
                <input type="hidden" name="price" value="{{ $light->price }}">
                <button class="add-to-cart-button">Adaugă în coș</button>
            </form>

        </div>
    </div> --}}
