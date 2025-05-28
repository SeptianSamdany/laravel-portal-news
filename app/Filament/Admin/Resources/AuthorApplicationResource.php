<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AuthorApplicationResource\Pages\CreateAuthorApplication;
use App\Filament\Admin\Resources\AuthorApplicationResource\Pages\EditAuthorApplication;
use App\Filament\Admin\Resources\AuthorApplicationResource\Pages\ListAuthorApplications;
use App\Models\AuthorApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;

class AuthorApplicationResource extends Resource
{
    protected static ?string $model = AuthorApplication::class;

    protected static ?string $navigationLabel = 'Author Applications';

    protected static ?string $pluralLabel = 'Author Applications';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'HR Management';
    protected static ?int $navigationSort = 3;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(100),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(100),
                Forms\Components\Textarea::make('bio')->maxLength(500),
                Forms\Components\TextInput::make('portfolio')->url()->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('portfolio')->limit(30),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuthorApplications::route('/'),
            'create' => CreateAuthorApplication::route('/create'),
            'edit' => EditAuthorApplication::route('/{record}/edit'),
        ];
    }
}