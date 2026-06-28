<?php

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ReviewRating;
use App\Models\BankingAccount;
use Dflydev\DotAccessData\Data;
use App\Models\CampaignCustomer;
use App\Models\ProductVariation;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\DatabaseNotification;

if (!function_exists('isEmail')) {
    function isEmail($email)
    {
        $find1 = strpos($email, '@');

        $find2 = strpos($email, '.');

        return ($find1 !== false && $find2 !== false);
    }
}

if (!function_exists('getAllTeamMemberIds')) {

    function getAllTeamMemberIds($employeeId)
    {
        $ids = User::where('executive_id', $employeeId)
            ->pluck('id')
            ->toArray();

        $allIds = $ids;

        foreach ($ids as $id) {
            $allIds = array_merge($allIds, getAllTeamMemberIds($id));
        }

        return $allIds;
    }
}


if (!function_exists('hasAnyPermissions')) {

    function hasAnyPermissions($permission)
    {
        if (auth()->user()->role_id == 1) {
            return true;
        }
        $guard = getCurrentGuard();
        return auth($guard)->user()->hasPermission($permission);
    }
}

if (!function_exists('cart')) {

    function cart()
    {
        if (session()->get('cart')) {
            $cart = session()->get('cart');
            $cart = count($cart);
            return $cart;
        }
        return 0;
    }
}


if (!function_exists('isRouteActive')) {
    function isRouteActive($patterns): string
    {
        if (Route::is($patterns)) {
            return 'bg-gray-200 active';
        }

        return '';
    }
}


if (!function_exists('getPrice')) {
    function getPrice($data): float
    {

        //   if(!auth('api')->check() || in_array(auth('api')->user()->type,['customer','employee']))
        //   {
        //    return $data->price; 
        //   }

        //   $price=auth('api')->user()->type.'_price';
        //  return $data->$price; 


        dd($data->sale_price);
    }
}


if (!function_exists('getReview')) {
    function getReview($orderId, $productId)
    {

        $reviewRatings = ReviewRating::where('order_id', $orderId)->where('product_id', $productId)->first();
        return $reviewRatings;
    }
}


if (!function_exists('getAllRoutesInArray')) {
    function getAllRoutesInArray(): array
    {
        $data = [];
        foreach (Route::getRoutes() as $key => $route) {
            if ($route->getName() && $route->getPrefix() != '' && $route->getPrefix() != '_ignition') {
                $data[$key] = [
                    'name' => $route->getName(),
                    'prefix' => $route->getPrefix(),
                ];
            }
        }
        $arr = array();
        foreach ($data as $key => $item) {
            $arr[$item['prefix']][$key] = $item;
        }
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }
}

if (!function_exists('getCurrentGuard')) {
    function getCurrentGuard()
    {
        $guards = array_keys(config('auth.guards'));
        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
    }
}

if (!function_exists('getProductRating')) {
    function getProductRating($product_id) {}
}


if (!function_exists('getTopParent')) {
    function getTopParent($category)
    {
        if ($category->parent_id === null) {
            return $category->name;
        }

        return getTopParent(Category::find($category->parent_id));
    }
}

if (!function_exists('checkCampaignJoined')) {
    function checkCampaignJoined($campaignId, $customerId)
    {
        $check = CampaignCustomer::where('campaign_id', $campaignId)->where('customer_id', $customerId)->first();
        if ($check) {
            return true;
        }
        return false;
    }
}

if (!function_exists('getDiscountedPriceFromRule')) {
    /*
     * @param $regularPrice
     * @param $discount
     * @return float|int
     */
    function getDiscountedPriceFromRule($type, $price, $product_discount, $qty): array
    {


        if ($type == 'percentage') {
            $discount['amount'] = ((float)($price * $product_discount / 100)) * $qty;
            $discount['percentage'] = $product_discount . "%";
            return $discount;
        } else {
            $discount['amount'] = $product_discount * $qty;
            // $discount['percentage'] = "৳" . $amount;
            $discount['percentage'] = round($product_discount * 100 / $price, 1) . "%";
            return $discount;
        }
    }
}


if (!function_exists('formatName')) {
    function formatName($name)
    {
        return ucwords(strtolower($name));
    }
}
if (!function_exists('transNumber')) {
    function transNumber()
    {

        $prefix = 'TRX'; // Prefix for transaction numbers
        $timestamp = now()->format('YmdHis'); // Current timestamp
        $random = Str::random(6); // Random characters

        // Concatenate the parts to form the transaction number
        $transactionNumber = $prefix . '-' . $timestamp . '-' . $random;

        return $transactionNumber;
    }
}

