<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\BooleanColumn;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Team';
    protected static ?string $navigationGroup = 'Site Content';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('image_path')
                ->image()
                ->directory('team')
                ->disk('public')
                ->label('Foto'),
            TextInput::make('name')
                ->required()
                ->label('Name'),
            TextInput::make('artist_name')
                ->label('Artist‑Name'),
            TextInput::make('email')
                ->email()
                ->label('E‑Mail'),
            MultiSelect::make('jobs')
                ->relationship('jobs', 'label')
                ->preload()
                ->label('Jobs'),
            Toggle::make('is_visible')
                ->label('Sichtbar')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Foto'),
                TextColumn::make('name')
                    ->sortable(),
                TextColumn::make('artist_name'),
                BadgeColumn::make('jobs')
                    ->getStateUsing(fn ($record) => $record->jobs->pluck('label')->toArray())
                    ->label('Jobs'),
                BooleanColumn::make('is_visible')
                    ->label('Visible')
                    ->trueIcon('heroicon-o-badge-check')
                    ->falseIcon('heroicon-o-x-circle')
                    ->colors([
                        'success' => true,
                        'danger'  => false,
                    ]),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Sichtbar'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListTeamMembers::route('/'),
            'create'  => Pages\CreateTeamMember::route('/create'),
            'edit'    => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
