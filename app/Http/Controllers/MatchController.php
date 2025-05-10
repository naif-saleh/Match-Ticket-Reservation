<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matche;
use App\Models\Team;
use App\Models\Venue;

class MatchController extends Controller
{
     public function index()
    {
        $matches = Matche::with(['homeTeam', 'awayTeam', 'venue'])
            ->where('match_date', '>=', now())
            ->orderBy('match_date')
            ->paginate(10);

        return view('matches.index', compact('matches'));
    }

    // Public show: match details
    public function show(Matche $match)
    {
        $match->load(['homeTeam', 'awayTeam', 'venue']);
        return view('matches.show', compact('match'));
    }

    // Admin: list all matches
    public function adminIndex()
    {
        $matches = Matche::with(['homeTeam', 'awayTeam', 'venue'])
            ->orderBy('match_date')
            ->paginate(10);

        return view('admin.matches.index', compact('matches'));
    }

    // Admin: show create form
    public function create()
    {
        $teams = Team::all();
        $venues = Venue::all();
        return view('admin.matches.create', compact('teams', 'venues'));
    }

    // Admin: store new match
    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team_id'      => 'required|exists:teams,id',
            'away_team_id'      => 'required|exists:teams,id|different:home_team_id',
            'venue_id'          => 'required|exists:venues,id',
            'match_date'        => 'required|date|after:now',
            'ticket_price'      => 'required|numeric|min:0',
            'available_tickets' => 'required|integer|min:1',
        ]);

        Matche::create($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match created successfully.');
    }

    // Admin: show edit form
    public function edit(Matche $match)
    {
        $teams = Team::all();
        $venues = Venue::all();
        return view('admin.matches.edit', compact('match', 'teams', 'venues'));
    }

    // Admin: update match
    public function update(Request $request, Matche $match)
    {
        $validated = $request->validate([
            'home_team_id'      => 'required|exists:teams,id',
            'away_team_id'      => 'required|exists:teams,id|different:home_team_id',
            'venue_id'          => 'required|exists:venues,id',
            'match_date'        => 'required|date|after:now',
            'ticket_price'      => 'required|numeric|min:0',
            'available_tickets' => 'required|integer|min:1',
        ]);

        $match->update($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match updated successfully.');
    }

    // Admin: delete match
    public function destroy(Matche $match)
    {
        $match->delete();

        return redirect()->route('admin.matches.index')
            ->with('success', 'Match deleted successfully.');
    }
}
