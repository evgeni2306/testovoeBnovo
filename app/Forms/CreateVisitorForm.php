<?php

declare(strict_types=1);

namespace App\Forms;

class CreateVisitorForm extends AbstractForm
{
    public ?string $name = null;
    public ?string $surname = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $country = null;
}
