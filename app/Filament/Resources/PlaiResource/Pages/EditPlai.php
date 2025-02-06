<?php

namespace App\Filament\Resources\PlaiResource\Pages;

use App\Filament\Resources\PlaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlai extends EditRecord
{
    protected static string $resource = PlaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
