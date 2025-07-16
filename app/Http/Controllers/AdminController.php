<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCustomers = User::whereHas('role', function($query) {
            $query->where('name', 'customer');
        })->count();

        // Tambahkan variabel dummy agar error hilang
        $newProductsThisMonth = 0;
        $totalOrders = 0;
        $newOrdersThisMonth = 0;
        $totalRevenue = 0;
        $revenueGrowth = 0;
        $newCustomersThisMonth = 0;
        $recentOrders = [];
        $lowStockProducts = [];

        return view('admin.dashboard', compact(
            'totalProducts', 'totalCustomers', 'newProductsThisMonth', 'totalOrders',
            'newOrdersThisMonth', 'totalRevenue', 'revenueGrowth', 'newCustomersThisMonth',
            'recentOrders', 'lowStockProducts'
        ));
    }

    public function customers()
    {
        $customers = User::whereHas('role', function($query) {
            $query->where('name', 'customer');
        })->paginate(10);
        
        return view('admin.customers', compact('customers'));
    }

    public function showCustomer(User $customer)
    {
        return view('admin.customer-show', compact('customer'));
    }

    public function editCustomer($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.edit-customer', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $customer = User::findOrFail($id);
        $customer->update($request->only(['name', 'email']));

        return redirect()->route('admin.customers')
            ->with('success', 'Customer updated successfully.');
    }

    public function deleteCustomer(User $customer)
    {
        if ($customer->id === Auth::id()) {
            return redirect()->route('admin.customers')
                ->with('error', 'You cannot delete your own account.');
        }

        $customer->delete();

        return redirect()->route('admin.customers')
            ->with('success', 'Customer deleted successfully.');
    }

    public function reports()
    {
        // Dummy data for reports
        $totalRevenue = 0;
        $totalOrders = 0;
        $totalCustomers = 0;
        $monthlyRevenue = [];
        $topProducts = [];
        
        return view('admin.reports.index', compact('totalRevenue', 'totalOrders', 'totalCustomers', 'monthlyRevenue', 'topProducts'));
    }
}
