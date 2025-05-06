<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Carbon;

class ArticleStatsOverview extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $scheduledArticles = Article::where('status', 'scheduled')->count();
        
        $featuredArticles = Article::where('is_featured', true)->count();
        
        $totalViews = Article::sum('views_count');
        
        $articlesThisMonth = Article::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
            
        $articlesLastMonth = Article::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
            
        $monthlyChange = $articlesLastMonth > 0 
            ? (($articlesThisMonth - $articlesLastMonth) / $articlesLastMonth) * 100 
            : ($articlesThisMonth > 0 ? 100 : 0);
            
        $totalComments = Comment::count();
        
        return [
            Stat::make('Total Articles', $totalArticles)
                ->description('All articles in the database')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart([
                    $draftArticles, $publishedArticles, $scheduledArticles
                ])
                ->color('primary'),
                
            Stat::make('Published Articles', $publishedArticles)
                ->description(number_format(($publishedArticles / ($totalArticles ?: 1)) * 100, 1) . '% of total')
                ->descriptionIcon('heroicon-m-check-circle')
                ->chart(
                    $this->getPublishedChartData()
                )
                ->color('success'),
                
            Stat::make('Total Views', number_format($totalViews))
                ->description('Across all articles')
                ->descriptionIcon('heroicon-m-eye')
                ->chart(
                    $this->getViewsChartData()
                )
                ->color('warning'),
                
            Stat::make('New Articles This Month', $articlesThisMonth)
                ->description($monthlyChange >= 0 
                    ? number_format(abs($monthlyChange), 1) . '% increase' 
                    : number_format(abs($monthlyChange), 1) . '% decrease')
                ->descriptionIcon($monthlyChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart(
                    $this->getMonthlyArticlesChartData()
                )
                ->color($monthlyChange >= 0 ? 'success' : 'danger'),
                
            Stat::make('Featured Articles', $featuredArticles)
                ->description(number_format(($featuredArticles / ($totalArticles ?: 1)) * 100, 1) . '% of total')
                ->descriptionIcon('heroicon-m-star')
                ->color('primary'),
                
            Stat::make('Total Comments', $totalComments)
                ->description('Across all articles')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->chart(
                    $this->getCommentsChartData()
                )
                ->color('info'),
        ];
    }
    
    protected function getPublishedChartData(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
                
                return Article::where('status', 'published')
                    ->whereDate('published_at', $date)
                    ->count();
            })
            ->toArray();
    }
    
    protected function getViewsChartData(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::now()->subDays($daysAgo);
                $previousDate = Carbon::now()->subDays($daysAgo + 1);
                
                // This is a simplified approach - in reality you'd track daily views
                // For this example, we're simulating the data
                $dayOfWeek = $date->dayOfWeek;
                $factor = ($dayOfWeek == 0 || $dayOfWeek == 6) ? 0.5 : 1; // Lower on weekends
                return rand(50, 200) * $factor;
            })
            ->toArray();
    }
    
    protected function getMonthlyArticlesChartData(): array
    {
        return collect(range(6, 0))
            ->map(function ($monthsAgo) {
                $date = Carbon::now()->subMonths($monthsAgo);
                
                return Article::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            })
            ->toArray();
    }
    
    protected function getCommentsChartData(): array
    {
        return collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');
                
                return Comment::whereDate('created_at', $date)
                    ->count();
            })
            ->toArray();
    }
}
