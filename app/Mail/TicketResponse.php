<?php

namespace App\Mail;

use App\Models\ContactTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketResponse extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactTicket $ticket) {}

    public function build()
    {
        return $this
            ->subject('Antwort auf Dein Ticket '.$this->ticket->ticket_nr)
            ->view('emails.ticket_response')
            ->with([
                'ticket'  => $this->ticket,
            ]);
    }
}
