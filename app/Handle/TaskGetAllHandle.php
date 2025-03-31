<?php

namespace App\Handle;

use Illuminate\Support\Facades\Auth;

class TaskGetAllHandle
{
    public function __invoke()
    {
        $user = Auth::user();

        $tasks = $user->tasks;

        return $tasks;
    }
}
