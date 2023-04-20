@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About Us</div>
                    <div class="card-body">
                        <p>Welcome to our About page! We are a team of dedicated professionals with a passion for creating
                            innovative solutions to meet the needs of our clients. Our company was founded with a mission to
                            provide top-quality products and services that exceed expectations. We pride ourselves on our
                            attention to detail, our commitment to excellence, and our ability to deliver results that make
                            a real difference for our customers. In this page, you will learn more about our history, our
                            values, and our team, as well as the products and services we offer. Thank you for taking the
                            time to get to know us!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .card-header {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 1px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }


    .navbar {
        height: 60px;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar-search {
        margin-left: auto;
    }
</style>
