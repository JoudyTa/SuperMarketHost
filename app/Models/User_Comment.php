<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Comment extends Model
{

    use HasFactory;
    protected $fillable = ['product_id', 'user_comment', 'user_id'];
    protected $primaryKey = "id";
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}