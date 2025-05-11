<?php
namespace App\Repository\Interfaces;

interface IncomingGoodsDetileRepositoryinterfaces
{
    public function insert(array $items);
    public function deleteByincomingGoodsId($incomingGoodsId);
}
