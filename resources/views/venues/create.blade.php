@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <h1 class="text-xl font-bold mb-4">Add New Venue</h1>

    <form action="{{ route('admin.venues.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Name</label>
            <input name="name" type="text" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Location</label>
            <input name="location" type="text" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-black text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
