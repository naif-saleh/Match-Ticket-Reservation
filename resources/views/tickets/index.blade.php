@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">My Tickets</h1>

    @if($tickets->isEmpty())
        <div class="alert alert-info">You don't have any tickets yet.</div>
        <a href="{{ route('matches.index') }}" class="btn btn-primary">Browse Matches</a>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Match</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{ $ticket->match->homeTeam->name }} vs {{ $ticket->match->awayTeam->name }}</td>
                            <td>{{ $ticket->match->match_date->format('d M Y, H:i') }}</td>
                            <td>{{ $ticket->quantity }}</td>
                            <td>${{ number_format($ticket->total_price, 2) }}</td>
                            <td>
                                @if($ticket->status == 'reserved')
                                    <span class="badge bg-warning">Reserved</span>
                                @elseif($ticket->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-primary">View</a>

                                @if($ticket->status == 'reserved' && !$ticket->match->match_date->isPast())
                                    <form method="POST" action="{{ route('tickets.cancel', $ticket) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
