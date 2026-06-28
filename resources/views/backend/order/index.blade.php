@extends('backend.layouts.app')
@section('title')
    Order List
@endsection
@section('content')    <div class="container flex flex-col px-8">
        <!-- Primary -->
        <div class="flex items-center justify-between px-9">

            <div>
                <form action="{{ route('order.index') }}" method="get" class="w-full">
                    <div class="flex items-center justify-center mb-10">
                        <div class="space-x-6 w-1/8">
                            <label for="email" class="ml-5 text-sm font-medium leading-5 text-gray-700 "></label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" name="search" type="text" placeholder="Search"
                                    class="w-full py-2 form-input" value="{{ request()->query('search') }}">
                            </div>
                        </div>
                        <div class="mt-1.5">
                            <button type="submit"
                                class="px-4 py-2 mt-5 ml-5 space-x-6 text-white bg-indigo-600 rounded-md focus:outline-none">
                                submit
                            </button>
                            @if (request()->query('search'))
                                <a href="{{ route('order.index') }}"
                                    class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                                    Reset
                                </a>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
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
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Serial
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Order Number
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Total
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Updated
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Ordered By
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Order Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $key => $order)
                            <tr class="py-8">
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
                                            {{ $order->order_number }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->payable_total }} BDT.
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->updated_at->format('Y-m-d') }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $order->status }}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-sm text-gray-900">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <div class="flex justify-between">
                                                <div>
                                                    <a href="{{ route('order.preview', $order->id) }}"
                                                        class="px-4 mr-2 text-white bg-blue-500 rounded hover:bg-blue-700">Preview</a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('order.update', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="status" id="status">
                                                            <option value="cancelled">Cancel</option>
                                                            <option value="recieved">Recieved</option>
                                                            <option value="dispatched">Dispatched</option>
                                                        </select>
                                                        <button class="px-4 mr-2 text-white bg-green-500 rounded hover:bg-green-700" type="submit">Update</button>
                                                    </form>
                                                </div>
                                            </div>

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
