<?php

namespace App\Handle;

use App\Command\CreateTaskCommand;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateTaskHandle{
    public function __invoke(CreateTaskCommand $createTaskCommand)
    {
        $validator = Validator::make([
            'user_id' => $createTaskCommand->user_id,
            'name' => $createTaskCommand->name,
            'description' => $createTaskCommand->description,
        ], [
            'user_id' => 'required|exists:users,id',
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

        $user = User::findOrFail($createTaskCommand->user_id);

        $task = $user->tasks()->create($credentials);

        return $task;

    }
}
