<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    // علاقة الفئة مع المنتجات (واحد إلى العديد)
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}

// Relation between proiducts and category ........... one to many
