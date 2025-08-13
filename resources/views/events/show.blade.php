@extends('layouts.app')

@section('content')
<div class="container max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-2">{{ $event->title }}</h1>
    <p class="text-gray-700">{{ $event->description }}</p>
    <p class="mt-2"><strong>Location:</strong> {{ $event->location }}</p>
    <p><strong>When:</strong> {{ $event->start_datetime }} — {{ $event->end_datetime }}</p>
    <p class="text-sm text-green-700 font-semibold">
            Number of available tickets: {{ $event->available_tickets - $event->sold_tickets }}
            </p>
            @auth
            @if(auth()->user()->isUser())
                    <div class="mt-6">
                        <a href="{{ route('tickets.purchase.form', $event->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded">Buy a ticket</a>
                    </div>
                @endif
            @endauth

</div>
@endsection
