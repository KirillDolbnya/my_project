<?php

namespace App\Handle;

use App\Command\UpdateTaskCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateTaskHandle{
    public function __invoke(UpdateTaskCommand $updateTaskCommand)
    {
        $validator = Validator::make([
            'name' => $updateTaskCommand->name,
            'description' => $updateTaskCommand->description,
        ], [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = Auth::user();

        $task = $user->tasks()->where('id', $updateTaskCommand->id)->first();

        if (!$task) {
            abort(404, 'Задача не найдена или не принадлежит пользователю');
        }

        $task->update([
            'name' => $updateTaskCommand->name,
            'description' => $updateTaskCommand->description
        ]);

        return $task;
    }
}
