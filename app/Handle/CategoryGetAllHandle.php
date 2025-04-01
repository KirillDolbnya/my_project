<?php

namespace App\Handle;

use Illuminate\Support\Facades\Auth;

class CategoryGetAllHandle
{
    public function __invoke()
    {
        $user = Auth::user();

        $category = $user->categories;

        return $category;
    }
}
