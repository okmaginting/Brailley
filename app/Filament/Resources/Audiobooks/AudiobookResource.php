<?php

namespace App\Filament\Resources\Audiobooks;

use App\Filament\Resources\Audiobooks\Pages\CreateAudiobook;
use App\Filament\Resources\Audiobooks\Pages\EditAudiobook;
use App\Filament\Resources\Audiobooks\Pages\ListAudiobooks;
use App\Filament\Resources\Audiobooks\Schemas\AudiobookForm;
use App\Filament\Resources\Audiobooks\Tables\AudiobooksTable;
use App\Models\Audiobook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AudiobookResource extends Resource
{
    protected static ?string $model = Audiobook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return AudiobookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AudiobooksTable::configure($table);
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
            'index' => ListAudiobooks::route('/'),
            'create' => CreateAudiobook::route('/create'),
            'edit' => EditAudiobook::route('/{record}/edit'),
        ];
    }
}
