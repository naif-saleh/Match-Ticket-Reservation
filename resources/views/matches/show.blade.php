@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Match Details</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-5">
                            <h5>{{ $match->homeTeam->name }}</h5>
                        </div>
                        <div class="col-2">
                            <h5>VS</h5>
                        </div>
                        <div class="col-5">
                            <h5>{{ $match->awayTeam->name }}</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Date & Time:</strong> {{ $match->match_date->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Venue:</strong> {{ $match->venue->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Ticket Price:</strong> ${{ number_format($match->ticket_price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Available Tickets:</strong> {{ $match->available_tickets }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p><strong>Location:</strong> {{ $match->venue->location }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @auth
                        @if($match->available_tickets > 0 && !$match->match_date->isPast())
                            <a href="{{ route('tickets.create', $match) }}" class="btn btn-success w-100">Reserve Tickets</a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Tickets Not Available</button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Login to Reserve</a>
                    @endauth
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('matches.index') }}" class="btn btn-outline-primary">Back to Matches</a>
            </div>
        </div>
    </div>
</div>
@endsection
