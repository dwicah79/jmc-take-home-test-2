<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterfaces $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $result = $this->userRepo->authenticate($request->username, $request->password);

            if (!$result['status']) {
                return redirect()->back()->with($result['type'], $result['message']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during login.']);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->userRepo->logout($request->user()->id);
            return redirect('/login')->with('success', 'Logged out successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during logout.']);
        }
    }

}
