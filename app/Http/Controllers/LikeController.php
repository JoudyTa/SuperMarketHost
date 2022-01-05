<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Product $product)
    {
        //
        if ($product->likes()->where('user_id', auth()->id())->exists()) {

            $product->likes()->where('user_id', auth()->id())->delete();
        } else {
            $product->likes()->create([
                'user_id' => auth()->id()
            ]);
        }
        return response()->json(null);
    }
}