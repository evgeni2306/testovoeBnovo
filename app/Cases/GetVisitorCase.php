<?php

declare(strict_types=1);

namespace App\Cases;

use App\Models\Visitor;

class GetVisitorCase
{
    /**
     * @param int $visitorId
     * @return array
     */
    public function handle(int $visitorId): array
    {
        $visitor = Visitor::query()->findOrFail($visitorId);
        $data = $visitor->toArray();
        dd($data);
    }
}
