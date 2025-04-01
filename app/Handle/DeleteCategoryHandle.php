<?php

namespace App\Handle;

use Illuminate\Support\Facades\Auth;

class DeleteCategoryHandle{
    public function __invoke($id)
    {
        $user = Auth::user();

        $category = $user->categories()->where('id', $id)->delete();

        return $category;
    }
}
