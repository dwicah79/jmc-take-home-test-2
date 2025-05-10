<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryRepository implements CategoryRepositoryInterfaces
{
    public function all($search = null)
    {
        $query = Category::query()->orderBy('id', 'desc');

        if ($search) {
            $query->where('code_category', 'like', "%$search%")
                ->orWhere('name_category', 'like', "%$search%");
        }

        return $query->paginate(10);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
