<?php

namespace App\Handle;

use App\Command\CreateTaskCommand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateTaskHandle{
    public function __invoke(CreateTaskCommand $createTaskCommand)
    {
        $validator = Validator::make([
            'name' => $createTaskCommand->name,
            'description' => $createTaskCommand->description,
        ], [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $credentials = [
            'name' => $createTaskCommand->name,
            'description' => $createTaskCommand->description
        ];

        $user = Auth::user();

        $task = $user->tasks()->create($credentials);

        return $task;

    }
}
