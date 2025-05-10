<?php
namespace App\Repository\Interfaces;

interface IncomingGoodsDetileRepositoryinterfaces
{
    public function createMany($incomingGoodsId, array $details);
    public function deleteByincomingGoodsId($incomingGoodsId);
}
