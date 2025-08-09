<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class ItemController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'category',
            'user',
            'comments.user',
        ])
        ->withCount(['likes', 'comments'])
        ->findOrFail($id);

        $isLiked = auth()->check()
            ? Like::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists()
            : false;

    return view('item.show', [
        'product' => $product,
        'isLiked' => $isLiked,
    ]);
    }

    public function comment(CommentRequest $request, $id)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('items.show', ['id' => $id])->with('success', 'コメントを投稿しました。');
    }

    public function toggleLike(\Illuminate\Http\Request $request, int $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $userId  = $request->user()->id;

        $existing = Like::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($existing) {
            $existing->delete();
        } else {
            Like::create([
                'user_id'    => $userId,
                'product_id' => $product->id,
            ]);
        }

        return back();
    }

}
