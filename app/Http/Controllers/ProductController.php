<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    function index(Request $request)
    {

        return view('products.index');
    }

    function getProductsByCategory(Request $request)
    {
        return Product::with('category')->where('category_id', $request->category_id)->get();
    }
}
