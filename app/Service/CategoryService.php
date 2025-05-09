<?php

namespace App\Service;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryService
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterfaces $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->all();
    }

    public function store(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
