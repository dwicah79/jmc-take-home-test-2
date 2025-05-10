<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingGoods extends Model
{
    protected $table = 'incoming_goods';
    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'origin_of_goods',
        'document_number',
        'attachment',
        'total_price',
        'date',
        'status',
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
        return $this->belongsTo(SubCategory::class);
    }

    public function goodsDetail()
    {
        return $this->hasMany(IncomingGoodsDetile::class);
    }
}
