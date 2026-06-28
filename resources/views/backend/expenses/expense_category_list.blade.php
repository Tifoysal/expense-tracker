@extends('backend.layouts.app')

@section('content')<section class="content">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-12/12">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg">
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between items-center">
                            <h6 class="text-xl font-bold text-gray-800">Expense Category List</h6>
                            <a href="{{ route('expenses.category.create') }}"
                                class="bg-green-500 text-white text-sm font-bold uppercase px-6 py-2 rounded hover:bg-green-600 transition duration-200">
                                <i class="fa fa-plus mt-1 mr-2"></i>
                                Create New Category
                            </a>
                        </div>
                    </div>

                    <div class="flex-auto px-4 pb-4">
                        @if (session('success'))
                            <div class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-green-600 to-lime-400 border-lime-300">
                                {{ session('success') }}
                                <button type="button"
                                    class="box-content absolute top-0 right-0 p-4 text-white bg-transparent border-0 rounded w-4 h-4 text-sm z-2">
                                    <span aria-hidden="true" class="text-center cursor-pointer">✕</span>
                                </button>
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <div class="align-middle inline-block min-w-full">
                                <div class="overflow-hidden sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Serial</th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                                                <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Parent Name
                        </th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($categories as $key => $category)
                                                <tr>
                                                    <td class="text-left px-6 py-4">{{ $key + 1 }}</td>
                                                    <td class="text-left px-6 py-4">{{ $category->name }}</td>
                                                    <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{optional($category->parent)->name}}
                                </div>
                            </div>
                        </td>
                                                    <td class="text-center px-6 py-4">
                                                        @if ($category->status == 1)
                                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-full">Active</span>
                                                        @else
                                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-gray-500 rounded-full">Draft</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center px-6 py-4">
                                                        <div class="flex justify-center space-x-3">
                                                            <a href="{{ route('expenses.category.edit', $category->id) }}" title="Edit">
                                                                <svg class="w-5 h-5 text-blue-600 hover:text-blue-800" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('expenses.category.delete', $category->id) }}" title="Delete">
                                                                <svg class="w-5 h-5 text-red-600 hover:text-red-800" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div> {{-- flex-auto --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
