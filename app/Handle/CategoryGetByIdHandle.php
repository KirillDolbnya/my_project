<?php

namespace App\Handle;

use Illuminate\Support\Facades\Auth;

class CategoryGetByIdHandle{
    public function __invoke($id)
    {
        $user = Auth::user();

        $category = $user->categories->where('id','=',$id)->first();

        return $category;
    }
}
