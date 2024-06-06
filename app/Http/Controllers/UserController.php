<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function updateAdmin(Request $request, $id)
    {
        $dataAdminUpdate = $this->userService->updateAdmin($request,$id);
        return response()->json(['message' => 'Admin data updated successfully', 'Admin' => $dataAdminUpdate]);
    }



    public function updateClient(Request $request, $id)
    {
        $dataClientUpdate = $this->userService->updateClient($request,$id);
        return response()->json(['message' => 'User data updated successfully', 'user' => $dataClientUpdate]);
    }

}
