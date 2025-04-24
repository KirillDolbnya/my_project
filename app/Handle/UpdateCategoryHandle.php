<?php

namespace App\Handle;

use App\Command\UpdateCategoryCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateCategoryHandle{
    public function __invoke(UpdateCategoryCommand $updateCategoryCommand)
    {
        $validator = Validator::make([
            'name' => $updateCategoryCommand->name,
        ], [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = Auth::user();

        $category = $user->categories()->where('id', $updateCategoryCommand->id)->first();

        if (!$category) {
            abort(404, 'Задача не найдена или не принадлежит пользователю');
        }

        $category->update([
            'name' => $updateCategoryCommand->name,
        ]);

        return $category;
    }
}
