<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'operator');
        })->get();
        return view('IncomingGoods.create', compact('users'));
    }
}
