<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_code', 'category_name'];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
