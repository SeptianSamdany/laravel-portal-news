<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        // Sinkronkan role setelah user dibuat
        if ($this->data['role']) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}