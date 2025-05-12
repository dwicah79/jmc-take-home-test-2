<?php
namespace App\Repository;

use App\Models\User;
use App\Models\Category;
use App\Models\IncomingGoods;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use App\Repository\Interfaces\IncomingGoodsRepositoryInterfaces;

class IncomingGoodsRepository implements IncomingGoodsRepositoryInterfaces
{
    public function all($filters)
    {
        $query = IncomingGoods::with(['category', 'subcategory', 'operator', 'goodsDetail']);

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['sub_category_id'])) {
            $query->where('sub_category_id', $filters['sub_category_id']);
        }

        if (!empty($filters['year'])) {
            $query->whereYear('date', $filters['year']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('origin_of_goods', 'like', "%{$filters['search']}%")
                    ->orWhereHas('subcategory', function ($q2) use ($filters) {
                        $q2->where('name', 'like', "%{$filters['search']}%");
                    });
            });
        }

        return $query->orderByDesc('date')->paginate(10);
    }

    public function find($id)
    {
        return IncomingGoods::with('barangDetails')->findOrFail($id);
    }

    public function create(array $data)
    {
        return IncomingGoods::create($data);
    }

    public function update($id, array $data)
    {
        $model = IncomingGoods::findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return IncomingGoods::destroy($id);
    }

    public function getOperator()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'operator');
        })->where('is_locked', false)->get();
    }

    public function getCategory()
    {
        return Category::all();
    }

    public function getSubCategory($categoryId)
    {
        return DB::table('sub_categories')
            ->where('category_id', $categoryId)
            ->select('id', 'sub_category_name', 'price_range')
            ->get()
            ->map(function ($item) {
                $item->price_range = (float) $item->price_range; // Pastikan numeric
                return $item;
            });
    }
}
