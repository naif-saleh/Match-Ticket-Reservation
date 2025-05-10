@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $venue->name }}</h1>

    <p><strong>Location:</strong> {{ $venue->location }}</p>

    <div class="mt-4 space-x-2">
        <a href="{{ route('admin.venues.edit', $venue) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
        <a href="{{ route('admin.venues.index') }}" class="bg-gray-300 text-black px-3 py-1 rounded hover:bg-gray-400">Back</a>
    </div>
</div>
@endsection
