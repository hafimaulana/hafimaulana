<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        // Dummy logic: Tambahkan produk ke session cart
        $cart = session()->get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + 1;
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
