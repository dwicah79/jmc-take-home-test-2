<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomingGoodsController extends Controller
{
    public function index()
    {
        return view('IncomingGoods.index');
    }
}
