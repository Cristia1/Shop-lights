@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Card Payment') }}</div>

                    <div class="card-body">
                        {{-- <form method="POST" action="{{ route('payment.card') }}"> --}}
                        @csrf
                        <div class="form-group">
                            <label for="cardholder-name">{{ __('Numele de pe card') }}</label>
                            <input id="cardholder-name" type="text" class="form-control" name="cardholder_name" required>
                        </div>

                        <div class="form-group">
                            <label for="card-number">{{ __('Numărul cardului') }}</label>
                            <input id="card-number" type="text" class="form-control" name="card_number" required>
                        </div>

                        <div class="form-group">
                            <label for="expiration-date">{{ __('Data expirării') }}</label>
                            <input id="expiration-date" type="text" class="form-control" name="expiration_date" required>
                        </div>

                        <div class="form-group">
                            <label for="cvv">{{ __('CVV') }}</label>
                            <input id="cvv" type="text" class="form-control" name="cvv" required>
                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        <button type="submit" class="btn btn-primary">{{ __('Plătește') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
