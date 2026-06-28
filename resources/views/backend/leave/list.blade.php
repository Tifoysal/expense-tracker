@extends('backend.layouts.app')

@section('content')<section class="content">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <!-- Header -->
                    <h6 class="text-xl font-semibold text-gray-800 pl-5 pt-5">Leave Request</h6>
                    <div class="px-6 py-4 border-b flex justify-between items-center">
                        <a href="{{ route('leaves.create') }}"
                            class="bg-green-500 text-white text-sm font-bold uppercase px-6 py-2 rounded hover:bg-green-600 transition duration-200">
                            <i class="fa fa-plus mr-2"></i> Add New
                        </a>
                        <div class="flex items-center space-x-3">
                            <label for="dateRange" class="font-medium text-gray-700 mb-0">Filter by Date</label>
                            <input type="text" id="dateRange"
                                class="border border-gray-300 rounded px-3 py-2 w-56 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Select date range" readonly>
                        </div>
                        
                    </div>

                    <!-- Table Section -->
                    <div class="px-6 py-4">
                        @if (session('success'))
                            <div class="relative p-4 mb-4 text-white bg-gradient-to-r from-green-500 to-lime-400 rounded-lg shadow">
                                {{ session('success') }}
                                <button type="button"
                                    class="absolute top-2 right-2 text-xl font-bold leading-none focus:outline-none">
                                    ×
                                </button>
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table id="leaves-table"
                                class="min-w-full table-auto divide-y divide-gray-200 border border-gray-300 text-center">
                                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                                    <tr>
                                        <th class="px-4 py-3" style="text-align:center">Serial</th>
                                        <th class="px-4 py-3" style="text-align:center">Employee</th>
                                        <th class="px-4 py-3" style="text-align:center">Title</th>
                                        <th class="px-4 py-3" style="text-align:center">Reason</th>
                                        <th class="px-4 py-3" style="text-align:center">Status</th>
                                        <th class="px-4 py-3" style="text-align:center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100 text-sm">
                                    {{-- Data will be loaded dynamically --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



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

            // Initialize DataTable
            var table = $('#leaves-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('leaves.ajaxLeavesList') }}",
                    data: function(d) {
                        d.dateRange = $('#dateRange').val(); // Pass selected range
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'reason',
                        name: 'reason'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'btn bg-blue-500 text-white px-4 py-2 rounded shadow mr-2',
                    filename: function() {
                        return 'leaves-list-' + new Date().toISOString().slice(0, 10);
                    }
                }]
            });
        });
    </script>
@endsection

@endsection
