<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = ['price_after_sell', 'pr_id', 'date_price'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'pr_id');
    }
}