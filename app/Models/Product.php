<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // 'category_id' is the foreign key
    }
    protected $fillable = ['product_id', 'category_id', 'name', 'description', 'image', 'price', 'view_count', 'nutrition' , 'full_description', 'preparation' , 'ingredient'];
    // In Product.php model
    protected $primaryKey = 'product_id';

}
