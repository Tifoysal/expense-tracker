@extends('backend.layouts.app')

@section('content')<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Edit Expense Category</h2>
                <p class="text-gray-500 mt-3 text-lg">Update the details of the expense category.</p>
            </div>

            @if (session('success'))
                <div class="w-full p-4 mb-6 text-white bg-green-600 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('expenses.category.update', $category->id) }}" method="POST" class="space-y-8">
                @method('put')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Parent Category -->
                    <div>
                        <label for="parent_id" class="block text-base font-medium text-gray-700">Parent Category</label>
                        <select id="parent_id" name="parent_id" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                            <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>Select</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                                @foreach ($cat->childrenCategories as $childCategory)
                                    @include('backend.expense.expenses.child_category_edit', [
                                        'child_category' => $childCategory,
                                        'hi_pen' => $hi_pen,
                                    ])
                                @endforeach
                            @endforeach
                        </select>
                        @error('parent_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-base font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600">
                            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category Name -->
                    <div class="md:col-span-2">
                        <label for="category_name" class="block text-base font-medium text-gray-700">Category Name <span class="text-red-500">*</span></label>
                        <input required type="text" name="category_name" id="category_name" placeholder="Service Category Name" value="{{ old('category_name', $category->name) }}" class="mt-2 block w-full rounded-lg border border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-400 bg-gray-50 text-base py-2 px-4 focus:outline-indigo-600" />
                        @error('category_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-10">
                    <a href="{{ route('expenses.category.list') }}" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-sm">Cancel</a>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow text-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
