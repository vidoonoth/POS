<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Sale;
use Midtrans\Config;
use App\Models\Product;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('pos.index', compact('products'));
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function processSale(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Process the sale (you'll need to implement this based on your requirements)
        DB::beginTransaction();
        try {
            $invoiceNumber = 'INV-' . time() . '-' . Auth::id(); // Generate a unique invoice number
            $sale = Sale::create([
                'user_id' => Auth::id(), // Assuming authenticated user is making the sale
                'customer_id' => null, // Customer ID is nullable, set to null for now
                'invoice_number' => $invoiceNumber,
                'total_amount' => 0, // Will be updated after calculating items
                'final_amount' => 0, // Initialize final_amount
                'payment_method' => $request->payment_method,
                'status' => 'pending', // Initial status
            ]);

            $totalAmount = 0;
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                // Stock logic removed as per user request.
                // if (!$product || $product->stock < $item['quantity']) {
                //     throw new \Exception('Product ' . $product->name . ' is out of stock or quantity is too high.');
                // }

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'], // Calculate subtotal
                ]);

                // Stock decrement logic removed as per user request.
                // $product->stock -= $item['quantity'];
                // $product->save();

                $totalAmount += $product->price * $item['quantity'];
            }

            $sale->total_amount = $totalAmount;
            $sale->save();

            if ($request->payment_method === 'online') {
                Config::$serverKey = config('midtrans.server_key');
                Config::$isProduction = config('midtrans.is_production');
                Config::$isSanitized = config('midtrans.is_sanitized');
                Config::$is3ds = config('midtrans.is_3ds');

                $transaction_details = [
                    'order_id' => $sale->id,
                    'gross_amount' => $totalAmount,
                ];

                $customer_details = [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ];

                $params = [
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                ];

                $snapToken = Snap::getSnapToken($params);
                $sale->midtrans_snap_token = $snapToken;
                $sale->save();

                DB::commit();
                Log::info('Midtrans Snap Token generated: ' . $snapToken); // Add logging
                return response()->json(['message' => 'Sale processed successfully', 'snap_token' => $snapToken]);
            }

            DB::commit();
            return response()->json(['message' => 'Sale processed successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing sale: ' . $e->getMessage()); // Add logging
            return response()->json(['message' => 'Error processing sale: ' . $e->getMessage()], 500);
        }
    }
}
