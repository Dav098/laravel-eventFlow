@extends('layouts.app')

@section('content')
<div class="container max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">My tickets</h1>

    @forelse ($tickets as $ticket)
        <div class="mb-4 p-4 border rounded">
            <p class="font-semibold">Event: {{ $ticket->event->title }}</p>
            <p>Location: {{ $ticket->event->location }}</p>
            <p>Event date: {{ $ticket->event->start_datetime->format('d.m.Y H:i') }}</p>
            <p>Name of Ticket Holder: {{ $ticket->first_name  }} {{ $ticket->last_name}} </p>
        </div>
    @empty
        <p>You don't have any tickets yet</p>
    @endforelse
</div>
@endsection
