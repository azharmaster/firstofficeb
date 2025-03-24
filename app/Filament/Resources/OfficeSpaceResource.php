<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;


class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required(),
                
                Forms\Components\TextArea::make('address')
                ->required()
                ->rows(10) // Corrected
                ->cols(20),

            Forms\Components\FileUpload::make('thumbnail')
                ->nullable()
                ->required(),

                Forms\Components\TextArea::make('about')
                ->required()
                ->rows(10) // Corrected
                ->cols(20),

            Repeater::make('photos')
            ->relationship('photos')
            ->schema([
                FileUpload::make('photo')
                ->required(),
            ]),

            Repeater::make('benefits')
            ->relationship('benefits')
            ->schema([
                TextInput::make('name')
                ->required(),
            ]),

            Forms\Components\Select::make('city_id')
            ->relationship('city','name')
            ->preload()
            ->required()
            ->searchable(),

            Forms\Components\TextInput::make('price')
            ->required()
            ->numeric()
            ->prefix('MYR'),

            Forms\Components\TextInput::make('duration')
            ->required()
            ->numeric()
            ->prefix('Days'),

            Forms\Components\Select::make('is_open')
            ->options([
                true => 'Open',
                false => 'Not Open',
            ])
            ->required(),

            Forms\Components\Select::make('is_full_booked')
            ->options([
                true => 'Not Available',
                false => 'Available',
            ])
            ->required(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([

            Tables\Columns\TextColumn::make('name')
        ->searchable(),

        Tables\Columns\ImageColumn::make('thumbnail'),

        Tables\Columns\TextColumn::make('city.name'),

        Tables\Columns\IconColumn::make('is_full_booked')
            ->boolean()
            ->trueColor('danger')
            ->falseColor('success')
            ->trueIcon('heroicon-o-x-circle')
            ->falseIcon('heroicon-o-check-circle')
            ->label('Available'),
            
        ])
        ->filters([
            
            SelectFilter::make('city_id')
            ->label('City')
            ->relationship('city','name')
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}
