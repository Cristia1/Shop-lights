@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">About Us</div>
                    <div class="card-body">
                        <p>Welcome to our About page! We are a team of dedicated professionals</p>
                        <p></p>

                        <input type="text" id="myInput" value="">
                        <button id="myButton">Send </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#myButton").click(function() {
                var val = $("#myInput").val();
                alert(val);
            });
        });
    </script>
@endsection
<style>
    .card-header {
        font-size: 24px;
        font-weight: bold;
        text-align: center;

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
