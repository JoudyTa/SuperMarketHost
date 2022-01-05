<?php

namespace App\Http\Controllers;

use App\Traits\TraitPhoto;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    use TraitPhoto;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //  if (Product::where('name', 'like', '%' . $request->name . '%'))
        //    return response(['There is already a product with this name']);

        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'ex_date' => 'required',
            'photo' => 'required',
            'pro_phone_number' => 'required',

        ]);

        $file_name = $this->saveImage($request->photo, 'images/ProductsPhoto');
        $user = auth()->id();

        $product = Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'amount' => $request->amount,
            'ex_date' => $request->ex_date,
            'photo' => $file_name,
            'pro_phone_number' => $request->pro_phone_number,
            'us_id' => $user
        ]);


        //To save the discounts for product
        //   foreach ($request->list_discounts as $discount) {
        $product->discounts()->create([
            'date_price' => $request->date_price,
            'price_after_sell' => $request->price_after_sell,
        ]);
        // }
        return response("product created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product  $product)
    {
        $discount = $product->discounts()->get();
        $comments = $product->comments()->get();
        $data['Product'] = $product;
        $data['Discount'] = $discount;
        $data['Comments'] = $comments;
        $product->update(['show' => $product->show + 1]);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return   $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Product::destroy($id);
    }
    /**
     * serch for name , brand
     *
     * @param str $name
     * @param str $brand
     * @return  Illuminate\Http\Response
     *
     */
    public function search($search)
    {
        if (Product::where('name', 'like', '%' . $search . '%'))
            return  Product::where('name', 'like', '%' . $search . '%')
                ->orWhere('brand', 'like', '%' . $search . '%')
                ->orWhere('ex_date', 'like', '%' . $search . '')
                ->get();
        else
            return response(['Not Found']);
    }
}