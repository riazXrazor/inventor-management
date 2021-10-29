<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\ProductAddRequest;


class ProductController extends Controller
{
    function index(Request $request)
    {
        $Products = Product::with('category')->get();
        return view('products.index', [
            'products' => $Products->toArray()
        ]);
    }

    function add(Request $request)
    {
        $ProductCategory = ProductCategory::all();

        if ($request->isMethod('post') && $request->has('add_product')) {

            if (!$errors = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'price' => 'required|digits_between:1,999',
                'stock' => 'required|digits_between:1,999',
            ])) {
                return redirect()->withErrors($errors)->withInput();
            }

            $p = new Product();
            $p->name = $request->get('name');
            $p->category_id = $request->get('category');
            $p->price = $request->get('price');
            $p->stock = $request->get('stock');
            $p->save();

            return redirect()->back()->with('successMsg', 'Product added successfully !!');
        }

        return view('products.add', [
            'ProductCategory' => $ProductCategory,
        ]);
    }

    function delete(Request $request)
    {
        if ($request->has('product_id') && $request->has('delete_product')) {
            Product::find($request->product_id)->delete();
            return redirect()->back()->with('successMsg', 'Product deleted successfully !!');
        }
    }

    function edit(Request $request)
    {
        $ProductCategory = ProductCategory::all();

        $p = Product::find($request->product_id);

        if ($request->isMethod('patch') && $request->has('edit_product')) {

            if (!$errors = $request->validate([
                'name' => 'required|max:255',
                'category' => 'required',
                'price' => 'required|digits_between:1,999',
                'stock' => 'required|digits_between:1,999',
            ])) {
                return redirect()->withErrors($errors);
            }

            $p->name = $request->get('name');
            $p->category_id = $request->get('category');
            $p->price = $request->get('price');
            $p->stock = $request->get('stock');
            $p->save();

            return redirect('products')->with('successMsg', 'Product updated successfully !!');
        }

        return view('products.edit', [
            'ProductCategory' => $ProductCategory,
            'product' => $p
        ]);
    }

    function getProductsByCategory(Request $request)
    {
        return Product::with('category')->where('category_id', $request->category_id)->get();
    }
}
