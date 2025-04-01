<?php

namespace App\Handle;

use App\Command\CreateCategoryCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateCategoryHandle{
    public function __invoke(CreateCategoryCommand $createCategoryCommand)
    {
        $validator = Validator::make([
            'name' => $createCategoryCommand->name,
        ], [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $credentials = [
            'name' => $createCategoryCommand->name,
        ];

        $user = Auth::user();

        $category = $user->categories()->create($credentials);

        return $category;
    }
}
