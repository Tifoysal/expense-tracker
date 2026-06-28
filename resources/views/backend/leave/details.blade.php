@extends('backend.layouts.app')

@section('content')   <section class="py-6">
    <div class="container mx-auto px-4">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-table"></i>
                    Leave Details
                </h2>
            </div>
            <div class="p-6 overflow-x-auto">
                <form action="{{ route('leaves.employee.update', $leaveDetails->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="leave_type_id" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->leave_type_id }}">

                    <table class="min-w-full text-left border border-gray-200">
                        <thead class="bg-gray-50 text-gray-700 font-medium">
                            <tr>
                                <th class="px-4 py-2 border">Employee Name</th>
                                <th class="px-4 py-2 border">Title</th>
                                <th class="px-4 py-2 border">Reason</th>
                            </tr>
                        </thead>
                        <tbody class="text-blue-700">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <input readonly type="text" name="employee_name" class="w-full bg-gray-100 rounded px-2 py-1" value="{{ $leaveDetails->employee->name }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="leave_title" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->title }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="leave_reason" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->reason }}">
                                </td>
                            </tr>
                        </tbody>

                        <thead class="bg-gray-50 text-gray-700 font-medium">
                            <tr>
                                <th class="px-4 py-2 border">Duration</th>
                                <th class="px-4 py-2 border">From</th>
                                <th class="px-4 py-2 border">To</th>
                            </tr>
                        </thead>
                        <tbody class="text-blue-700">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <input type="number" name="leave_duration" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->duration }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="date" name="from" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->from }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="date" name="to" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->to }}">
                                </td>
                            </tr>
                        </tbody>

                        <thead class="bg-gray-50 text-gray-700 font-medium">
                            <tr>
                                <th class="px-4 py-2 border">Location</th>
                                <th class="px-4 py-2 border">Emergency Contact</th>
                                <th class="px-4 py-2 border">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="text-blue-700">
                            <tr>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="location" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->location }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input readonly type="text" name="emergency_contact" class="w-full bg-gray-100 rounded px-2 py-1" value="{{ $leaveDetails->emergency_contact }}">
                                </td>
                                <td class="px-4 py-2 border">
                                    <input type="text" name="remarks" class="w-full border rounded px-2 py-1" value="{{ $leaveDetails->remarks }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- @if($leaveDetails->status === 'pending')
                        <div class="pt-4">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update</button>
                        </div>
                    @endif --}}
                </form>

                <div class="mt-6 text-center space-x-3">

                    
                    @if($leaveDetails->status === 'pending')
                        @permission('leave.approve')
                        <a href="{{ route('leave.approve', [$leaveDetails->id, 'approved']) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Approve</a>
                        <a href="{{ route('leave.reject', [$leaveDetails->id, 'rejected']) }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Reject</a>
                        <a href="{{ route('leaves.list') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
                        @endpermission
                    @elseif($leaveDetails->status === 'approved')
                        <span class="px-4 py-2 bg-green-200 text-green-800 rounded">Approved</span>
                        <a href="{{ route('leaves.list') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
                    @elseif($leaveDetails->status === 'rejected')
                        <span class="px-4 py-2 bg-red-200 text-red-800 rounded">Rejected</span>
                        <a href="{{ route('leaves.list') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
