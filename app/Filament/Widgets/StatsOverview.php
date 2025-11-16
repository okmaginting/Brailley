<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\CommunityStory;
use App\Models\OfficialBook;
use App\Models\Audiobook;
use App\Models\Article;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    /**
     * Tentukan kartu statistik yang akan ditampilkan.
     */
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->icon('heroicon-o-users'),
            
            Stat::make('Cerita Komunitas', CommunityStory::count())
                ->description('Total cerita dari user')
                ->icon('heroicon-o-book-open'),
            
            Stat::make('Buku Resmi', OfficialBook::count())
                ->description('Total buku eksternal')
                ->icon('heroicon-o-bookmark'),
            
            Stat::make('Audiobook', Audiobook::count())
                ->description('Total file audio')
                ->icon('heroicon-o-musical-note'),
            
            Stat::make('Artikel', Article::count())
                ->description('Total artikel dipublikasi')
                ->icon('heroicon-o-document-text'),
        ];
    }
}