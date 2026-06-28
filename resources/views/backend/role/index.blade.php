@extends('backend.layouts.app')
@section('title')
    Role List
@endsection
@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container flex flex-col px-8">
        <!-- Primary -->
        <div class="flex items-center justify-between px-9">
            <div class="">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{route('role.create')}}"
                       class="inline-flex items-center px-2.5 py-2 w-30 border border-transparent text-base leading-4 font-medium rounded text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>Add
                    </a>
                </span>
            </div>
            <div>
                <form action="{{route('role.list')}}" method="get" class="w-full">
                    <div class="flex items-center justify-center mb-10">
                        <div class="space-x-6 w-1/8">
                            <label for="email"
                                   class="ml-5 text-sm font-medium leading-5 text-gray-700 "></label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" name="search" type="text" placeholder="Search"
                                       class="w-full py-2 form-input" value = "{{request()->query('search')}}">
                            </div>
                        </div>
                        <div class="mt-1.5">
                            <button type="submit"
                                    class="px-4 py-2 mt-5 ml-5 space-x-6 text-white bg-indigo-600 rounded-md focus:outline-none">
                                submit
                            </button>
                            @if (request()->query('search'))
                            <a href="{{route('role.list')}}"
                                class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                                Reset
                            </a>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            @if (request()->query('search'))
                <div class="flex mb-10 items-left">
                    <p>You searched for: {{request()->query('search')}}</p>
                </div>
            @endif
            <div class="border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 ">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Serial
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Name
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Action
                        </th>

                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($roles as $key=>$role)
                        <tr>
                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$key+1}}
                                    </div>
                                </div>
                            </td>

                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$role->name}}
                                    </div>
                                </div>
                            </td>

                            <td class="flex px-8 py-8 space-x-2 text-sm font-medium text-right  whitespace-nowrap">
                                    <a title="Edit" href="{{route('role.edit',$role->id)}}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <svg class="w-5 h-5 text-blue-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                            <path fill-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a title="Delete" href="{{route('role.delete',$role->id)}}"
                                       onclick="return confirm('Are you sure you want to delete it ?')"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <svg class="w-5 h-5 text-red-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More people... -->
                    </tbody>
                </table>
                {{$roles->links()}}
            </div>
        </div>
    </div>
@endsection
