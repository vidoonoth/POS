<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['user', 'customer'])->get();
        return view('admin.sales.index', compact('sales'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $sale->load(['user', 'customer', 'details.product']);
        return view('admin.sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $users = User::all();
        $customers = Customer::all();
        $products = Product::all();
        $sale->load('details');
        $invoiceNumber = $sale->invoice_number; // Use existing invoice number for edit
        return view('admin.sales.edit', compact('sale', 'users', 'customers', 'products', 'invoiceNumber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'invoice_number' => 'required|string|max:255|unique:sales,invoice_number,' . $sale->id,
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $sale) {
            $totalAmount = 0;
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $totalAmount += $product->price * $item['quantity'];
            }

            $discount = $request->input('discount', 0);
            $finalAmount = $totalAmount - $discount;

            $sale->update([
                'user_id' => $request->user_id,
                'customer_id' => $request->customer_id,
                'invoice_number' => $request->invoice_number,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_method' => $request->payment_method,
                'status' => $request->status,
                'notes' => $request->notes,
            ]);

            // Delete old sale details and create new ones
            $sale->details()->delete();
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }
        });

        return redirect()->route('admin.sales.index')
                         ->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            $sale->details()->delete();
            $sale->delete();
        });

        return redirect()->route('admin.sales.index')
                         ->with('success', 'Sale deleted successfully.');
    }
}
