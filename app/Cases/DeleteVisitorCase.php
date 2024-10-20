<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Visitor;

class DeleteVisitorCase
{
    /**
     * @param int $visitorId
     * @return void
     * @throws \Throwable
     */
    public function handle(int $visitorId): void
    {
        $visitor = Visitor::query()->findOrFail($visitorId);
        $visitor->deleteOrFail();
    }
}
