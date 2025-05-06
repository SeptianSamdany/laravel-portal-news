<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Article;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ArticlesPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Articles Published Per Month';
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $maxHeight = '300px';
    
    protected function getData(): array
    {
        $data = $this->getArticlesPerMonth();
        
        return [
            'datasets' => [
                [
                    'label' => 'Published Articles',
                    'data' => $data['counts'],
                    'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
                [
                    'label' => 'Featured Articles',
                    'data' => $data['featured_counts'],
                    'backgroundColor' => 'rgba(245, 158, 11, 0.5)',
                    'borderColor' => 'rgb(245, 158, 11)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $data['months'],
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
    
    private function getArticlesPerMonth(): array
    {
        $months = collect();
        $counts = collect();
        $featuredCounts = collect();
        
        // Get data for the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthYear = $date->format('M Y');
            
            $count = Article::where('status', 'published')
                ->whereYear('published_at', $date->year)
                ->whereMonth('published_at', $date->month)
                ->count();
                
            $featuredCount = Article::where('status', 'published')
                ->where('is_featured', true)
                ->whereYear('published_at', $date->year)
                ->whereMonth('published_at', $date->month)
                ->count();
            
            $months->push($monthYear);
            $counts->push($count);
            $featuredCounts->push($featuredCount);
        }
        
        return [
            'months' => $months->toArray(),
            'counts' => $counts->toArray(),
            'featured_counts' => $featuredCounts->toArray(),
        ];
    }
    
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}