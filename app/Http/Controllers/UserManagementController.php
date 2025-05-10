<?php

namespace App\Http\Controllers;

use App\Service\UserManagementService;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    protected $userService;

    public function __construct(UserManagementService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = $this->userService->all($search);
        return view('UserManagement.index', compact('users'));
    }
}
