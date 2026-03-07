<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::query()
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->when($request->category, function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })
        ->latest()
        ->paginate(9)
        ->withQueryString();

        return view('products', compact('products','categories'));
    }
}
