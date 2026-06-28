@extends('backend.layouts.app')
@section('title')
Payment Information
@endsection
@section('content')
<div>
    <div class="flex justify-center">
        <a href="{{ route('online.payment.export.retailer', ['retailer_id'=>request()->id])}}">
            <button type="button" class="py-2 px-4 bg-green-500 text-white rounded hover:bg-green-700">Download Excel File</button>
        </a>
    </div>
   
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Serial
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Retailer Name (Business Name)
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Transaction ID
                </th>

                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Payment Date
                </th>
                
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Amount
                </th>
                
                <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                    Commision
                </th>

                

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($payments as $data)
            <tr>
                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->id}}
                        </div>
                    </div>
                </td>

                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->retailer->name.' ('.$data->retailer->business_name.')'}}
                        </div>
                    </div>
                </td>

                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->trx_id}}
                        </div>
                    </div>
                </td>

                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->created_at}}
                        </div>
                    </div>
                </td>
                
                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->total_amount}}
                        </div>
                    </div>
                </td>

                <td class="text-sm text-gray-900">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{$data->commision}}
                        </div>
                    </div>
                </td>
                

                {{-- <td class="flex px-8 py-8 space-x-2 text-sm font-medium text-right whitespace-nowrap">
                    <a title="Profile" href="" class="text-indigo-600 hover:text-indigo-900">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                        </svg>
                    </a>
                    <a title="Edit" href="" class="text-indigo-600 hover:text-indigo-900">
                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a title="Delete" href="" onclick="return confirm('Are you sure you want to delete it ?')" class="text-indigo-600 hover:text-indigo-900">
                        <svg class="w-5 h-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </td> --}}
            </tr>
            @endforeach
            <!-- More people... -->
        </tbody>
    </table>
</div>
@endsection