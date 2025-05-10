@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Match</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.matches.update', $match) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="home_team_id" class="form-label">Home Team</label>
                                <select class="form-select @error('home_team_id') is-invalid @enderror" id="home_team_id" name="home_team_id">
                                    <option value="">Select Home Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ (old('home_team_id', $match->home_team_id) == $team->id) ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('home_team_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="away_team_id" class="form-label">Away Team</label>
                                <select class="form-select @error('away_team_id') is-invalid @enderror" id="away_team_id" name="away_team_id">
                                    <option value="">Select Away Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ (old('away_team_id', $match->away_team_id) == $team->id) ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('away_team_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="venue_id" class="form-label">Venue</label>
                            <select class="form-select @error('venue_id') is-invalid @enderror" id="venue_id" name="venue_id">
                                <option value="">Select Venue</option>
                                @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ (old('venue_id', $match->venue_id) == $venue->id) ? 'selected' : '' }}>
                                        {{ $venue->name }} ({{ $venue->location }})
                                    </option>
                                @endforeach
                            </select>
                            @error('venue_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="match_date" class="form-label">Match Date & Time</label>
                            <input type="datetime-local" class="form-control @error('match_date') is-invalid @enderror"
                                id="match_date" name="match_date" value="{{ old('match_date', $match->match_date->format('Y-m-d\TH:i')) }}">
                            @error('match_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="ticket_price" class="form-label">Ticket Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control @error('ticket_price') is-invalid @enderror"
                                        id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $match->ticket_price) }}">
                                </div>
                                @error('ticket_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="available_tickets" class="form-label">Available Tickets</label>
                                <input type="number" class="form-control @error('available_tickets') is-invalid @enderror"
                                    id="available_tickets" name="available_tickets" value="{{ old('available_tickets', $match->available_tickets) }}">
                                @error('available_tickets')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Match</button>
                            <a href="{{ route('admin.matches.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
