<?php

namespace App\Http\Controllers\Api\V1;

use App\Command\CreateCategoryCommand;
use App\Command\UpdateCategoryCommand;
use App\Handle\CategoryGetAllHandle;
use App\Handle\CategoryGetByIdHandle;
use App\Handle\CreateCategoryHandle;
use App\Handle\DeleteCategoryHandle;
use App\Handle\UpdateCategoryHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request, CreateCategoryHandle $createCategoryHandle)
    {
        $command = CreateCategoryCommand::make($request->all());

        $result = $createCategoryHandle($command);

        return new CategoryResource($result);
    }

    public function update(Request $request, $id, UpdateCategoryHandle $updateCategoryHandle)
    {
        $command = UpdateCategoryCommand::make($request->all(), $id);
        $result = $updateCategoryHandle($command);

        return new CategoryResource($result);
    }

    public function delete($id , DeleteCategoryHandle $deleteCategoryHandle)
    {
        $result = $deleteCategoryHandle($id);

        return new CategoryResource($result);
    }

    public function getAll(CategoryGetAllHandle $categoryGetAllHandle)
    {
        $result = $categoryGetAllHandle();

        return CategoryResource::collection($result);
    }

    public function getById($id, CategoryGetByIdHandle $categoryGetByIdHandle)
    {
        $result = $categoryGetByIdHandle($id);

        return new CategoryResource($result);
    }
}
