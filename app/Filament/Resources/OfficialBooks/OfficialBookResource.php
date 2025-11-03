<?php

namespace App\Filament\Resources\OfficialBooks;

use App\Filament\Resources\OfficialBooks\Pages\CreateOfficialBook;
use App\Filament\Resources\OfficialBooks\Pages\EditOfficialBook;
use App\Filament\Resources\OfficialBooks\Pages\ListOfficialBooks;
use App\Filament\Resources\OfficialBooks\Schemas\OfficialBookForm;
use App\Filament\Resources\OfficialBooks\Tables\OfficialBooksTable;
use App\Models\OfficialBook;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OfficialBookResource extends Resource
{
    protected static ?string $model = OfficialBook::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return OfficialBookForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfficialBooksTable::configure($table);
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
            'index' => ListOfficialBooks::route('/'),
            'create' => CreateOfficialBook::route('/create'),
            'edit' => EditOfficialBook::route('/{record}/edit'),
        ];
    }
}
