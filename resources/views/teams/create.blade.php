@extends('layouts.app')

@section('content')
    <h1>Create Team</h1>
    <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
@endsection
