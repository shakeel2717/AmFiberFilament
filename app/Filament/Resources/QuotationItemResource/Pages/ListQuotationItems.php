<?php

namespace App\Filament\Resources\QuotationItemResource\Pages;

use App\Filament\Resources\QuotationItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuotationItems extends ListRecords
{
    protected static string $resource = QuotationItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
