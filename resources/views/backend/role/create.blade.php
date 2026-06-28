@extends('backend.layouts.app')
@section('title')
    Role Create
@endsection
@section('content')

  
    <form action="{{route('role.store')}}" method="post" class=" px-6 py-6 rounded-md space-y-7"
          enctype="multipart/form-data">
        @csrf
        <div class="bg-white py-12 rounded-lg shadow-md">
            <div class="px-10">
                <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                    Name<span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input required id="name" value="{{old('name')}}" name="name" type="text"
                           class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                           placeholder="Enter your name"/>
                </div>
                @error('name')<span class="text-red-600">{{$message}}</span>@enderror
            </div>

        <h3 class="text-center text-2xl font-bold py-8">Permissions list</h3>

        <div class="ml-11">
            <input type="checkbox" id="select-all" onchange="checkAll(this)">
            <span style="font-size: 18px" class="font-medium">Select All / Unselect All</span>
        </div>

        <div class="mt-5 ml-20">
            @foreach($modules as $module)
                <div class="mb-8">
                    <div class="flex items-center">

                        <h6 class="ml-2 font-medium">{{ucwords($module->name)}}</h6>
                    </div>
                        @foreach($module->permissions as $permission)
                            <div style="margin-left: 50px; margin-top: 5px">
                                <input

                                    type="checkbox"
                                    name="permission_ids[]"
                                    value="{{$permission->id}}" multiple
                                />
                                <span style="font-size: 15px;margin-top: 2px">{{ucwords(Str::replace("."," ",$permission->name))}}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-8 pt-5">
            <div class="flex justify-end">
          <span class="inline-flex rounded-md shadow-sm">
            <a href="{{route('role.list')}}"
               class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
              Cancel
            </a>
          </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
            <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
              Save
            </button>
          </span>
            </div>
        </div>

    </form>


    <script>
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        //    console.log(checkboxes);

        function checkAll(myCheckbox) {
            //    console.log(myCheckbox)
            if (myCheckbox.checked == true) {

                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = true;

                })
            } else {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                })
            }
        }

    </script>
@endsection






