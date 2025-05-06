<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        // Sinkronkan role setelah user diperbarui
        if ($this->data['role']) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}