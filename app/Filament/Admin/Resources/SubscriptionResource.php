<?php
// app/Filament/Resources/SubscriptionResource.php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubscriptionResource\Pages\CreateSubscription;
use App\Filament\Admin\Resources\SubscriptionResource\Pages\EditSubscription;
use App\Filament\Admin\Resources\SubscriptionResource\Pages\ListSubscriptions;
use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Subscription Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subscriber Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Subscription Details')
                    ->schema([
                        Forms\Components\CheckboxList::make('interests')
                            ->options([
                                'technology' => 'Technology',
                                'business' => 'Business',
                                'health' => 'Health & Wellness',
                                'education' => 'Education',
                                'entertainment' => 'Entertainment',
                                'sports' => 'Sports',
                                'travel' => 'Travel',
                                'food' => 'Food & Cooking',
                                'lifestyle' => 'Lifestyle',
                                'science' => 'Science',
                            ])
                            ->required()
                            ->columns(3),
                        
                        Forms\Components\Select::make('frequency')
                            ->options([
                                'daily' => 'Daily',
                                'weekly' => 'Weekly',
                                'monthly' => 'Monthly',
                            ])
                            ->required()
                            ->default('weekly'),
                    ]),

                Forms\Components\Section::make('Payment & Status')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('IDR')
                            ->step(1000)
                            ->required(),
                        
                        Forms\Components\FileUpload::make('payment_proof')
                            ->image()
                            ->directory('payment-proofs')
                            ->disk('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1']),
                        
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'active' => 'Active',
                                'expired' => 'Expired',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending')
                            ->live()
                            ->afterStateUpdated(function (string $state, Forms\Set $set) {
                                if ($state === 'active') {
                                    $set('is_subscribed', true);
                                    $set('subscribed_at', now());
                                    $set('expires_at', now()->addYear());
                                } elseif (in_array($state, ['cancelled', 'expired'])) {
                                    $set('is_subscribed', false);
                                }
                            }),
                        
                        Forms\Components\Toggle::make('is_subscribed')
                            ->label('Is Subscribed')
                            ->default(false),
                        
                        Forms\Components\DateTimePicker::make('subscribed_at')
                            ->label('Subscribed At'),
                        
                        Forms\Components\DateTimePicker::make('expires_at')
                            ->label('Expires At'),
                        
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied!'),
                
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('interests_list')
                    ->label('Interests')
                    ->limit(30)
                    ->tooltip(function (Subscription $record): ?string {
                        return $record->interests_list;
                    }),
                
                Tables\Columns\TextColumn::make('frequency')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'daily' => 'success',
                        'weekly' => 'info',
                        'monthly' => 'warning',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                
                Tables\Columns\IconColumn::make('is_subscribed')
                    ->boolean()
                    ->label('Subscribed'),
                
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (Subscription $record): string => $record->status_color),
                
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->disk('public')
                    ->square()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('subscribed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable()
                    ->color(fn (Subscription $record): string => 
                        $record->isExpired() ? 'danger' : 'success'
                    ),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'cancelled' => 'Cancelled',
                    ]),
                
                SelectFilter::make('frequency')
                    ->options([
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_subscribed')
                    ->label('Subscription Status'),
                
                Tables\Filters\Filter::make('expires_soon')
                    ->label('Expires within 30 days')
                    ->query(fn (Builder $query): Builder => 
                        $query->where('expires_at', '<=', now()->addDays(30))
                              ->where('expires_at', '>', now())
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Subscription $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Subscription')
                    ->modalDescription('Are you sure you want to approve this subscription?')
                    ->action(function (Subscription $record) {
                        $record->update([
                            'status' => 'active',
                            'is_subscribed' => true,
                            'subscribed_at' => now(),
                            'expires_at' => now()->addYear(),
                        ]);
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Subscription approved')
                            ->body('The subscription has been approved successfully.')
                    ),
                
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Subscription $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Subscription')
                    ->modalDescription('Are you sure you want to reject this subscription?')
                    ->form([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Rejection Reason')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (Subscription $record, array $data) {
                        $record->update([
                            'status' => 'cancelled',
                            'is_subscribed' => false,
                            'admin_notes' => $data['admin_notes'],
                        ]);
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Subscription rejected')
                            ->body('The subscription has been rejected.')
                    ),
                
                Tables\Actions\Action::make('extend')
                    ->label('Extend')
                    ->icon('heroicon-o-calendar-days')
                    ->color('warning')
                    ->visible(fn (Subscription $record): bool => $record->status === 'active')
                    ->form([
                        Forms\Components\Select::make('extension_period')
                            ->label('Extend by')
                            ->options([
                                '1_month' => '1 Month',
                                '3_months' => '3 Months',
                                '6_months' => '6 Months',
                                '1_year' => '1 Year',
                            ])
                            ->required(),
                    ])
                    ->action(function (Subscription $record, array $data) {
                        $currentExpiry = $record->expires_at ?? now();
                        
                        $newExpiry = match($data['extension_period']) {
                            '1_month' => $currentExpiry->addMonth(),
                            '3_months' => $currentExpiry->addMonths(3),
                            '6_months' => $currentExpiry->addMonths(6),
                            '1_year' => $currentExpiry->addYear(),
                        };
                        
                        $record->update(['expires_at' => $newExpiry]);
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Subscription extended')
                            ->body('The subscription has been extended successfully.')
                    ),
                
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(function (Subscription $record) {
                                if ($record->status === 'pending') {
                                    $record->update([
                                        'status' => 'active',
                                        'is_subscribed' => true,
                                        'subscribed_at' => now(),
                                        'expires_at' => now()->addYear(),
                                    ]);
                                }
                            });
                        }),
                    
                    BulkAction::make('reject_selected')
                        ->label('Reject Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->form([
                            Forms\Components\Textarea::make('admin_notes')
                                ->label('Rejection Reason')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function (Subscription $record) use ($data) {
                                if ($record->status === 'pending') {
                                    $record->update([
                                        'status' => 'cancelled',
                                        'is_subscribed' => false,
                                        'admin_notes' => $data['admin_notes'],
                                    ]);
                                }
                            });
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Subscriber Information')
                    ->schema([
                        Components\TextEntry::make('user.name')
                            ->label('User Account'),
                        Components\TextEntry::make('name')
                            ->weight(FontWeight::Bold),
                        Components\TextEntry::make('email')
                            ->copyable()
                            ->copyMessage('Email copied!'),
                        Components\TextEntry::make('phone')
                            ->placeholder('Not provided'),
                    ])
                    ->columns(2),

                Components\Section::make('Subscription Details')
                    ->schema([
                        Components\TextEntry::make('interests_list')
                            ->label('Interests'),
                        Components\TextEntry::make('frequency')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'daily' => 'success',
                                'weekly' => 'info',
                                'monthly' => 'warning',
                                default => 'gray',
                            }),
                        Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (Subscription $record): string => $record->status_color),
                        Components\IconEntry::make('is_subscribed')
                            ->boolean()
                            ->label('Active Subscription'),
                    ])
                    ->columns(2),

                Components\Section::make('Payment Information')
                    ->schema([
                        Components\TextEntry::make('amount')
                            ->money('IDR')
                            ->weight(FontWeight::Bold),
                        Components\ImageEntry::make('payment_proof')
                            ->disk('public')
                            ->height(200)
                            ->placeholder('No payment proof uploaded'),
                    ])
                    ->columns(2),

                Components\Section::make('Timeline')
                    ->schema([
                        Components\TextEntry::make('created_at')
                            ->label('Requested At')
                            ->dateTime(),
                        Components\TextEntry::make('subscribed_at')
                            ->label('Approved At')
                            ->dateTime()
                            ->placeholder('Not approved yet'),
                        Components\TextEntry::make('expires_at')
                            ->label('Expires At')
                            ->dateTime()
                            ->color(fn (Subscription $record): string => 
                                $record->isExpired() ? 'danger' : 'success'
                            )
                            ->placeholder('No expiry set'),
                    ])
                    ->columns(3),

                Components\Section::make('Admin Notes')
                    ->schema([
                        Components\TextEntry::make('admin_notes')
                            ->placeholder('No admin notes')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(fn (Subscription $record): bool => empty($record->admin_notes)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptions::route('/'),
            'create' => CreateSubscription::route('/create'),
            'edit' => EditSubscription::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $pendingCount = static::getModel()::where('status', 'pending')->count();
        return $pendingCount > 0 ? 'warning' : null;
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'user.name'];
    }
}