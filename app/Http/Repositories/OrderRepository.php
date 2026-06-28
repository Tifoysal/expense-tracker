<?php

namespace App\Http\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Support\Carbon;

class OrderRepository
{
    public function order($order)
    {
        $uniqueId = uniqid();
        $dateTime = Carbon::now()->format('Ymdhisis');
        $order_number = "Bosssend_{$dateTime}";
        $orderPlaced = Order::create([
            'order_number'=>$order_number,
            'user_id'=>auth()->user()->id,
            'user_phone'=>$order['user_phone'],
            'user_email'=>$order['user_email'],
            'tran_id'=>$order['tran_id'],
            'payment_status'=>$order['payment_status'],
            'payment_method'=>$order['payment_method'],
            'payable_total'=>$order['payable_total'],
            'reciever_name'=>$order['reciever_name'],
            'reciever_phone'=>$order['reciever_phone'],
            'delivery_charge'=>$order['delivery_charge'],
            'discounted_price'=>$order['discounted_price'],
            'coupon_code'=>$order['coupon_code'],
            'status'=>$order['status'],
        ]);
        foreach (session()->get('cart') as $key => $cartData) {
            OrderDetails::create([
                'order_id' => $orderPlaced->id,
                'product_id' => $cartData['product_id'],
                'quantity' => $cartData['product_qty'],
                'unit_price' => $cartData['product_price'],
                'subtotal' => $cartData['subtotal'],
            ]);
            $product = Product::query()->find($key);
            $product->decrement('quantity', $cartData['product_qty']);
        }
        session()->forget('cart');
    }
}
?>
