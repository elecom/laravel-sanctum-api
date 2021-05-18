<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return [
                'status' => 200,
                'product' => $product
            ];
        }
        else{
            return [
                'status' => 404,
                'message' => 'Product not found'
            ];
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        
        if($product){
            $product->update($request->all());
            return [
                'status' => 200,
                'product' => $product
            ];
        }
        else{
            return [
                'status' => 404,
                'message' => 'Product not found'
            ];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product){
            Product::destroy($id);

            return [
                'status' => 200,
                'message' => 'Product deleted'
            ];
        }
        else{
            return [
                'status' => 404,
                'message' => 'Product not found'
            ];
        }
        
    }
}
