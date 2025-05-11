<?php
namespace App\Repository;

use App\Models\IncomingGoodsDetile;
use App\Repository\Interfaces\IncomingGoodsDetileRepositoryinterfaces;

class IncomingGoodsDetileRepository implements IncomingGoodsDetileRepositoryinterfaces
{
    public function insert(array $items)
    {
        return IncomingGoodsDetile::insert($items);
    }


    public function deleteByincomingGoodsId($incomingGoodsId)
    {
        return IncomingGoodsDetile::where('incoming_goods_id', $incomingGoodsId)->delete();
    }

    public function verified($id, $data)
    {
        return IncomingGoodsDetile::where('id', $id)->update(['status' => $data ? 1 : 0]);
    }
}
