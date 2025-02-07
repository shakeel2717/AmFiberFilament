<?php

namespace App\Filament\Resources\QuotationItemResource\Pages;

use App\Filament\Resources\QuotationItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuotationItem extends EditRecord
{
    protected static string $resource = QuotationItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
