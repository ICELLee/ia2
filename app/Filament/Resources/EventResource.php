<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('cover_path')
                    ->label('Cover‑Bild')
                    ->image()
                    ->directory('events')
                    ->required(),

                TextInput::make('title')
                    ->label('Event‑Titel')
                    ->required(),

                DateTimePicker::make('starts_at')
                    ->label('Startdatum & Uhrzeit')
                    ->required(),

                TextInput::make('location')
                    ->label('Location')
                    ->required(),

                TextInput::make('price')
                    ->label('Preis (€)')
                    ->numeric(),

                TextInput::make('ticket_url')
                    ->label('Ticket‑URL')
                    ->url(),

                MultiSelect::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->preload()
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_path')->label('Cover'),
                TextColumn::make('title')->sortable(),
                TextColumn::make('starts_at')->dateTime('d.m.Y H:i'),
                TextColumn::make('location'),
                TextColumn::make('price')->prefix('€'),
                TextColumn::make('tags.name')->label('Tags')->wrap(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
