<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\Interfaces\CategoryRepositoryInterfaces;

class CategoryRepository implements CategoryRepositoryInterfaces
{
    public function all()
    {
        return Category::paginate(10);
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
