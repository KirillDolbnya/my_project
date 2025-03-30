<?php

namespace App\Http\Controllers\Api\V1;

use App\Command\CreateTaskCommand;
use App\Handle\CreateTaskHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request, CreateTaskHandle $createTaskHandle)
    {
        $command = CreateTaskCommand::make($request->all());
        $result = $createTaskHandle($command);

        return new TaskResource($result);
    }


}
