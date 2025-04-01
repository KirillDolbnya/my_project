<?php

namespace App\Command;

class UpdateCategoryCommand{
    public string $name;
    public int $id;

    public function __construct(string $name, int $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public static function make(array $data, int $id): self
    {
        return new self(
            $data['name'] ?? '',
            $id
        );
    }
}
