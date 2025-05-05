<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\ContactTicket;
use App\Mail\TicketAutoResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function showForm() {
        return view('contact.form');
    }

    public function submit(ContactRequest $request) {
        // Ticket‑Nummer generieren
        $nr = strtoupper('T'.Str::random(8));

        // Ticket anlegen
        $ticket = ContactTicket::create([
            'ticket_nr' => $nr,
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
        ]);

        // Automatische Antwort senden
        Mail::to($ticket->email)
            ->send(new TicketAutoResponse($ticket));

        return redirect()->back()->with('success', 'Danke für Deine Nachricht! Deine Ticket‑Nummer: '.$nr);
    }
}
