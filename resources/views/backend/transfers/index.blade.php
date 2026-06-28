@extends('backend.layouts.app')

@section('content')<section class="content">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center space-x- pt-5 pl-5">
                        <h6 class="text-xl font-semibold text-gray-800">Transfers</h6>
                    </div>
                    <div class="px-6 py-4 border-b flex justify-between items-center">
                        <a href="{{ route('transfer.create') }}"
                            class="bg-green-500 text-white text-sm font-bold uppercase px-6 py-2 rounded hover:bg-green-600 transition duration-200">
                            <i class="fa fa-plus mr-2"></i> New Transfer
                        </a>

                            <!-- Right: Filter and Create Button -->
                            <div class="flex items-center space-x-4">
                                <!-- Filter by Date -->
                                <div class="flex items-center space-x-2">
                                    <label for="dateRange" class="font-medium text-gray-700 mb-0">Filter by Date</label>

                                    <div class="relative">
                                        <input type="text" id="dateRange"
                                            class="border border-gray-300 rounded pr-10 pl-3 py-2 w-56 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            placeholder="Select date range" readonly>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fa fa-calendar text-gray-500 text-sm"></i>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        <div class="px-6 py-4">
                            {{-- Success message --}}
                            @if (session('success'))
                                <div
                                    class="relative p-4 mb-4 text-white bg-gradient-to-r from-green-500 to-lime-400 rounded-lg shadow">
                                    {{ session('success') }}
                                    <button type="button"
                                        class="absolute top-2 right-2 text-xl font-bold leading-none focus:outline-none">
                                        ×
                                    </button>
                                </div>
                            @endif

                            <div class="overflow-x-auto">
                                <table id="transfers-table"
                                    class="min-w-full table-auto divide-y divide-gray-200 border border-gray-300 text-center">
                                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                                        <tr>
                                            <th style="text-align: center;" class="px-4 py-3">Serial</th>
                                            <th style="text-align: center;" class="px-4 py-3">Created At</th>
                                            <th style="text-align: center;" class="px-4 py-3">Reference</th>
                                            <th style="text-align: center;" class="px-4 py-3">From Account</th>
                                            <th style="text-align: center;" class="px-4 py-3">To Account</th>
                                            <th style="text-align: center;" class="px-4 py-3">From Amount</th>
                                            <th style="text-align: center;" class="px-4 py-3">To Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                                        {{-- DataTables will populate here --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // On apply, update input and reload table
            $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
                table.draw();
            });
            // On cancel, clear input and reload table
            $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                table.draw();
            });
            // DataTable Setup
            var table = $('#transfers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transfer.ajaxBankTransferList') }}",
                    data: function(d) {
                        d.dateRange = $('#dateRange').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'reference',
                        name: 'reference'
                    },
                    {
                        data: 'from_account_name',
                        name: 'from_account.name'
                    },
                    {
                        data: 'to_account_name',
                        name: 'to_account.name'
                    },
                    {
                        data: 'from_amount',
                        name: 'from_amount'
                    },
                    {
                        data: 'to_amount',
                        name: 'to_amount'
                    }
                ],
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600',
                    filename: function() {
                        return 'transfers-list-' + new Date().toISOString().slice(0, 10);
                    }
                }],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('hover:bg-gray-50');
                }
            });
        });
    </script>
@endsection
