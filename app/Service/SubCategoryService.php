<?php
namespace App\Service;

use App\Repository\Interfaces\SubCategoryRepositoryInterfaces;

class SubCategoryService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterfaces $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getAll()
    {
        return $this->subCategoryRepository->all();
    }

    public function store(array $data)
    {
        return $this->subCategoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->subCategoryRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->subCategoryRepository->delete($id);
    }
}
