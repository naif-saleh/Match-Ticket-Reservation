@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Venues</h1>
        <a href="{{ route('admin.venues.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Venue</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <a href="{{ route('admin.venues.create') }}" class="inline-block bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition duration-300 ease-in-out">Add Venue</a>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border-b">Name</th>
                    <th class="p-3 border-b">Location</th>
                    <th class="p-3 border-b text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($venues as $venue)
                    <tr>
                        <td class="p-3 border-b">{{ $venue->name }}</td>
                        <td class="p-3 border-b">{{ $venue->location }}</td>
                        <td class="p-3 border-b text-right space-x-2">
                            <a href="{{ route('admin.venues.show', $venue) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.venues.edit', $venue) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-3 text-center">No venues found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $venues->links() }}
    </div>
</div>
@endsection
