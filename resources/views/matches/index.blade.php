@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Upcoming Matches</h1>

    <div class="row">
        @forelse($matches as $match)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white">
                        {{ $match->match_date->format('d M Y, H:i') }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">
                            {{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}
                        </h5>
                        <p class="card-text">
                            <strong>Venue:</strong> {{ $match->venue->name }}<br>
                            <strong>Price:</strong> ${{ number_format($match->ticket_price, 2) }}<br>
                            <strong>Available Tickets:</strong> {{ $match->available_tickets }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('matches.show', $match) }}" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No upcoming matches available.</div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $matches->links() }}
    </div>
</div>
