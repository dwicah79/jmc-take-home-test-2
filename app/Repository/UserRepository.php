<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterfaces;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterfaces
{
    public function all()
    {
        return User::paginate(10);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->assignRole($data['role']);
        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->syncRoles([$data['role']]);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
        return $user;
    }

    public function lock($id)
    {
        $user = $this->find($id);
        $user->is_locked = true;
        $user->save();
        return $user;
    }

    public function unlock($id)
    {
        $user = $this->find($id);
        $user->is_locked = false;
        $user->save();
        return $user;
    }

    public function authenticate(string $username, string $password)
    {
        $user = User::where('username', $username)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return ['status' => false, 'message' => 'Invalid credentials'];
        }
        if ($user->is_locked) {
            return ['status' => false, 'message' => 'Akun dikunci, Harap hubungi admin.'];
        }
        auth()->login($user);
        return ['status' => true, 'user' => $user];
    }
}
