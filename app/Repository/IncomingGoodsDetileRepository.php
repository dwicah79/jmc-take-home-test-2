<?php
namespace App\Repository;

use App\Models\IncomingGoodsDetile;
use App\Repository\Interfaces\IncomingGoodsDetileRepositoryinterfaces;

class IncomingGoodsDetileRepository implements IncomingGoodsDetileRepositoryinterfaces
{
    public function createMany($incomingGoodsId, array $details)
    {
        foreach ($details as &$detail) {
            $detail['incoming_goods_id'] = $incomingGoodsId;
        }
        return IncomingGoodsDetile::insert($details);
    }

    public function deleteByincomingGoodsId($incomingGoodsId)
    {
        return IncomingGoodsDetile::where('incoming_goods_id', $incomingGoodsId)->delete();
    }
}
