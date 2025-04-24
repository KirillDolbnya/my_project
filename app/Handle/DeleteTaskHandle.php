<?php

namespace App\Handle;

use Illuminate\Support\Facades\Auth;

class DeleteTaskHandle{
    public function __invoke($id)
    {
        $user = Auth::user();

        $task = $user->tasks()->where('id', $id)->delete();

        return $task;
    }
}
