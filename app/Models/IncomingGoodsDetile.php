<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoodsDetile extends Model
{
    protected $table = 'incoming_goods_detiles';
    protected $fillable = [
        'incoming_goods_id',
        'goods_name',
        'price',
        'volume',
        'unit',
        'total',
        'expired_date',
    ];

    public function incomingGoods()
    {
        return $this->belongsTo(IncomingGoods::class);
    }
}
