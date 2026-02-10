<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
                //   ->orWhere('description', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(9)
        ->withQueryString();

        return view('products', compact('products'));
    }
}
