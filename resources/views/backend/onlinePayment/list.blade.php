@extends('backend.layouts.app')
@section('title')
Online Payment
@endsection
@section('content')<div>
    <form action="{{ route('online.payment.list') }}" method="get" class="w-full">
        <div class="flex mb-10 justify-center items-center">
            <div class="space-x-6  w-1/8">
                <label for="email" class=" text-sm font-medium leading-5 text-gray-700 ml-5">Retailer</label>
                <div class="mt-1  rounded-md shadow-sm">
                    <select name="retailer_id" id="retailer_id" class="form-input  w-full py-2" required>
                        <option value=""> -- Select Retailer --</option>
                        @foreach ($retailers as $retailer)
                        <option @if (request()->retailer_id == $retailer->id) selected @endif value="{{ $retailer->id }}">
                            {{ $retailer->first_name }} {{ $retailer->last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-x-6  w-1/8">
                <label for="email" class=" text-sm font-medium leading-5 text-gray-700 ml-5">Month</label>
                <div class="mt-1  rounded-md shadow-sm">
                    <select name="month" id="month" class="form-input  w-full py-2" required>
                        <option value=""> -- Select Month --</option>
                        @foreach ($months as $key => $month)
                        <option @if (request()->month == $key + 1) selected @endif value="{{ $key + 1 }}">
                            {{ $month }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-x-6  w-1/8">
                <label for="email" class=" text-sm font-medium leading-5 text-gray-700 ml-5">Year</label>
                <div class="mt-1  rounded-md shadow-sm">
                    <select name="year" id="year" class="form-input  w-full py-2">
                        <option value=""> -- Select Year --</option>
                        @foreach ($years as $year)
                        <option @if (request()->year == $year || now()->format('Y')==$year) selected @endif value="{{ $year }}">
                            {{ $year }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-1.5">
                <button type="submit" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2 ml-5 mt-5">
                    Search
                </button>
                @if (request()->has('retailer_id'))
                <a href="{{ route('online.payment.list') }}" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                    Reset
                </a>

                <a href="{{route('online.payment.history', request()->retailer_id)}}" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2 ml-5 mt-5">
                    All Payment List
                </a>
                @endif

            </div>
            
        </div>
    </form>
</div>


<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
    @if (request()->query('search'))
    <div class="flex mb-10 items-left">
        <p>You searched for: {{ request()->query('search') }}</p>
    </div>
    @endif
    <div class="border-b border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        #
                    </th>

                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Order No.
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Retailer
                    </th>

                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Amount
                    </th>

                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Status
                    </th>

                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Payment Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                        Date
                    </th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @foreach ($payments as $key => $payment)
                <tr>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $key + 1 }}
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $payment->Order->order_number }}
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $payment->customer->first_name }} {{ $payment->customer->last_name }}
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $payment->amount }} ৳
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $payment->status }}
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $payment->is_paid }}
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-gray-900">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- More people -->
            </tbody>
        </table>
    </div>
</div>
</div>

@if ($payments->count() > 0)
<div class="ml-5 inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
    @if (request()->has('retailer_id') && request()->has('month') && request()->has('year'))
    <form action="{{ route('online.payment.payout') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <label for="date" class="block text-sm leading-5 font-medium text-gray-700">
                Payment Date <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required id="date" name="payment_date" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Date" />
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="retailer_id" name="retailer_id" type="hidden" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Date" value="{{ request()->retailer_id }}" />
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="month" name="month" type="hidden" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Date" value="{{ request()->month }}" />
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="year" name="year" type="hidden" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Date" value="{{ request()->year }}" />
            </div>
            <label for="trx_id" class="block text-sm leading-5 font-medium text-gray-700">
                Transaction ID <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required id="trx_id" name="trx_id" type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Transaction Number" />
            </div>
            <label for="upload_slip" class="block text-sm leading-5 font-medium text-gray-700">
                Upload Slip <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="upload_slip" name="upload_slip" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" />
            </div>
            <label for="total_amount" class="block text-sm leading-5 font-medium text-gray-700">
                Total Amount (৳) <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input readonly id="total_amount" name="total_amount" type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Total Amount In Taka" value="{{ $payments->sum('amount')}}" />
            </div>
            <label for="commission" class="block text-sm leading-5 font-medium text-gray-700">
                Commission (%) <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required onkeyup="updateDiposite()" id="commission" name="commission" type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Commission In Taka" />
            </div>
            <label for="total_deposited" class="block text-sm leading-5 font-medium text-gray-700">
                Total Deposited <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required readonly id="total_deposited" name="total_deposited" type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" value="" />
            </div>

            <label for="remarks" class="block text-sm leading-5 font-medium text-gray-700">
                Remarks
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="remarks" value="{{ old('remarks') }}" name="remarks" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Remarks" />
            </div>

        </div>
        <div class="bg-gray-200 px-4 py-3 text-right">
            <button type="submit" class="py-2 px-4 bg-blue-500 text-red rounded hover:bg-blue-700 mr-2"><i class="fas fa-plus"></i> Payout</button>
        </div>
    </form>
    @endif
</div>
@endif
@endsection

@section('scripts')
<script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden')
    }

    function updateDiposite() {
        
            // Get the input and output elements
            var commission = document.getElementById("commission").value;
            var total_amount = document.getElementById("total_amount").value;
            const inputField = document.getElementById('total_deposited');
            

            var commission_amount=(commission*total_amount)/100;
            
            // Calculate and set the doubled value in the second input
            if (!isNaN(commission_amount)) {
                inputField.value = total_amount-commission_amount;
            } else {
                inputField.value = "";
            }
        }
    


</script>
@endsection