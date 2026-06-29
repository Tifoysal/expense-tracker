@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Update Account</h2>
                <p class="text-gray-500 mt-3 text-lg">Edit the details of this banking account.</p>
            </div>
            <form action="{{ route('banking.account.update', $account->id) }}" method="post" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                   
                    <div>
                        <label for="name" class="block text-base font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ $account->name }}" placeholder="Name" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" required autofocus>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                   
                   
                    <div>
                        <label for="starting_balance" class="block text-base font-medium text-gray-700">Starting Balance <span class="text-red-500">*</span></label>
                        <input type="number" name="balance" id="starting_balance" value="{{ $account->balance }}" placeholder="0.00" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" required>
                        @error('balance')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
               
                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('banking.account.index') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>




@endsection

@push('scripts')
<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs" defer></script>
@endpush