@extends('backend.layouts.app')

@section('content')   <section class="content">
    <div class="container mx-auto px-4 max-w-7xl">
        
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <h3 class="text-2xl font-semibold text-gray-800 pt-5 pl-5">Transaction List</h3>
            <div class="py-4 border-b flex justify-between items-center">
                <!-- Right: Filter + Select -->
                <div class="flex justify-between items-center w-full">
                <!-- Left: Transaction Type Dropdown -->
                    <form action="{{ route('transaction.index') }}" method="get" class="flex items-center space-x-4">
                        @csrf
                        <select name="type" id="type"
                            class="px-4 pr-8 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 bg-green-500 text-white text-sm font-medium">
                            <option value="" disabled selected>Select Transaction Type</option>
                            <option value="all" @if (request()->get('type') == 'all') selected @endif>All</option>
                            <option value="credit" @if (request()->get('type') == 'credit') selected @endif>Income [Credit]</option>
                            <option value="debit" @if (request()->get('type') == 'debit') selected @endif>Expense [Debit]</option>
                        </select>
                    </form>

                    <!-- Right: Date Filter -->
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


            <!-- Success Message -->
            @if (session('success'))
                <div class="relative p-4 mb-4 text-white bg-gradient-to-r from-green-500 to-lime-400 rounded-lg shadow">
                    {{ session('success') }}
                    <button type="button" onclick="this.parentElement.style.display='none';"
                        class="absolute top-2 right-2 text-xl font-bold leading-none focus:outline-none">×</button>
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto px-6 py-4">
                <table id="transactions-table" class="min-w-full table-auto divide-y divide-gray-200 border border-gray-300 text-center">
                    <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                        <tr>
                            <th style="text-align: center;" class="px-4 py-3">Serial</th>
                            <th style="text-align: center;" class="px-4 py-3">Account Name</th>
                            <th style="text-align: center;" class="px-4 py-3">Date</th>
                            <th style="text-align: center;" class="px-4 py-3">Transaction No</th>
                            <th style="text-align: center;" class="px-4 py-3">Narration</th>
                            <th style="text-align: center;" class="px-4 py-3">Credit</th>
                            <th style="text-align: center;" class="px-4 py-3">Debit</th>
                            <th style="text-align: center;" class="px-4 py-3">After Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 text-sm">
                        {{-- DataTables will inject rows here --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#type').on('change', function() {
                table.draw();
            });
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

            var table = $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transaction.ajaxTransactionList') }}",
                    data: function(d) {
                        // Optional: d.type = $('#type').val();
                        d.dateRange = $('#dateRange').val();
                        d.type = $('#type').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'account_name', name: 'account.name', className: 'text-center' },
                    { data: 'created_at', name: 'created_at', className: 'text-center' },
                    { data: 'number', name: 'number', className: 'text-center' },
                    { data: 'description', name: 'description', className: 'text-center' },
                    { data: 'credit', name: 'credit', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'debit', name: 'debit', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'after_balance', name: 'after_balance', className: 'text-center' }
                ],
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'btn bg-blue-600 text-white px-4 py-2 rounded shadow mr-2',
                    filename: function() {
                        return 'transaction-lists-' + new Date().toISOString().slice(0, 10);
                    }
                }]
            });
        });
    </script>
@endsection
