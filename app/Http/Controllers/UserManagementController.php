<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserManagementRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Service\UserManagementService;
use Illuminate\Validation\ValidationException;
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

    public function store(StoreUserManagementRequest $request)
    {
        $data = $request->validated();
        try {
            $this->userService->store($data);
            return redirect()->route('users.index')
                ->with('success', 'Akun Berhasil ditambahkan');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
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
