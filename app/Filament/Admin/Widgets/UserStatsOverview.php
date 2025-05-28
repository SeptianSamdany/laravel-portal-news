<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class UserStatsOverview extends BaseWidget
{
    protected static ?int $sort = -10;
    // Set the widget to be protected so it's only visible to authorized users
    protected static ?string $pollingInterval = null;
    
    // Apply authorization to check if current user can view this widget
    public static function canView(): bool
    {
        $user = Auth::user();
        
        // Check if the user has super_admin or author role
        return $user && ($user->hasRole('super_admin') || $user->hasRole('author'));
    }
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Total registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('danger'),
                
            Stat::make('New Users This Month', User::whereMonth('created_at', now()->month)->count())
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),
                
            Stat::make('User Roles', User::distinct('role')->count('role'))
                ->description('Different roles in system')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
        ];
    }
}