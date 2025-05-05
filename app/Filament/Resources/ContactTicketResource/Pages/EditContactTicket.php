<?php

namespace App\Filament\Resources\ContactTicketResource\Pages;

use App\Filament\Resources\ContactTicketResource;
use Filament\Resources\Pages\EditRecord;

class EditContactTicket extends EditRecord
{
    protected static string $resource = ContactTicketResource::class;

    // 1) GET HEADER ACTIONS
    protected function getHeaderActions(): array
    {
        return [
            // … hier deine Header‑Buttons …
        ];
    }

    // 2) AFTER SAVE: diese Methode MUSS außerhalb von getHeaderActions(), aber
    //    innerhalb der Klasse stehen:
    protected function afterSave(): void
    {
        if ($this->record->status === 'closed' && $this->record->response) {
            \Mail::to($this->record->email)
                ->send(new \App\Mail\TicketAutoResponse($this->record));
        }
    }
}
