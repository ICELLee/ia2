<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Überschrift'),
                Textarea::make('description')->label('Beschreibung'),
                TextInput::make('button_text')->label('Button‑Text'),
                TextInput::make('button_url')->label('Button‑URL'),

                Select::make('media_type')
                    ->label('Medientyp')
                    ->options([
                        'image' => 'Bild',
                        'video' => 'Video',
                    ])
                    ->reactive(),

                // Für Bilder: speichert direkt in media_path
                FileUpload::make('media_path')
                    ->label('Bild Upload')
                    ->image()
                    ->directory('sliders')
                    ->visible(fn ($get) => $get('media_type') === 'image'),

                // Für Videos: speichert URL in media_path
                TextInput::make('media_path')
                    ->label('Video‑URL (mp4)')
                    ->url()
                    ->visible(fn ($get) => $get('media_type') === 'video'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Deine Spalten…
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit'   => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    // ── Hier kommen die Mutatoren ─────────────────────────────────────────

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Wenn Bild ausgewählt und hochgeladen, setze media_path
        if (($data['media_type'] ?? null) === 'image' && isset($data['media_upload'])) {
            $data['media_path'] = $data['media_upload'];
        }
        // Wenn Video ausgewählt, setze media_path auf die URL
        if (($data['media_type'] ?? null) === 'video' && !empty($data['media_url'])) {
            $data['media_path'] = $data['media_url'];
        }
        unset($data['media_upload'], $data['media_url']);
        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['media_type'] ?? null) === 'image' && isset($data['media_upload'])) {
            $data['media_path'] = $data['media_upload'];
        }
        if (($data['media_type'] ?? null) === 'video' && !empty($data['media_url'])) {
            $data['media_path'] = $data['media_url'];
        }
        unset($data['media_upload'], $data['media_url']);
        return $data;
    }
}
