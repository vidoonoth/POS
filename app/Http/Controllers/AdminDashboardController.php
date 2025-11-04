<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $customerCount = Customer::count();
        $saleCount = Sale::count();

        // Chart data for sales over the last 7 days
        $salesData = Sale::selectRaw('DATE(created_at) as date, SUM(final_amount) as total_sales')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('D, M d');
            $salesForDate = $salesData->where('date', $date)->first();
            $data[] = $salesForDate ? $salesForDate->total_sales : 0;
        }

        return view('dashboard', compact('productCount', 'categoryCount', 'customerCount', 'saleCount', 'labels', 'data'));
    }
}
