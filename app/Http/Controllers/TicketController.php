<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Matche;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TicketController extends Controller
{
     

    public function index()
    {
        $tickets = Ticket::with('match.homeTeam', 'match.awayTeam')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create(Matche $match)
    {
        if ($match->available_tickets <= 0 || $match->match_date->isPast()) {
            return redirect()->route('matches.show', $match)->with('error', 'Tickets are not available for this match');
        }

        return view('tickets.create', compact('match'));
    }

    public function store(Request $request, Matche $match)
    {
        $validated = $request->validate([
            'quantity' => "required|integer|min:1|max:{$match->available_tickets}",
        ]);

        if ($match->available_tickets <= 0 || $match->match_date->isPast()) {
            return redirect()->route('matches.show', $match)->with('error', 'Tickets are no longer available');
        }

        try {
            DB::beginTransaction();

            $totalPrice = $match->ticket_price * $validated['quantity'];
            $ticketNumber = 'TKT-' . strtoupper(Str::random(8));

            $ticket = Ticket::create([
                'match_id' => $match->id,
                'user_id' => auth()->id(),
                'ticket_number' => $ticketNumber,
                'quantity' => $validated['quantity'],
                'total_price' => $totalPrice,
                'status' => 'reserved',
            ]);

            $match->decrement('available_tickets', $validated['quantity']);

            DB::commit();

            return redirect()->route('tickets.show', $ticket)->with('success', 'Tickets reserved successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('matches.show', $match)->with('error', 'Failed to reserve tickets. Please try again.');
        }
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->load('match.homeTeam', 'match.awayTeam', 'match.venue');
        return view('tickets.show', compact('ticket'));
    }

    public function cancelReservation(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id() || $ticket->status !== 'reserved') {
            abort(403);
        }

        try {
            DB::beginTransaction();

            $ticket->update(['status' => 'cancelled']);
            $ticket->match->increment('available_tickets', $ticket->quantity);

            DB::commit();

            return redirect()->route('tickets.index')->with('success', 'Reservation cancelled successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to cancel reservation. Please try again.');
        }
    }

    // Payment processing would go here in a real application
    public function processPayment(Ticket $ticket)
    {
        if ($ticket->user_id !== auth()->id() || $ticket->status !== 'reserved') {
            abort(403);
        }

        // Simulate payment processing
        $ticket->update(['status' => 'paid']);

        return redirect()->route('tickets.show', $ticket)->with('success', 'Payment processed successfully');
    }
}
