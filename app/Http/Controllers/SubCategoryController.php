<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Models\Category;
use App\Service\SubCategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = Category::all();
        $subcategories = $this->subCategoryService->getAll($search);
        return view('SubCategory.index', compact('subcategories', 'category'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        dd($request->all());
        $data = $request->validated();
        try {
            $this->subCategoryService->store($data);
            return redirect()->route('subcategories.index')
                ->with('success', 'Subkategori berhasil ditambahkan');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }
}
