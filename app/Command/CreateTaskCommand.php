<?php

namespace App\Command;

class CreateTaskCommand{

    public string $name;
    public string $description;
    public string $user_id;
    public function __construct(string $user_id, string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->user_id = $user_id;
    }

    public static function make(array $data): self
    {
        return new self(
            $data['user_id'] ?? '',
            $data['name'] ?? '',
            $data['description'] ?? ''
        );
    }
}
