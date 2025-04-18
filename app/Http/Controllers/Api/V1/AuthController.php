<?php

namespace App\Http\Controllers\Api\V1;

use App\Command\LoginCommand;
use App\Command\RegisterCommand;
use App\Handle\LoginHandle;
use App\Handle\RegisterHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
    }

    public function register(Request $request, RegisterHandle $registerHandle)
    {
        try {
            $command = RegisterCommand::make($request->all());
            $result = $registerHandle($command);

            return new AuthResource($result);
        }catch (ValidationException $e) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\RuntimeException $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request, LoginHandle $loginHandle)
    {
        try {
            $command = LoginCommand::make($request->all());
            $result = $loginHandle($command);

            return new AuthResource($result);
        }catch (ValidationException $e) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\RuntimeException $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
