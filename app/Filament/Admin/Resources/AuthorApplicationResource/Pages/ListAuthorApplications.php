<?php

namespace App\Filament\Admin\Resources\AuthorApplicationResource\Pages;

use App\Filament\Admin\Resources\AuthorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAuthorApplications extends ListRecords
{
    protected static string $resource = AuthorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
