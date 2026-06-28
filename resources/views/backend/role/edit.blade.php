@extends('backend.layouts.app')

@section('title')
    Role Edit
@endsection

@section('content')
<form action="{{ route('role.update', $role->id) }}" method="POST"
    class="px-6 py-6 rounded-md space-y-7" enctype="multipart/form-data">

    @csrf

    <div class="bg-white py-12 rounded-lg shadow-md">

        {{-- Role Name --}}
        <div class="px-10">

            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name <span class="text-red-600">*</span>
            </label>

            <div class="mt-1 relative rounded-md shadow-sm">

                <input
                    required
                    id="name"
                    value="{{ $role->name }}"
                    name="name"
                    type="text"
                    class="form-control block w-full px-3 py-2 text-base text-gray-700 bg-white border border-gray-300 rounded focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter role name"
                />

            </div>

            @error('name')
                <span class="text-red-600">{{ $message }}</span>
            @enderror

        </div>

        {{-- Permission Title --}}
        <h3 class="text-center text-2xl font-bold py-8">
            Permissions List
        </h3>

        {{-- Select All --}}
        <div class="ml-11">

            <label class="flex items-center cursor-pointer">

                <input
                    type="checkbox"
                    id="select-all"
                    onchange="checkAll(this)"
                    class="w-5 h-5"
                >

                <span class="ml-3 text-lg font-semibold">
                    Select All / Unselect All
                </span>

            </label>

        </div>

        {{-- Modules --}}
        <div class="mt-8 px-10">

            @foreach($modules as $module)

                <div class="mb-10 border rounded-xl p-5 bg-gray-50">

                    {{-- Module Header --}}
                    <div class="flex items-center border-b pb-3 mb-4">

                        <input
                            type="checkbox"
                            class="module-checkbox w-5 h-5"
                            id="module-{{ $module->id }}"
                            onchange="toggleModulePermissions({{ $module->id }}, this)"
                        >

                        <h4 class="ml-3 text-lg font-bold text-gray-700">
                            {{ ucwords($module->name) }}
                        </h4>

                    </div>

                    {{-- Permissions --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        @foreach($module->permissions as $permission)

                            <label
                                class="flex items-center bg-white px-4 py-3 rounded-lg shadow-sm hover:bg-indigo-50 transition cursor-pointer">

                                <input
                                    type="checkbox"
                                    class="permission-checkbox module-{{ $module->id }}"
                                    name="permission_ids[]"
                                    value="{{ $permission->id }}"
                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}
                                >

                                <span class="ml-3 text-sm font-medium text-gray-700">
                                    {{ ucwords(str_replace('.', ' ', $permission->name)) }}
                                </span>

                            </label>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        {{-- Buttons --}}
        <div class="mt-8 border-t border-gray-200 pt-6 px-10">

            <div class="flex justify-end gap-3">

                <a href="{{ route('role.list') }}"
                    class="py-2 px-5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100">

                    Cancel

                </a>

                <button type="submit"
                    class="py-2 px-6 rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">

                    Save

                </button>

            </div>

        </div>

    </div>

</form>

<script>

    // Select All
    function checkAll(source) {

        let checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(function(checkbox) {

            checkbox.checked = source.checked;
        });
    }

    // Module Wise Select
    function toggleModulePermissions(moduleId, source) {

        let permissions = document.querySelectorAll('.module-' + moduleId);

        permissions.forEach(function(permission) {

            permission.checked = source.checked;
        });
    }

</script>

@endsection