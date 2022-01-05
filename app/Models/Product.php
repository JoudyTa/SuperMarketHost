<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_Comment;
use App\Models\Like;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'brand', 'price', 'amount', 'ex_date', 'photo', 'pro_phone_number', 'description', 'us_id', 'show'];
    protected $primaryKey = "id";
    public function user()
    {
        return $this->belongsTo(User::class, 'us_id')->orderBy('created_at');
    }
    public function comments()
    {
        return $this->hasMany(User_Comment::class, 'product_id')->orderBy('created_at');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'pr_id')->orderBy('date_price');
    }

    public $withCount = ['comments', 'likes'];
}