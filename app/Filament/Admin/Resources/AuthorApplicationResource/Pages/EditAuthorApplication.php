<?php

namespace App\Filament\Admin\Resources\AuthorApplicationResource\Pages;

use App\Filament\Admin\Resources\AuthorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuthorApplication extends EditRecord
{
    protected static string $resource = AuthorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
