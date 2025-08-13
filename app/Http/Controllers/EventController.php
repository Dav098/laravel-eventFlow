<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_online', true)->latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {

        if (!$event->is_online && (!Auth::check() || Auth::id() !== $event->organizer_id)) {
            abort(404);
        }

        return view('events.show', compact('event'));
    }

    public function create()
    {
        if (!Auth::user()->isPromoter()) {
            abort(403, 'Only promoters can create events.');
        }

        return view('events.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isPromoter()) {
            abort(403, 'Only promoters can create events.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_datetime' => 'required|date|after:now',
            'end_datetime' => 'required|date|after:start_datetime',
            'available_tickets' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_online' => 'nullable|boolean',
        ]);

        $validated['is_online'] = $request->has('is_online');
        $validated['organizer_id'] = Auth::id();

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'The event has been created.');
    }
    public function edit(Event $event)
    {
        $user = auth()->user();

        if ($user->id !== $event->organizer_id && !$user->isPromoter()) {
            abort(403, 'No access to edit this event.');
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $user = auth()->user();

        if ($user->id !== $event->organizer_id && !$user->isPromoter()) {
            abort(403, 'No access to update this event.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'start_datetime' => 'required|date|after:now',
            'end_datetime' => 'required|date|after:start_datetime',
            'available_tickets' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_online' => 'nullable|boolean',
        ]);

        $validated['is_online'] = $request->has('is_online');

        $event->update($validated);

        return redirect()->route('events.my')->with('success', 'Event updated.');

    }
    public function myEvents()
    {
        $user = auth()->user();

        if (!in_array($user->role, ['promoter', 'user/promoter'])) {
            abort(403, 'No access.');
        }

        $events = $user->events()->latest()->get();

        return view('events.my-events', compact('events'));
    }
}
