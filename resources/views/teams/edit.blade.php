@extends('layouts.app')

@section('content')
    <h1>Edit Team</h1>
    <form action="{{ route('admin.teams.update', $team) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
        </div>
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
            @if($team->logo)
                <img src="{{ asset('storage/' . $team->logo) }}" height="50">
            @endif
        </div>
        <button class="btn btn-success">Update</button>
    </form>
@endsection
