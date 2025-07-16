<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Dummy data for now
        $orders = [];
        return view('admin.orders.index', compact('orders'));
    }
} 