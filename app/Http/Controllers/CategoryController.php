<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil ditambahkan');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->back()
                    ->withInput()
                    ->with('warning', 'Kode kategori sudah terdaftar, silakan gunakan kode lain.');
            }
            return redirect()->route('categories.index')
                ->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }
}
