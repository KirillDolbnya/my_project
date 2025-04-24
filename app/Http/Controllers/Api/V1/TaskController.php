<?php

namespace App\Http\Controllers\Api\V1;

use App\Command\CreateTaskCommand;
use App\Command\UpdateTaskCommand;
use App\Handle\CreateTaskHandle;
use App\Handle\DeleteTaskHandle;
use App\Handle\TaskGetAllHandle;
use App\Handle\TaskGetByIdHandle;
use App\Handle\UpdateTaskHandle;
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

    public function update(Request $request, $id, UpdateTaskHandle $updateTaskHandle)
    {
        $command = UpdateTaskCommand::make($request->all(), $id);
        $result = $updateTaskHandle($command);

        return new TaskResource($result);
    }

    public function delete($id , DeleteTaskHandle $deleteTaskHandle)
    {
        $result = $deleteTaskHandle($id);

        return new TaskResource($result);
    }

    public function getAll(TaskGetAllHandle $taskGetAllHandle)
    {
        $result = $taskGetAllHandle();

        return TaskResource::collection($result);
    }

    public function getById($id, TaskGetByIdHandle $taskGetByIdHandle)
    {
        $result = $taskGetByIdHandle($id);

        return new TaskResource($result);
    }
}
