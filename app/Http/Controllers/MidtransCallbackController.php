<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        $sale = Sale::where('id', $orderId)->first();

        if ($sale) {
            if ($transaction == 'capture') {
                // For credit card transaction, 1st get the status of the transaction
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set transaction status on your database to 'challenge'
                        $sale->status = 'challenge';
                    } else {
                        // TODO set transaction status on your database to 'success'
                        $sale->status = 'completed';
                    }
                }
            } elseif ($transaction == 'settlement') {
                // TODO set transaction status on your database to 'success'
                $sale->status = 'completed';
            } elseif ($transaction == 'pending') {
                // TODO set transaction status on your database to 'pending' / waiting payment
                $sale->status = 'pending';
            } elseif ($transaction == 'deny') {
                // TODO set transaction status on your database to 'deny'
                $sale->status = 'cancelled';
            } elseif ($transaction == 'expire') {
                // TODO set transaction status on your database to 'expire'
                $sale->status = 'cancelled';
            } elseif ($transaction == 'cancel') {
                // TODO set transaction status on your database to 'cancel'
                $sale->status = 'cancelled';
            }
            $sale->save();
        }

        return response()->json(['message' => 'Callback processed successfully']);
    }
}
