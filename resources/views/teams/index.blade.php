@extends('layouts.app')

@section('content')
    <h1>Teams</h1>
    <a href="{{ route('admin.teams.create') }}" class="btn btn-primary mb-2">Add Team</a>

    @foreach ($teams as $team)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $team->name }}</h5>
                @if($team->logo)
                    <img src="{{ asset('storage/' . $team->logo) }}" height="50" alt="Logo">
                @endif
                <a href="{{ route('admin.teams.show', $team) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $teams->links() }}
@endsection
