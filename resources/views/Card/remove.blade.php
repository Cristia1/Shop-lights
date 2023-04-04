@extends('layouts.app')
@section('content')
    <div class="cart-item">
        <div class="product-info">
            <div class="product-name">{{ $cartItem->name }}</div>
            <div class="product-divider"></div>
            <div class="product-price">{{ $cartItem->price }}</div>
            <div class="product-details">{{ $cartItem->details }}</div>
            <button class="remove-from-cart-button" data-product-id="{{ $cartItem->id }}">Remove from Cart</button>
        </div>
    </div>
    <script>
        const removeFromCartButton = document.querySelector('.remove-from-cart-button');
        const productId = removeFromCartButton.dataset.productId;
        const xhr = new XMLHttpRequest();
        const url = '/cart/' + productId;

        removeFromCartButton.addEventListener('click', () => {
            xhr.open('DELETE', url, true);
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.onreadystatechange = function() {

