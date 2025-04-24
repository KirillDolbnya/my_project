<?php

namespace App\Command;

class CreateCategoryCommand
{

    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make(array $data): self
    {
        return new self(
            $data['name'] ?? '',
        );
    }
}
