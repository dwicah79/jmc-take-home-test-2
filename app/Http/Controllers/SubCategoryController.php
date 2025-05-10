<?php

namespace App\Http\Controllers;

use App\Service\SubCategoryService;
use Illuminate\Http\Request;

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
        $subcategories = $this->subCategoryService->getAll($search);
        return $subcategories;
        return view('SubCategory.index', compact('subcategories'));
    }
}
