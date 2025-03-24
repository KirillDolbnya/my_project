<?php

namespace App\Http\Controllers\Api\V1;

use App\Command\RegisterCommand;
use App\Handle\RegisterHandle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
    }

    public function register(Request $request, RegisterHandle $registerHandle)
    {
        $command = RegisterCommand::make($request->all());
        $request = $registerHandle($command);

        print_r($request);
    }

    public function login(Request $request)
    {

    }
}
