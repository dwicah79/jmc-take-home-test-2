<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Service\UserManagementService;

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
        $roles = Role::all();
        return view('UserManagement.index', compact('users', 'roles'));
    }

    public function lock($id)
    {
        try {
            $this->userService->lock($id);
            return back()
                ->with('success', 'User berhasil dikunci');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal mengunci user: ' . $e->getMessage());
        }
    }

    public function unlock($id)
    {
        try {
            $this->userService->unlock($id);
            return back()
                ->with('success', 'User berhasil dibuka kuncinya');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal membuka kunci user: ' . $e->getMessage());
        }
    }
}
