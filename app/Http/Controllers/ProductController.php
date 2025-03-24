<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('products.index', compact('products'));
}

public function create()
{
    return view('products.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    Product::create($request->all());
    return redirect()->route('products.index')->with('success', 'Product created.');
}

public function edit(Product $product)
{
    return view('products.edit', compact('product'));
}

public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    $product->update($request->all());
    return redirect()->route('products.index')->with('success', 'Product updated.');
}

public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted.');
}



public function purchase(Product $product)
{
       /** @var \App\Models\User $user */
$user = Auth::user();

    if (!$user || $user->role !== 'customer') {
        abort(403, 'Only customers can purchase.');
    }

    if ($user->credit < $product->price) {
        return back()->with('error', 'Insufficient credit.');
    }

    if ($product->stock < 1) {
        return back()->with('error', 'Product out of stock.');
    }

    // Deduct credit and reduce stock
    $user->credit -= $product->price;
    $user->save();

    $product->stock -= 1;
    $product->save();

    // Record purchase
    Purchase::create([
        'user_id' => $user->id,
        'product_id' => $product->id
    ]);

    return back()->with('success', 'Purchase successful!');
}
public function buy(Product $product)
{
/** @var \App\Models\User $user */
$user = Auth::user();
    // Only customers can buy
    if ($user->role !== 'customer') {
        abort(403, 'Only customers can purchase products.');
    }

    // Check stock
    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock.');
    }

    // Check credit
    if ($user->credit < $product->price) {
        return redirect()->back()->with('error', 'Insufficient credit.');
    }

    // Deduct credit and reduce stock
    $user->credit -= $product->price;
    $user->save();

    $product->stock -= 1;
    $product->save();

    // Record purchase
    $user->purchasedProducts()->attach($product->id);

    return redirect()->back()->with('success', 'Product purchased successfully!');
}

public function myPurchases()
{
    /** @var \App\Models\User $user */
$user = Auth::user();

    $purchases = $user->purchasedProducts()->get();

    return view('products.my_purchases', compact('purchases'));
}



}
