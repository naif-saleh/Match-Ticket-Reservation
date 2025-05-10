@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Matches</h1>
        <a href="{{ route('admin.matches.create') }}" class="btn btn-success">Create New Match</a>
    </div>

    @if($matches->isEmpty())
        <div class="alert alert-info">No matches found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Teams</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matches as $match)
                        <tr>
                            <td>{{ $match->id }}</td>
                            <td>{{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}</td>
                            <td>{{ $match->venue->name }}</td>
                            <td>{{ $match->match_date->format('d M Y, H:i') }}</td>
                            <td>${{ number_format($match->ticket_price, 2) }}</td>
                            <td>{{ $match->available_tickets }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.matches.edit', $match) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.matches.destroy', $match) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this match?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $matches->links() }}
        </div>
    @endif
</div>
@endsection
