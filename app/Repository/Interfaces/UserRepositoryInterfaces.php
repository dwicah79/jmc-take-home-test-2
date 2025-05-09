<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterfaces
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function lock($id);
    public function unlock($id);

    public function authenticate(string $username, string $password);
}
