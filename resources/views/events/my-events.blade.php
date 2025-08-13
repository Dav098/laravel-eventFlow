@extends('layouts.app')

@section('content')
<div class="container max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">My events</h1>

    @if ($events->isEmpty())
        <p>You haven't created any events yet.</p>
    @else
        <ul>
            @foreach ($events as $event)
            <li class="mb-4 border-b pb-2">
                <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                <p>{{ $event->description }}</p>
                <p class="text-sm text-gray-500">
                    {{ $event->start_datetime->format('Y-m-d H:i') }} — {{ $event->end_datetime->format('Y-m-d H:i') }}
                </p>
                <p>Status:
                    @if($event->is_online)
                        <span class="text-green-600 font-semibold">Visible</span>
                    @else
                        <span class="text-red-600 font-semibold">Hidden</span>
                    @endif
                </p>
                <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:underline">View details</a>
                <a href="{{ route('events.edit', $event->id) }}" class="text-yellow-600 hover:underline ml-4">Edit</a>
            </li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('events.create') }}" class="text-blue-600 hover:underline">+ Create an event</a>
</div>
@endsection
