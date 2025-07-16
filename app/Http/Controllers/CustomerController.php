<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $availableProducts = Product::where('stock', '>', 0)->count();
        $productCategories = Product::distinct('roast_level')->count();
        $featuredProducts = Product::where('stock', '>', 0)->take(6)->get();
        
        return view('customer.dashboard', compact('totalProducts', 'availableProducts', 'productCategories', 'featuredProducts'));
    }

    public function profile()
    {
        $user = Auth::user();
        
        // Dummy data untuk statistik order
        $totalOrders = 0;
        $totalSpent = 0;
        $lastOrderDate = null;
        
        return view('customer.profile', compact('user', 'totalOrders', 'totalSpent', 'lastOrderDate'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

        return redirect()->route('customer.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return redirect()->route('customer.profile')
            ->with('success', 'Password updated successfully.');
    }

    public function orders()
    {
        // Dummy data untuk orders customer
        $orders = [];
        
        return view('customer.orders.index', compact('orders'));
    }
}
