<?php
namespace App\Services;
use App\Repository\Interfaces\IncomingGoodsDetileRepositoryinterfaces;
use App\Repository\Interfaces\IncomingGoodsRepositoryInterface;

class IncomingGoodsService
{
    protected $goodsRepo;
    protected $detailRepo;

    public function __construct(
        IncomingGoodsRepositoryInterface $goodsRepo,
        IncomingGoodsDetileRepositoryinterfaces $detailRepo
    ) {
        $this->goodsRepo = $goodsRepo;
        $this->detailRepo = $detailRepo;
    }

    public function list($filters)
    {
        return $this->goodsRepo->all($filters);
    }

    public function show($id)
    {
        return $this->goodsRepo->find($id);
    }

    public function store($data, $details)
    {
        $incomingGoods = $this->goodsRepo->create($data);
        $this->detailRepo->createMany($incomingGoods->id, $details);
        return $incomingGoods;
    }

    public function update($id, $data, $details)
    {
        $this->goodsRepo->update($id, $data);
        $this->detailRepo->deleteByincomingGoodsId($id);
        $this->detailRepo->createMany($id, $details);
    }

    public function destroy($id)
    {
        $this->detailRepo->deleteByincomingGoodsId($id);
        $this->goodsRepo->delete($id);
    }
}
