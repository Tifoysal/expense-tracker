@extends('backend.layouts.app')
@section('title')
Accounts
@endsection
@section('content')<div class="container flex flex-col px-8">
    <!-- Primary -->
    <form method="GET" action="{{ route('bill.list') }}" class="flex gap-4 items-end">
        {{-- Employee Select --}}
        <div>
            <label for="id" class="block text-sm font-medium text-gray-700">Select Employee</label>
            <select name="id" id="id" class="form-control block w-full py-2">
                <option value="">-- Select Employee --</option>
                @foreach ($employees as $emp)
                <option value="{{ $emp->id }}" {{ request('id') == $emp->id ? 'selected' : '' }}>
                    {{ $emp->name }} ({{ $emp->phone }})
                </option>
                @endforeach
            </select>
        </div>

        {{-- Month Select --}}
        <div>
            <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
            <select name="month" id="month" class="form-control block w-full py-2">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                    @endfor
            </select>
        </div>

        {{-- Year Select --}}
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
            <select name="year" id="year" class="form-control block w-full py-2">
                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
                @endfor
            </select>
        </div>
        {{-- Status Select --}}
<div>
    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
    <select name="status" id="status" class="form-control block w-full py-2">
        <option value="">All</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="disbursed" {{ request('status') == 'disbursed' ? 'selected' : '' }}>Disbursed</option>
        <option value="received" {{ request('status') == 'received' ? 'selected' : '' }}>Received</option>
    </select>
</div>
        {{-- Submit Button --}}
        <div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded">
                Filter
            </button>
        </div>
    </form>

</div>
<div class="flex items-center justify-center">
    <div class="p-4 rounded w-full">
        <div class="md:grid md:grid-cols-3 md:gap-4 lg:grid-cols-3 space-y-4 md:space-y-0 mt-4 lg:gap-8">
            <a href="#">
                <div class="shadow-md bg-white rounded-lg h-36">
                    <div class="flex items-center justify-between  p-8">

                        <div class="space-y-4">
                            <p class="text-gray-500 text-xl font-semibold">Total {{ucfirst(request('status')??'Amount')}}</p>
                            <div class="flex items-baseline space-x-4">
                                <h2 class="text-2xl font-semibold">
                                    {{$totalPaid}} ৳
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 bg-purple-600 text-white rounded-full">

                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-7 h-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>

                        </div>
                    </div>

                </div>
            </a>
            <a href="">
                <div class="shadow-md bg-white rounded-lg h-36">
                    <div class="flex items-center justify-between  p-8">
                        <div class="space-y-4">
                            <p class="text-gray-500 text-xl font-semibold">Total Due</p>
                            <div class="flex items-baseline space-x-4">
                                <h2 class="text-2xl font-semibold">
                                    {{$totalDue}} ৳
                                </h2>

                            </div>
                        </div>
                        <div class="p-4 bg-green-600 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-7 h-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>

                        </div>
                    </div>

                </div>
            </a>
            <a href="">
                <div class="shadow-md bg-white rounded-lg h-36">
                    <div class="flex items-center justify-between  p-6">

                        <div class="space-y-4">
                            <p class="text-gray-500 text-xl font-semibold">Total Sale </p>
                            <div class="flex items-baseline space-x-4">
                                <h2 class="text-2xl font-semibold">
                                    {{$totalPurchase}} ৳
                                </h2>

                            </div>
                        </div>
                        <div class="p-4 bg-yellow-600 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-7 h-7" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                        </div>
                    </div>

                </div>
            </a>
        </div>
    </div>


</div>


<div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
    {{-- @if (request()->query('search'))
    <div class="flex mb-10 items-left">
        <p>You searched for: {{ request()->query('search') }}</p>
</div>
@endif --}}


<div class="border-b border-gray-200 shadow sm:rounded-lg">


    <div class="text-3xl uppercase font-bold text-center ">Payment List</div>

    @if(request()->id)
    <a href="{{ route('bill.export', [
    'employee_id' => request('id'),
    'month' => request('month'),
    'year' => request('year')
])}}">
        <button type="button" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700">Download Excel File</button>
    </a>
    @endif

    <br>

    <table class="min-w-full divide-y divide-gray-200 mt-1.5">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Serial
                </th>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Bill Date
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Order ID
                </th>


                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Payment Type
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Amount
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Reference
                </th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

            @foreach ($bills as $key => $bill)
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
                            {{ date('Y-M-d',strtotime($bill->collection_date)) }}
                        </div>
                    </div>
                </td>
                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $bill->order_id }}
                        </div>
                    </div>
                </td>

                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $bill->payment_type }}
                            @if($bill->status=='pending')
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-black bg-yellow-300 rounded-full">
                                Pending
                            </span>
                            @elseif($bill->status=='disbursed')
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-black bg-blue-300 rounded-full">
                                Disbursed
                            </span>
                            @elseif($bill->status=='received')
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-black bg-green-300 rounded-full">
                                Received
                            </span>
                            @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-black bg-red-300 rounded-full">
                                Cancelled
                            </span>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $bill->amount }} ৳
                        </div>
                    </div>
                </td>
                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            <a href="{{route('bill.view',$bill->id)}}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-200">
                                View
                            </a>
                            <a href="{{route('bill.edit',$bill->id)}}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-200">
                                Edit
                            </a>
                        </div>
                    </div>
                </td>



            </tr>
            @endforeach




            <!-- More people... -->
        </tbody>
    </table>
</div>
</div>
</div>



@endsection

@section('scripts')
<script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden')
    }
</script>
@endsection