<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    function index()
    {
        $categories = ProductCategory::all();
        return view('category.index', ['categories' => $categories]);
    }


    function add(Request $request)
    {

        if ($request->isMethod('post') && $request->has('add_category')) {

            if (!$errors = $request->validate([
                'name' => 'required|unique:product_category,category_name|max:255',
            ], [
                'name.unique' => 'Category ":input" already exists',
            ])) {
                return redirect()->withErrors($errors);
            }

            $p = new ProductCategory();
            $p->category_name = $request->get('name');
            $p->save();

            return redirect()->back()->with('successMsg', 'Category added successfully !!');
        }

        return view('category.add');
    }

    function delete(Request $request)
    {
        if ($request->has('category_id') && $request->has('delete_category')) {
            $c = ProductCategory::withCount('products')->where('id', $request->category_id)->first();
            if ($c->products_count > 0) {
                return redirect()->back()->with('errorMsg', 'Category has one or more products, so cannot be deleted!!');
            }
            $c->delete();
            return redirect()->back()->with('successMsg', 'Category deleted successfully !!');
        }
    }

    function edit(Request $request)
    {

        $p = ProductCategory::find($request->category_id);

        if ($request->isMethod('patch') && $request->has('edit_category')) {

            if (!$errors = $request->validate([
                'name' => 'required|unique:product_category,category_name|max:255',
            ], [
                'name.unique' => 'Category ":input" already exists',
            ])) {
                return redirect()->withErrors($errors);
            }

            $p->name = $request->get('name');
            $p->save();

            return redirect('products')->with('successMsg', 'Category updated successfully !!');
        }

        return view('category.edit', [
            'category' => $p,
        ]);
    }
}
