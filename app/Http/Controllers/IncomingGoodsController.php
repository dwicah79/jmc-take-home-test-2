<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Service\IncomingGoodsService;

class IncomingGoodsController extends Controller
{
    protected $incomingGoodsService;
    public function __construct(IncomingGoodsService $incomingGoodsService)
    {
        $this->incomingGoodsService = $incomingGoodsService;
    }
    public function index()
    {
        $filters = request()->all();
        $incomingGoods = $this->incomingGoodsService->list($filters);
        return view('IncomingGoods.index', compact('incomingGoods'));
    }

    public function create()
    {
        $users = $this->incomingGoodsService->getOperator();
        $categories = $this->incomingGoodsService->getCategory();
        $subcategories = collect();

        if (old('category_id')) {
            $subcategories = $this->incomingGoodsService->getSubCategory(old('category_id'));
        }

        return view('IncomingGoods.create', compact('users', 'categories', 'subcategories'));
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->category_id;
        $subcategories = [];

        if ($categoryId) {
            $subcategories = $this->incomingGoodsService->getSubCategory($categoryId);
        }

        return response()->json($subcategories);
    }
}
