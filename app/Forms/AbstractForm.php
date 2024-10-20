<?php

declare(strict_types=1);

namespace App\Forms;

abstract class AbstractForm
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $field => $value) {
            if ($value !== null) {
                $array[$field] = $value;
            }
        }

        return $array;
    }
}
