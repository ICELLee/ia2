<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReleaseResource\Pages;
use App\Filament\Resources\ReleaseResource\RelationManagers;
use App\Models\Release;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
class ReleaseResource extends Resource
{
    protected static ?string $model = Release::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    FileUpload::make('cover_path')
                        ->label('Cover‑Bild')
                        ->image()
                        ->directory('releases')
                        ->required(),
                    TextInput::make('title')->label('Titel')->required(),
                    TextInput::make('artist')->label('Artist')->required(),
                    Grid::make(2)->schema([
                        TextInput::make('spotify_url')->label('Spotify‑URL')->url(),
                        TextInput::make('soundcloud_url')->label('Soundcloud‑URL')->url(),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('apple_url')->label('Apple Music‑URL')->url(),
                        TextInput::make('youtube_url')->label('YouTube‑URL')->url(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_path')->label('Cover'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('artist'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReleases::route('/'),
            'create' => Pages\CreateRelease::route('/create'),
            'edit' => Pages\EditRelease::route('/{record}/edit'),
        ];
    }
}
