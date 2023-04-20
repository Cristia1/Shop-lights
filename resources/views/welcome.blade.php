@extends('layouts.app')

@section('content')
    <nav class="navbar">
        <ul>
            <li><a href="{{ route('home') }}">Acasă<span></span></a></li>
            <li><a href="{{ route('about') }}">Despre noi<span></span></a></li>

        </ul>
    </nav>
@endsection

<style>
    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 20px;
        position: relative;
    }
</style>
