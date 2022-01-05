<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Like extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $fillable = ['product_id', 'user_id', 'like'];
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}