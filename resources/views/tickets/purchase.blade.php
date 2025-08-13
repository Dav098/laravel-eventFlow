@extends('layouts.app')

@section('content')
<div class="container max-w-xl mx-auto bg-white p-6 rounded shadow mt-6">
    <h2 class="text-xl font-bold mb-4">Buy tickets for: {{ $event->title }}</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tickets.purchase', $event->id) }}">
        @csrf

        <div id="ticket-form-wrapper">
            <div class="ticket-entry mb-4 border-b pb-4">
                <label class="block mb-2 font-semibold">First name:</label>
                <input type="text" name="tickets[0][first_name]" required class="border p-2 rounded w-full mb-2">

                <label class="block mb-2 font-semibold">Last name:</label>
                <input type="text" name="tickets[0][last_name]" required class="border p-2 rounded w-full">
            </div>
        </div>

        <button type="button" id="add-ticket" class="bg-gray-300 text-gray-700 px-3 py-1 rounded mb-4 hover:bg-gray-400">
            + Add another ticket
        </button>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Buy
        </button>
    </form>
</div>

<script>
    let ticketIndex = 1;
    document.getElementById('add-ticket').addEventListener('click', function () {
        const wrapper = document.getElementById('ticket-form-wrapper');
        const entry = document.createElement('div');
        entry.classList.add('ticket-entry', 'mb-4', 'border-b', 'pb-4');
        entry.innerHTML = `
            <label class="block mb-2 font-semibold">Imię:</label>
            <input type="text" name="tickets[${ticketIndex}][first_name]" required class="border p-2 rounded w-full mb-2">

            <label class="block mb-2 font-semibold">Nazwisko:</label>
            <input type="text" name="tickets[${ticketIndex}][last_name]" required class="border p-2 rounded w-full">
        `;
        wrapper.appendChild(entry);
        ticketIndex++;
    });
</script>
@endsection
