<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['code_category', 'name_category'];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
