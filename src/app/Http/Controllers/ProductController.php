<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'all');

        $query = Product::with(['category', 'user'])
            ->withCount(['likes', 'comments'])
            ->orderByDesc('id');

        if ($tab === 'mylist') {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
            $query->whereHas('likes', fn ($q) => $q->where('user_id', auth()->id()));

            $products = $query->get();

            return view('index', [
                'products' => $products,
                'type' => $tab,
            ]);
        }

        $products = Product::with('category')->get();

        return view('index', [
            'products' => $products,
            'type' => 'all',
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['comments.user'])
            ->withCount('comments')
            ->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
