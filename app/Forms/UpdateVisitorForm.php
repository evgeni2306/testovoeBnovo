<?php

declare(strict_types=1);

namespace App\Forms;

class UpdateVisitorForm extends AbstractForm
{
    public ?string $id = null;
    public ?string $name = null;
    public ?string $surname = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $country = null;
}
