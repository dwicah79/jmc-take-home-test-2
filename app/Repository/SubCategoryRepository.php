<?php
namespace App\Repository;
use App\Models\SubCategory;
use App\Repository\Interfaces\SubCategoryRepositoryInterfaces;

class SubCategoryRepository implements SubCategoryRepositoryInterfaces
{
    public function all($search = null)
    {
        $query = SubCategory::with('category')->orderBy('id', 'desc');

        if ($search) {
            $query->whereHas('category', function ($q) use ($search) {
                $q->where('name_category', 'like', "%$search%");
            })->orWhere('name_sub_category', 'like', "%$search%")
                ->orWhere('category_code', 'like', "%$search%");
        }
        return $query->paginate(10);
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
