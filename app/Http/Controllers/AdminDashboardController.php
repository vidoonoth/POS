<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $customerCount = Customer::count();
        $saleCount = Sale::count();

        return view('dashboard', compact('productCount', 'categoryCount', 'customerCount', 'saleCount'));
    }
}
