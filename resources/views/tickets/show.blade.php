@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Ticket Details</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>{{ $ticket->match->homeTeam->name }} vs {{ $ticket->match->awayTeam->name }}</h5>
                        <p>{{ $ticket->match->match_date->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Ticket Number:</strong></p>
                            <div class="bg-light p-2 border">{{ $ticket->ticket_number }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Status:</strong></p>
                            @if($ticket->status == 'reserved')
                                <div class="bg-warning text-dark p-2 text-center">Reserved</div>
                            @elseif($ticket->status == 'paid')
                                <div class="bg-success text-white p-2 text-center">Paid</div>
                            @else
                                <div class="bg-danger text-white p-2 text-center">Cancelled</div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Venue:</strong> {{ $ticket->match->venue->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Location:</strong> {{ $ticket->match->venue->location }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Quantity:</strong> {{ $ticket->quantity }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Total Price:</strong> ${{ number_format($ticket->total_price, 2) }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <p><strong>Reserved On:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        @if($ticket->status == 'paid')
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <h5>Ticket QR Code</h5>
                                <div class="text-center py-3">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($ticket->ticket_number) }}"
                                        alt="Ticket QR Code" class="img-fluid">
                                </div>
                                <p class="text-center mb-0">Present this QR code at the venue entrance</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    @if($ticket->status == 'reserved' && !$ticket->match->match_date->isPast())
                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('tickets.payment', $ticket) }}">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">Pay Now</button>
                            </form>

                            <form method="POST" action="{{ route('tickets.cancel', $ticket) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirm('Are you sure you want to cancel this reservation?')">
                                    Cancel Reservation
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary">Back to My Tickets</a>
            </div>
        </div>
    </div>
