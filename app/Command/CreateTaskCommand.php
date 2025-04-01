<?php

namespace App\Command;

class CreateTaskCommand{

    public string $name;
    public string $description;
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public static function make(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['description'] ?? ''
        );
    }
}
