<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    public function profitLossReport(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();

        $orderDetails = OrderDetails::with(['order.customer', 'order.user', 'product', 'variation'])
            ->whereHas('order', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        return view('backend.reports.profit_loss', compact('orderDetails', 'month'));
    }

    public function yearlySummaryIndex()
    {

        $fromYear = date('Y') - 1;
        $toYear = date('Y');
        $employees = User::whereHas('role', function ($query) {
            $query->where('slug', 'employee');
        })->orderBy('id', 'DESC')->get();

        return view('backend.reports.yearly_summary', compact('fromYear', 'toYear', 'employees'));
    }


    public function yearlySummary(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:users,id',
            // 'from_year'   => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            // 'to_year'     => [
            //     'required',
            //     'integer',
            //     'min:2000',
            //     'max:' . (date('Y') + 1),
            //     function ($attribute, $value, $fail) use ($request) {
            //         if ((int) $request->from_year !== ((int) $value - 1)) {
            //             $fail('The from year must be exactly one year less than to year.');
            //         }
            //     }
            // ],

            'from_date' => 'required|date|before_or_equal:today',
            'to_date'   => [
                'required',
                'date',
                'before_or_equal:today',
                'after_or_equal:from_date', // From Date এর আগের তারিখ হওয়া যাবে না
            ],

        ]);

        if ($validator->fails()) {
            return redirect()->route('reports.yearly.summary.index')->withErrors($validator->getMessageBag());
        }

        $employees = User::whereHas('role', function ($query) {
            $query->where('slug', 'employee');
        })->orderBy('id', 'DESC')->get();

        // ১. ডেটগুলোকে কার্বন অবজেক্টে রূপান্তর এবং সময় ঠিক করা
        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate = Carbon::parse($request->to_date)->endOfDay();

        // ২. কুয়েরি রান করা
        $orders = Order::with(['customer'])
            ->where('created_by', $request->employee_id)
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->latest() // নতুন অর্ডারগুলো আগে দেখানোর জন্য
            ->get();

        // Aggregate data
        $summaryData = $orders->groupBy('customer_id')->map(function ($groupedOrders) {
            $customer = $groupedOrders->first()->customer;
            $tpAmount = $groupedOrders->sum('total_amount');
            $commission = $groupedOrders->sum('commission_amount');
            $netAmount = $tpAmount - $commission;
            $due = $groupedOrders->sum('due');

            return (object) [
                'mobile' => $customer->phone ?? 'N/A',
                'customer_name' => $customer->name ?? 'N/A',
                'customer_id' => $customer->id ?? 'N/A',
                'business_name' => $customer->business_name ?? '',
                'address' => $customer->address ?? '',
                'tp_amount' => $tpAmount,
                'commission' => $commission,
                'net_amount' => $netAmount,
                'due_amount' => $due,
            ];
        })->values();

        $selectedMO = User::find($request->employee_id);
        $fromYear = $request->from_year;
        $toYear = $request->to_year;

        return view('backend.reports.yearly_summary', compact(
            'employees',
            'summaryData',
            'selectedMO',
            'fromYear',
            'toYear',
            'fromDate',
            'toDate'
        ));
    }

    public function customerInvoices(Request $request)
    {
        // ১. ভ্যালিডেশন (নিরাপত্তার জন্য ভালো)
        $request->validate([
            'customer_id' => 'required',
            'from_date'   => 'required|date',
            'to_date'     => 'required|date',
        ]);
    
        $customerId = $request->customer_id;
    
        // ২. ডেট ফরম্যাটিং (Timezone এবং পূর্ণ দিন কাভার করার জন্য)
        // startOfDay দিলে রাত ১২:০০:০০ থেকে শুরু হবে
        // endOfDay দিলে রাত ১১:৫৯:৫৯ পর্যন্ত ডেটা ধরবে
        $fromDate = Carbon::parse($request->from_date)->startOfDay();
        $toDate   = Carbon::parse($request->to_date)->endOfDay();
    
        // ৩. কাস্টমারের তথ্য খুঁজে বের করা
        $customer = Customer::findOrFail($customerId);
    
        // ৪. অর্ডার কুয়েরি (Latest গুলা আগে দেখানোর জন্য latest() যোগ করা হয়েছে)
        $orders = Order::where('customer_id', $customerId)
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->latest() 
            ->get();
    
        // ৫. ভিউতে ডাটা পাঠানো
        // খেয়াল করুন: আপনার ব্লেড ফাইলে ভেরিয়েবল নাম $invoices নাকি $orders সেটা নিশ্চিত হয়ে নিন। 
        // আমি এখানে $orders পাঠিয়েছি যেহেতু মডেলটি Order।
        return view('backend.reports.customer_invoices_detail', [
            'customer'  => $customer,
            'orders'    => $orders,
            'fromDate'  => $request->from_date, // ইউজার যা ইনপুট দিয়েছে তাই ব্যাক পাঠানো
            'toDate'    => $request->to_date
        ]);
    }
}
