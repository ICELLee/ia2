<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ContactTicketResource\Pages;
use App\Models\ContactTicket;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Mail\TicketResponse;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;

class ContactTicketResource extends Resource
{
    protected static ?string $model = ContactTicket::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('ticket_nr')->disabled(),
            TextInput::make('name')->required(),
            TextInput::make('email')->required()->email(),
            TextInput::make('subject')->required(),
            Textarea::make('message')->required()->rows(4),
            Textarea::make('response')
                ->label('Antwort')
                ->rows(4),
            Select::make('status')
                ->options(['open'=>'Offen','closed'=>'Bearbeitet'])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ticket_nr')->sortable(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('subject'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->actions([
                // ← our new “Reply” action
                Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-o-paper-airplane')
                    // show a modal form with these fields
                    ->form([
                        Textarea::make('response')
                            ->label('Your reply')
                            ->required()
                            ->rows(4),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'open'   => 'Offen',
                                'closed' => 'Bearbeitet',
                            ])
                            ->default('closed')
                            ->required(),
                    ])
                    // when they submit the modal:
                    ->action(function ($record, array $data) {
                        // 1) update the ticket
                        $record->update([
                            'response' => $data['response'],
                            'status'   => $data['status'],
                        ]);
                        // 2) send the reply‑mail
                        Mail::to($record->email)
                            ->send(new TicketResponse($record));
                    })
                    ->requiresConfirmation() // optional: double‑check
                    ->color('primary'),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactTickets::route('/'),
            'edit'  => Pages\EditContactTicket::route('/{record}/edit'),
        ];
    }
}
