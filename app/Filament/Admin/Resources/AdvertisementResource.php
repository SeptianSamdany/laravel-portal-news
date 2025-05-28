<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AdvertisementResource\Pages\CreateAdvertisement;
use App\Filament\Admin\Resources\AdvertisementResource\Pages\EditAdvertisement;
use App\Filament\Admin\Resources\AdvertisementResource\Pages\ListAdvertisements;
use App\Filament\Resources\AdvertisementResource\Pages;
use App\Models\Advertisement;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;
    protected static ?string $navigationLabel = 'Advertisements';
    protected static ?string $pluralLabel = 'Advertisements';
    protected static ?string $slug = 'advertisements';
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationGroup = 'Ads Management';
    protected static ?int $navigationSort = 2;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->directory('ads')
                    ->image()
                    ->maxSize(2048),
                Forms\Components\TextInput::make('link')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(500),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('link')->limit(30),
                Tables\Columns\ToggleColumn::make('is_active')->label('Active'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdvertisements::route('/'),
            'create' => CreateAdvertisement::route('/create'),
            'edit' => EditAdvertisement::route('/{record}/edit'),
        ];
    }
}