if (!function_exists('accountDebit')) {
    function accountDebit($account_id, $amount, $description, $reference, $payment_method, $attachment)
    {

        DB::transaction(function () use ($account_id, $amount, $description, $reference, $payment_method, $attachment) {
            // Update the account balance
            // dd($payment_method);
            $account = BankingAccount::findOrFail($account_id);
            $account->decrement('balance', $amount);

            Transaction::create([
                'type' => Transaction::DEBIT,
                'number' => transNumber(),
                'account_id' => $account_id,
                'amount' => (float)$amount,
                'after_balance' => (float)$account->balance,
                'currency_code' => 'BDT',
                'description' => $description,
                'reference' => $reference,
                'payment_method' => $payment_method,
                'created_by' => auth()->user()->id,
                'attachment' => $attachment,
            ]);
        });

        return true;
    }
}

if (!function_exists('accountCredit')) {
    function accountCredit($account_id, $amount, $description, $reference, $payment_method, $attachment)
    {

        DB::transaction(function () use ($account_id, $amount, $description, $reference, $payment_method, $attachment) {
            // Update the account balance

            $account =  BankingAccount::findOrFail($account_id);
            $account->increment('balance', $amount);

            Transaction::create([
                'type' => Transaction::CREDIT,
                'number' => transNumber(),
                'account_id' => $account_id,
                'amount' => (float)$amount,
                'after_balance' => (float)$account->balance,
                'currency_code' => 'BDT',
                'description' => $description,
                'reference' => $reference,
                'payment_method' => $payment_method,
                'created_by' => auth()->user()->id,
                'attachment' => $attachment,
            ]);
        });

        return true;
    }
}


// UPDATED stock_in() HELPER

if (!function_exists('stock_in')) {

    function stock_in($data)
    {
        $product_variation_id = $data['product_variation_id'];

        $qty = $data['quantity'];

        $product = ProductVariation::findOrFail($product_variation_id);

        $beforeQty = $product->stock;

        $afterQty = $beforeQty;

        /*
        |--------------------------------------------------------------------------
        | ONLY AVAILABLE STOCK WILL INCREASE MAIN STOCK
        |--------------------------------------------------------------------------
        */

        if (
            ($data['stock_status'] ?? 'AVAILABLE') == 'AVAILABLE'
        ) {

            $afterQty = $beforeQty + $qty;

            $product->increment('stock', $qty);
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE STOCK TRANSACTION
        |--------------------------------------------------------------------------
        */

        StockTransaction::create([

            "warehouse_id"         => $data['warehouse_id'] ?? 1,

            "product_variation_id" => $product_variation_id,

            "batch_no"             => $data['batch_no'] ?? null,

            "expiry_date"          => $data['expiry_date'] ?? null,

            "quantity"             => $qty,

            "unit_price"           => $data['unit_price'] ?? 0,

            "transaction_type"     => $data['transaction_type'] ?? 'PURCHASE_IN',

            "movement"             => "IN",

            "stock_status"         => $data['stock_status'] ?? 'AVAILABLE',

            "quantity_before"      => $beforeQty,

            "quantity_after"       => $afterQty,

            "reference_type"       => $data['reference_type'] ?? null,

            "reference_id"         => $data['reference_id'] ?? null,

            "transaction_date"     => now(),

            "created_by"           => auth()->id(),

        ]);
    }
}


if (!function_exists('stock_out')) {

    function stock_out($data)
    {
        $product_variation_id = $data['product_variation_id'];
        $qty = $data['quantity'];

        $product = ProductVariation::find($product_variation_id);

        if (!$product || $product->stock < $qty) {
            throw new \Exception("Insufficient stock for product ID: " . $product_variation_id);
        }

        // 1. Create transaction
        StockTransaction::create([
            "warehouse_id"         => $data['warehouse_id'] ?? 1,
            "product_variation_id" => $product_variation_id,
            "quantity"             => $qty,
            "unit_price"           => $data['unit_price'] ?? 0,
            "transaction_type"     => "OUT",
            "reference_type"       => $data['reference_type'] ?? null,
            "reference_id"         => $data['reference_id'] ?? null,
            "transaction_date"     => now(),
        ]);

        // 2. Decrement main stock
        ProductVariation::where('id', $product_variation_id)
            ->decrement('stock', $qty);
    }
}


