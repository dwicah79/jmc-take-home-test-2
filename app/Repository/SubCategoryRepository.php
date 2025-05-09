<?php
namespace App\Repository;
use App\Models\SubCategory;
use App\Repository\Interfaces\SubCategoryRepositoryInterfaces;

class SubCategoryRepository implements SubCategoryRepositoryInterfaces
{
    public function all()
    {
        return SubCategory::with('category')->paginate(10);
    }

    public function find($id)
    {
        return SubCategory::findOrFail($id);
    }

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    public function update($id, array $data)
    {
        $sub = SubCategory::findOrFail($id);
        $sub->update($data);
        return $sub;
    }

    public function delete($id)
    {
        return SubCategory::destroy($id);
    }
}
