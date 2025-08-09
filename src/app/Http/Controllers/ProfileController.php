<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Product;
use App\Models\Purchase;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab  = $request->query('page', 'sell');

        if ($tab === 'sell') {
            $items = Product::withCount(['likes','comments'])
                ->with(['category'])
                ->where('user_id', $user->id)
                ->latest('id')
                ->get();
        } else {
            $items = Product::withCount(['likes','comments'])
                ->with(['category','user'])
                ->whereHas('purchase', fn($q) => $q->where('user_id', $user->id))
                ->latest('id')
                ->get();
        }

        return view('mypage.profile', [
            'user'  => $user,
            'tab'   => $tab,
            'items' => $items,
        ]);
    }


    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('profile_images', 'public');
            $user->profile_image = $path;
        } elseif (!$user->profile_image) {
            $user->profile_image = 'default_profile.png';
        }

        $user->name = $request->input('name');
        $user->postal_code = $request->input('postal_code');
        $user->address = $request->input('address');
        $user->building = $request->input('building');
        $user->save();

        return redirect()->route('mypage.index', ['page' => 'sell'])
            ->with('success', 'プロフィールを更新しました');
    }

    public function edit()
    {
        return view('mypage.profile.profile_edit');
    }
}