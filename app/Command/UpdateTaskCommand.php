<?php

namespace App\Command;

use App\Handle\UpdateTaskHandle;

class UpdateTaskCommand{

    public string $name;
    public string $description;
    public int $id;
    public function __construct(string $name, string $description, int $id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->id = $id;
    }

    public static function make(array $data, int $id): self
    {
        return new self(
            $data['name'] ?? '',
            $data['description'] ?? '',
            $id
        );
    }
}
