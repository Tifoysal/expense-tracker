@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Edit Leave Type</h2>
                <p class="text-gray-500 mt-3 text-lg">Update the details for this leave type.</p>
            </div>

            @if(session('success'))
                <div class="w-full p-4 mb-6 text-white bg-green-600 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('leaveTypes.update', $editLeaveTypes->id) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter name"
                            value="{{ old('name', $editLeaveTypes->name) }}"
                            required
                            class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm bg-gray-50 py-2 px-4 text-base focus:outline-indigo-600 focus:ring-indigo-500 focus:border-indigo-400"
                        >
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="number_of_days" class="block text-base font-medium text-gray-700">Number of Days <span class="text-red-500">*</span></label>
                        <input
                            type="number"
                            id="number_of_days"
                            name="number_of_days"
                            placeholder="Enter number of days"
                            value="{{ old('number_of_days', $editLeaveTypes->number_of_days) }}"
                            required
                            class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm bg-gray-50 py-2 px-4 text-base focus:outline-indigo-600 focus:ring-indigo-500 focus:border-indigo-400"
                        >
                        @error('number_of_days')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('leaveTypes.index') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
