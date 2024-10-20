<?php

declare(strict_types=1);

namespace App\Cases;

use App\Forms\UpdateVisitorForm;
use App\Models\Visitor;

class UpdateVisitorCase
{
    /**
     * @param UpdateVisitorForm $formData
     * @return void
     */
    public function handle(UpdateVisitorForm $formData): void
    {
        $data = $formData->toArray();
        $visitorId = (int)$data['id'];

        $visitor = Visitor::query()->findOrFail($visitorId);
        $visitor->update($data);
    }
}
