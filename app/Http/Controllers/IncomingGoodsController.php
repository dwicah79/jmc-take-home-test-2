<?php

namespace App\Http\Controllers;

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
        // return $incomingGoods;
        return view('IncomingGoods.index', compact('incomingGoods'));
    }
}
