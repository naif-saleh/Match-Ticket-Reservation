@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Reserve Tickets</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col">
                            <h5>{{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}</h5>
                            <p>{{ $match->match_date->format('d M Y, H:i') }}</p>
                            <p>Venue: {{ $match->venue->name }}</p>
                            <p>Price per ticket: ${{ number_format($match->ticket_price, 2) }}</p>
                            <p>Available: {{ $match->available_tickets }} tickets</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('tickets.store', $match) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Number of Tickets</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" value="{{ old('quantity', 1) }}"
                                min="1" max="{{ $match->available_tickets }}">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Price</label>
                            <div class="form-control" id="totalPrice">
                                ${{ number_format($match->ticket_price, 2) }}
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Confirm Reservation</button>
                            <a href="{{ route('matches.show', $match) }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const totalPriceDisplay = document.getElementById('totalPrice');
        const pricePerTicket = {{ $match->ticket_price }};

        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value) || 0;
            const total = quantity * pricePerTicket;
            totalPriceDisplay.textContent = '$' + total.toFixed(2);
        }

        quantityInput.addEventListener('input', updateTotalPrice);
    });
</script>
@endpush
@endsection
