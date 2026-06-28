@extends('backend.layouts.app')
@section('title')
    Order Invoice
@endsection
@section('content')    <div class="flex flex-row justify-between py-3 ml-5">
        <div class="flex-1">
            <p class="text-xl font-bold mt-3 mb-5">Invoice #000{{ $order->id }}</p>
        </div>
        <div class="flex justify-end flex-1 mr-4">
            <button class="px-3 py-1 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                onclick="printDiv('printableArea')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="ltr:mr-2 rtl:ml-2 inline-block bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                    <path
                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                </svg>Print Invoice</button>
        </div>
    </div>
    <div class="flex flex-wrap flex-row">
        <div class="flex-shrink max-w-full px-4 w-full mb-6" id="printableArea">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="flex justify-between items-center pb-4 border-b border-gray-200 dark:border-gray-700 mb-3">
                    <div class="flex flex-col">
                        <div class="text-3xl font-bold mb-1">
                            <img class="inline-block w-12 h-auto ltr:mr-2 rtl:ml-2" src="../src/img/favicon.png">{{ $settings->name }}
                        </div>
                        <p class="text-sm">{{$settings->address}}</p>
                    </div>
                    <div class="text-4xl uppercase font-bold">Invoice</div>
                </div>
                <div class="flex flex-row justify-between py-3">
                    <div class="flex-1">
                        <p><strong>To:</strong><br>
                            Name :
                            {{ $order->receiver_name == null ? $order->customer->first_name . ' ' . $order->customer->last_name : $order->receiver_name }}<br>
                            Address :
                            {{ $order->receiver_address == null ? $order->customer->address : $order->receiver_address }}<br>
                            Phone :
                            {{ $order->receiver_phone == null ? $order->customer->phone : $order->receiver_phone }}<br>
                            Email :
                            {{ $order->receiver_email == null ? $order->customer->email : $order->receiver_email }}<br>
                            Remark : {{ $order->customer->remarks == null ? 'Good' : $order->customer->remarks }}
                        </p>
                    </div>
                    <div class="flex-1">
                        <p><strong>Order Information:</strong><br>
                            Order ID: {{ $order->order_number == null ? 'NO ID' : $order->order_number }} <br>
                            Order Date : {{ $order->created_at->format('m/y/d') }}<br>
                            Payment Method : {{ $order->payment_method }} <br>
                            Payment Status : {{ $order->payment_status }} <br>
                            Order Status : {{ $order->payment_status }} <br>
                        </p>
                    </div>
                </div>
                <div class="py-4">
                    <table class="table-bordered w-full ltr:text-left rtl:text-right text-gray-600">

                        <thead class="border-b dark:border-gray-700">
                            <tr class="bg-gray-100 dark:bg-gray-900 dark:bg-opacity-20">
                                <th class="text-center">Products</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Unit price</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $data)
                                <tr>
                                    <td>
                                        <div class="flex flex-wrap flex-row items-center">
                                            <div class="self-center"><img class="h-8 w-8"
                                                    src="../src/img/products/product1.jpg"></div>
                                            <div class="leading-5 dark:text-gray-300 flex-1 ltr:ml-2 rtl:mr-2 mb-1">
                                                {{ $data->product->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $data->request_quantity }}</td>
                                    <td class="text-center">{{ $data->unit_price }} BDT</td>
                                    <td class="text-center">{{ $data->subtotal }} BDT</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{-- <tr>
                                    <td colspan="2"></td>
                                    <td class="text-center"><b>Sub-Total</b></td>
                                    <td class="text-center">$290</td>
                                </tr> --}}
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-center"><b>Discount</b></td>
                                <td class="text-center">{{ $data->discount == null ? 0 : $data->discount }} BDT</td>
                            </tr>
                            {{-- <tr>
                                    <td colspan="2"></td>
                                    <td class="text-center"><b>Tax</b></td>
                                    <td class="text-center">5%</td>
                                </tr> --}}
                            @php
                                
                                $orderDetails = App\Models\CustomerPurchaseDetail::where('customer_purchase_id', $order->id)
                                    ->get()
                                    ->toArray();
                                $Total = array_sum(array_column($orderDetails, 'subtotal'));
                            @endphp <tr>
                                <td colspan="2"></td>
                                <td class="text-center"><b>Total</b></td>
                                <td class="text-center font-bold">{{ $Total }} BDT</td>
                            </tr>

                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('order.remark', $order->id) }}" method="post" class=" px-6 py-6 rounded-md space-y-7">
        @method('PUT')
        @csrf
        <div class="bg-white py-12 rounded-lg shadow-md">
            <div class="px-10">
                <label for="retailer_id" class="block text-sm leading-5 font-medium text-gray-700">
                    Assaign Retailer<span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <select required name="retailer_id"
                        class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="Default select example">
                        @foreach ($retailer as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-10">
                <label for="order_remarks" class="block text-sm leading-5 font-medium text-gray-700">
                    Order Remarks<span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="order_remarks" name="order_remarks" type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                        placeholder="Enter order remarks" />
                </div>
                @error('name')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-8 pt-5">
                <div class="flex justify-end">
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href=""
                            class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                            Cancel
                        </a>
                    </span>
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Save
                        </button>
                    </span>
                </div>
            </div>
    </form>
    <script>
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
