<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);

        $conditions = [
            'new'        => '新品',
            'like_new'   => '未使用に近い',
            'good'       => '目立った傷や汚れなし',
            'acceptable' => 'やや傷や汚れあり',
            'poor'       => '傷や汚れあり',
        ];

        return view('sell.create', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $firstImageUrl = null;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('products', 'public');
                if ($idx === 0) $firstImageUrl = $path;
            }
        }

        $product = Product::create([
            'name'        => $request->input('name'),
            'brand'       => $request->input('brand'),
            'description' => $request->input('description'),
            'price'       => (int) $request->input('price'),
            'category_id' => (int) $request->input('category_id'),
            'condition'   => $request->input('condition'),
            'image_path'  => $firstImageUrl,
            'user_id'     => auth()->id(),
        ]);

        return redirect()->route('items.show', ['id' => $product->id])
            ->with('status', '出品が完了しました');
    }
}
