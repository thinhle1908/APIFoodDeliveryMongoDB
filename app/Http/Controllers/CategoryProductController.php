<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category_Product;
use Symfony\Component\Console\Input\Input;

class CategoryProductController extends Controller
{
    public function store(Request $request, $id, $value)
    {
        $request->merge([
            'product_id' => $id,
            'category_id'=>$value
        ]);
        request()->validate([
            'product_id' => 'required',
            'category_id' => 'required'
        ]);
        $categoryProduct = new Category_Product();
        $categoryProduct->product_id = $request->product_id;
        $categoryProduct->category_id = $request->category_id;
        $categoryProduct->save();
        // return Category_Product::create([
        //     "product_id"  => request('product_id'),
        //     "category_id" => request('category_id')
        // ]);
    }
    public function destroyByID($product_id,Request $request)
    {
        $request->merge([
            'product_id' => $product_id,
        ]);
        request()->validate([
            'product_id' => 'required',
        ]);
        $categoryProduct =  Category_Product::where('product_id',$product_id)->delete();
        
    }
}
