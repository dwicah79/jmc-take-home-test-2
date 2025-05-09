<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll();
        return view('Category.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $this->categoryService->store($data);
            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create category: ' . $e->getMessage());
        }
    }
}
