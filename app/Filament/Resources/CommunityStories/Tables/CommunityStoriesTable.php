<?php

namespace App\Filament\Resources\CommunityStories\Tables;
use App\Enums\CommunityStoryStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommunityStoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('judul')
                    ->searchable(),
                TextColumn::make('penulis')
                    ->searchable(),
                TextColumn::make('genre')
                    ->searchable(),
                TextColumn::make('gambar_cerita')
                    ->searchable(),
                TextColumn::make('upload_file')
                    ->searchable(),
                TextColumn::make('braille_file')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge() // Ini akan membuatnya terlihat seperti 'badge'
                    ->color(fn (\App\Enums\CommunityStoryStatus $state): string => match ($state) {
                        CommunityStoryStatus::Pengecekan => 'gray',
                        CommunityStoryStatus::Ditolak => 'danger',
                        CommunityStoryStatus::Diterima => 'success',
                        CommunityStoryStatus::Proses => 'warning',
                        CommunityStoryStatus::Dipublish => 'primary',
                    })
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('braille_mirrored_image'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
