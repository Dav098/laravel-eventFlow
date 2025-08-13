@extends('layouts.app')

@section('content')
<div class="container max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Events</h1>

    @foreach($events as $event)
        <div class="mb-4 border p-4 rounded">
            <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
            <p>{{ \Illuminate\Support\Str::limit($event->description, 150) }}</p>
            <p class="text-sm text-gray-600">
                ({{ $event->start_datetime->format('Y-m-d H:i') }} - {{ $event->end_datetime->format('Y-m-d H:i') }}) — {{ $event->location }}
            </p>
            <p class="text-sm text-green-700 font-semibold">
                Number of available tickets: {{ max(0, $event->available_tickets - $event->sold_tickets) }}
            </p>
            <a href="{{ route('events.show', $event) }}" class="text-blue-500 hover:underline">View details</a>
        </div>
    @endforeach

    {{ $events->links() }}


</div>
@endsection
