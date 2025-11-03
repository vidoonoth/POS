<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $sales = Sale::where('user_id', Auth::id())
                     ->with('details.product')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10); // Paginate for better performance

        return view('history-order.index', compact('sales'));
    }
}
