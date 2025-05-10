@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <h1 class="text-xl font-bold mb-4">Edit Venue</h1>

    <form action="{{ route('admin.venues.update', $venue) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Name</label>
            <input name="name" type="text" value="{{ old('name', $venue->name) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Location</label>
            <input name="location" type="text" value="{{ old('location', $venue->location) }}" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
    </form>
</div>
@endsection
