<?php
namespace App\Service;

class UserManagementService
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct($userRepository, $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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
