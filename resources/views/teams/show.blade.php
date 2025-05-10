@extends('layouts.app')

@section('content')
    <h1>{{ $team->name }}</h1>
    @if($team->logo)
        <img src="{{ asset('storage/' . $team->logo) }}" height="100" alt="Logo">
    @endif
    <p><a href="{{ route('admin.teams.index') }}">Back</a></p>
@endsection
