<?php

namespace App\Filament\Resources\PosResource\Pages;

use App\Filament\Resources\PosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePos extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = PosResource::class;

    public function getSteps(): array
    {
        return PosResource::getWizardSteps();
    }
}
