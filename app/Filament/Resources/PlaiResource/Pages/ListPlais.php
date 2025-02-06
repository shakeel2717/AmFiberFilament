<?php

namespace App\Filament\Resources\PlaiResource\Pages;

use App\Filament\Resources\PlaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlais extends ListRecords
{
    protected static string $resource = PlaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
