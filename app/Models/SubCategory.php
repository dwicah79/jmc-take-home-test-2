<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'sub_category_name', 'price_range'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
