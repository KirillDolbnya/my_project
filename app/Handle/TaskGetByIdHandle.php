<?php

namespace App\Handle;

use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;

class TaskGetByIdHandle{
    public function __invoke($id)
    {
        $user = Auth::user();

        $task = $user->tasks->where('id','=',$id)->first();

        return $task;
    }
}
