<?php
namespace App\Service;

use App\Repository\UserRepository;

class UserManagementService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all($search = null)
    {
        return $this->userRepository->all($search);
    }
    public function store(array $data)
    {
        return $this->userRepository->create($data);
    }
    public function update($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }
    public function destroy($id)
    {
        return $this->userRepository->delete($id);
    }
}
