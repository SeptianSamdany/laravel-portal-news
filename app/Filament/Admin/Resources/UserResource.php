<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages\CreateUser;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Filament\Admin\Widgets\UserStatsOverview;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->hiddenOn('edit'),
                Forms\Components\Textarea::make('bio')
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('avatar')
                    ->directory('avatars')
                    ->image(),
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options(Role::all()->pluck('name', 'name')) // Ambil role dari tabel roles
                    ->required(),
                Forms\Components\TextInput::make('remember_token')
                    ->maxLength(100)
                    ->hidden(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name') // Jika menggunakan Spatie Role
                    ->label('Role')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->relationship('roles', 'name') // Filter berdasarkan role
                    ->label('Role'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Tambahkan tombol Edit
                Tables\Actions\ViewAction::make(), // Tambahkan tombol View (opsional)
            ]);;
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) User::count();
    }

    public static function getWidgets(): array
    {
        return [
            UserStatsOverview::class,
        ];
    }
}