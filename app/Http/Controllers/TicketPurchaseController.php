<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketPurchaseController extends Controller
{
    public function showForm(Event $event)
    {
        return view('tickets.purchase', compact('event'));
    }

    public function purchase(Request $request, Event $event)
    {
        $request->validate([
            'tickets' => 'required|array|min:1',
            'tickets.*.first_name' => 'required|string|max:255',
            'tickets.*.last_name' => 'required|string|max:255',
        ]);


        $quantity = count($request->tickets);

        if ($event->available_tickets - $event->sold_tickets < $quantity) {
            return back()->withErrors(['There are not enough tickets available.']);
        }

        DB::transaction(function () use ($request, $event, $quantity) {
            foreach ($request->tickets as $ticketData) {
                Ticket::create([
                    'event_id' => $event->id,
                    'user_id' => Auth::id(),
                    'qr_code_path' => null,
                    'pdf_path' => null,
                    'first_name' => $ticketData['first_name'],
                    'last_name' => $ticketData['last_name'],

                ]);
            }

            $event->increment('sold_tickets', $quantity);
        });

        return redirect()->route('events.show', $event)->with('success', 'Tickets have been purchased!');
    }

    public function myTickets()
    {
        $user = Auth::user();
        $tickets = Ticket::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('tickets.my', compact('tickets'));
    }
}
