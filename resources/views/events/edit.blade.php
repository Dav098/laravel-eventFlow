@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Event</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('events.update', $event->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea name="description" required class="w-full border p-2 rounded">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="location">Location</label>
            <input type="text" name="location" value="{{ old('location', $event->location) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="start_datetime">Start</label>
            <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', $event->start_datetime->format('Y-m-d\TH:i')) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="end_datetime">End</label>
            <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime', $event->end_datetime->format('Y-m-d\TH:i')) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="available_tickets">Number of available tickets</label>
            <input type="number" name="available_tickets" min="1" value="{{ old('available_tickets', $event->available_tickets) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="price">Price (USD)</label>
            <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $event->price) }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="is_online">
                <input type="checkbox" name="is_online" id="is_online" value="1" {{ old('is_online', $event->is_online) ? 'checked' : '' }}>
                Visible / Online
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Event</button>
    </form>
</div>
@endsection
