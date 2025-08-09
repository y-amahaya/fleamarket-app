<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function purchase(int $item_id, Request $request)
    {
        $product = Product::findOrFail($item_id);

        $item = [
            'id'          => $product->id,
            'name'        => $product->name,
            'price'       => $product->price,
            'description' => $product->description,
            'image_path'  => $product->image_path,
        ];

        $userAddress = array_merge([
            'postal_code' => '',
            'prefecture'  => '',
            'city'        => '',
            'address'     => '',
        ], (array) session('purchase_address', []));

        $selectedMethod = session('payment_method');

        $methodLabels = self::paymentMethodLabels();
        $selectedMethodLabel = $selectedMethod ? $methodLabels[$selectedMethod] : '未選択';

        return view('purchase.purchase', [
            'item'                 => $item,
            'userAddress'          => $userAddress,
            'methodLabels'         => $methodLabels,
            'selectedMethod'       => $selectedMethod,
            'selectedMethodLabel'  => $selectedMethodLabel,
        ]);
    }

    public function selectMethod(PurchaseRequest $request, int $item_id)
    {
        session(['payment_method' => $request->input('payment_method')]);
        return redirect()->route('purchase.show', ['item_id' => $item_id]);
    }

    public function addressEdit(Request $request)
    {
    $userAddress = session('purchase_address', [
        'postal_code' => '',
        'prefecture'  => '',
        'city'        => '',
        'address'     => '',
    ]);

    if ($request->filled('item_id')) {
        session(['return_item_id' => (int)$request->query('item_id')]);
    }

        return view('purchase.address.address_edit', compact('userAddress'));
    }

    public function addressUpdate(AddressRequest $request)
    {

        $validated = $request->validated();

        $payload = [
            'postal_code' => $validated['postal_code'] ?? '',
            'prefecture'  => $request->input('prefecture', ''),
            'city'        => $request->input('city', ''),
            'address'     => $validated['address'] ?? '',
        ];

        session(['purchase_address' => $payload]);

        $itemId = session('return_item_id');
        session()->forget('return_item_id');

        return $itemId
            ? redirect()->route('purchase.show', ['item_id' => $itemId])
            : redirect()->route('mypage.index');
    }

    public function store(int $item_id, Request $request)
    {
        if (!session('payment_method')) {
            return back()->withErrors(['payment_method' => '先に支払い方法を選択してください。']);
        }

        Product::where('id', $item_id)->update(['is_sold' => true]);
        return redirect()->route('products.index');
    }

    private static function paymentMethodLabels(): array
    {
        return [
            'convenience' => 'コンビニ払い',
            'card'        => 'クレジットカード払い',
        ];
    }
}