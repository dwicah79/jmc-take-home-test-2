<?php
namespace App\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repository\Interfaces\IncomingGoodsRepositoryInterfaces;
use App\Repository\Interfaces\IncomingGoodsDetileRepositoryinterfaces;


class IncomingGoodsService
{
    protected $goodsRepo;
    protected $detailRepo;

    public function __construct(
        IncomingGoodsRepositoryInterfaces $goodsRepo,
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

    public function create(array $data, array $items, $file = null)
    {
        if (empty($items)) {
            throw new \InvalidArgumentException('At least one item is required');
        }
        return DB::transaction(function () use ($data, $items, $file) {
            try {
                if ($file) {
                    $filename = Str::random(20) . '.' . $file->extension();
                    $path = $file->storeAs('incoming_goods/attachments', $filename, 'private');
                    $data['attachment_path'] = $path;
                }
                $incomingGoods = $this->goodsRepo->create($data);
                $items = array_map(function ($item) use ($incomingGoods) {
                    return [
                        'incoming_goods_id' => $incomingGoods->id,
                        'goods_name' => $item['name'],
                        'price' => $item['price'],
                        'volume' => $item['volume'],
                        'unit' => $item['unit'],
                        'expired_date' => $item['expired_date'] ?? null,
                        'total' => $item['price'] * $item['volume'],
                    ];
                }, $items);

                $this->detailRepo->insert($items);

                return $incomingGoods->load('goodsDetail');

            } catch (\Exception $e) {
                if (isset($path)) {
                    Storage::disk('private')->delete($path);
                }
                throw $e;
            }
        });
    }

    public function update($id, $data, $details)
    {
        $this->goodsRepo->update($id, $data);
        $this->detailRepo->deleteByincomingGoodsId($id);
        $this->detailRepo->insert($id, $details);
    }

    public function destroy($id)
    {
        $this->detailRepo->deleteByincomingGoodsId($id);
        $this->goodsRepo->delete($id);
    }

    public function getOperator()
    {
        return $this->goodsRepo->getOperator();
    }
    public function getCategory()
    {
        return $this->goodsRepo->getCategory();
    }
    public function getSubCategory($categoryId)
    {
        return $this->goodsRepo->getSubCategory($categoryId);
    }

    public function verified($id, $data)
    {
        return $this->detailRepo->verified($id, $data);
    }
}
