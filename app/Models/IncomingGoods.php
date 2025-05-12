<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoods extends Model
{
    protected $table = 'incoming_goods';
    protected $guarded = [
        'id'
    ];

    public function operator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function goodsDetail()
    {
        return $this->hasMany(IncomingGoodsDetile::class);
    }
}
