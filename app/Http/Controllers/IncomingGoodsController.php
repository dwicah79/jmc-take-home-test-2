<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Service\IncomingGoodsService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IncomingGoodsRequest;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IncomingGoodsExport;
use App\Models\IncomingGoods;

class IncomingGoodsController extends Controller
{
    protected $incomingGoodsService;
    public function __construct(IncomingGoodsService $incomingGoodsService)
    {
        $this->incomingGoodsService = $incomingGoodsService;
    }
    public function index()
    {
        $filters = request()->only(['category_id', 'sub_category_id', 'year', 'search']);
        $categories = $this->incomingGoodsService->getCategory();
        $subcategories = $this->incomingGoodsService->getSubCategory($filters['category_id'] ?? null);
        $years = $this->incomingGoodsService->getYear() ?? collect();
        $incomingGoods = $this->incomingGoodsService->list($filters);
        return view('IncomingGoods.index', compact('incomingGoods', 'filters', 'categories', 'subcategories', 'years'));
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

    public function store(IncomingGoodsRequest $request)
    {
        try {
            $validated = $request->validated();
            $items = $validated['items'];
            unset($validated['items']);
            $incomingGoods = $this->incomingGoodsService->create(
                $validated,
                $items,
                $request->file('attachment')
            );
            return redirect()->route('incoming-goods.index')
                ->with('success', 'Barang masuk berhasil ditambahkan');
        } catch (ValidationException $e) {
            Log::error('Validasi gagal:', $e->validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->incomingGoodsService->destroy($id);
            return redirect()->route('incoming-goods.index')
                ->with('success', 'Barang masuk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('incoming-goods.index')
                ->with('error', 'Gagal menghapus barang masuk: ' . $e->getMessage());
        }
    }

    public function verified($id)
    {
        try {
            $this->incomingGoodsService->verified($id, true);
            return redirect()->route('incoming-goods.index')
                ->with('success', 'Barang masuk berhasil diverifikasi');
        } catch (\Exception $e) {
            return redirect()->route('incoming-goods.index')
                ->with('error', 'Gagal memverifikasi barang masuk: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $filters = $request->only(['category_id', 'sub_category_id', 'year', 'search']);
        return Excel::download(new IncomingGoodsExport($request), 'incoming-goods.xlsx');
    }

    public function print($id)
    {
        $incoming = IncomingGoods::with('goodsDetail', 'operator', 'category')->findOrFail($id);

        return view('IncomingGoods.print', compact('incoming'));
    }


}
