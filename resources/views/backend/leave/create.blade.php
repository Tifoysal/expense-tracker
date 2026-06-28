@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">Apply For Leave</h2>
                <p class="text-gray-500 mt-3 text-lg">Submit your leave request below.</p>
            </div>

            <form action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Leave Type -->
                    <div>
                        <label for="leave_type_id" class="block text-base font-medium text-gray-700">Leave Type <span class="text-red-500">*</span></label>
                        <select name="leave_type_id" id="leave_type_id" required class="mt-2 block w-full rounded-lg border border-gray-200 bg-white shadow-sm focus:ring-indigo-500 focus:border-indigo-400 text-base py-2 px-4">
                            @foreach($leaveTypes as $leaveType)
                                @php
                                    $used = $approvedLeaves[$leaveType->id] ?? 0;
                                    $remaining = $leaveType->number_of_days - $used;
                                @endphp
                                <option value="{{ $leaveType->id }}">
                                    {{ $leaveType->name }} - Total: {{ $leaveType->number_of_days }} days - Left: {{ $remaining }} days
                                </option>
                            @endforeach
                        </select>
                        @error('leave_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-base font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Title" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Reason -->
                    <div>
                        <label for="reason" class="block text-base font-medium text-gray-700">Reason <span class="text-red-500">*</span></label>
                        <input type="text" name="reason" id="reason" value="{{ old('reason') }}" placeholder="Enter Reason" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('reason') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-base font-medium text-gray-700">Duration <span class="text-red-500">*</span></label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration') }}" placeholder="Enter Number of Days" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Emergency Contact -->
                    <div>
                        <label for="emergency_contact" class="block text-base font-medium text-gray-700">Emergency Contact <span class="text-red-500">*</span></label>
                        <input type="number" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact') }}" placeholder="Enter Emergency Number" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('emergency_contact') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-base font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Enter Location" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- From Date -->
                    <div>
                        <label for="from" class="block text-base font-medium text-gray-700">From <span class="text-red-500">*</span></label>
                        <input type="date" name="from" id="from" value="{{ date('Y-m-d') }}" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('from') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- To Date -->
                    <div>
                        <label for="to" class="block text-base font-medium text-gray-700">To <span class="text-red-500">*</span></label>
                        <input type="date" name="to" id="to" value="{{ date('Y-m-d') }}" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('to') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-base font-medium text-gray-700">Remarks <span class="text-red-500">*</span></label>
                        <input type="text" name="remarks" id="remarks" value="{{ old('remarks') }}" placeholder="Write any remarks" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4">
                        @error('remarks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('leaves.list') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
