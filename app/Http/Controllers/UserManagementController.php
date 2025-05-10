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

    public function lock($id)
    {
        try {
            $this->userService->lock($id);
            return redirect()->route('user.index')
                ->with('success', 'User berhasil dikunci');
        } catch (\Exception $e) {
            return redirect()->route('user.index')
                ->with('error', 'Gagal mengunci user: ' . $e->getMessage());
        }
    }

    public function unlock($id)
    {
        try {
            $this->userService->unlock($id);
            return redirect()->route('user.index')
                ->with('success', 'User berhasil dibuka kuncinya');
        } catch (\Exception $e) {
            return redirect()->route('user.index')
                ->with('error', 'Gagal membuka kunci user: ' . $e->getMessage());
        }
    }
}
