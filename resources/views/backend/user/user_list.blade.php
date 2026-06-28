@extends('backend.layouts.app')
@section('title')
    Users List
@endsection
@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col container px-8">
        <!-- Primary -->
        <div class="flex justify-between items-center px-9">
            <div>
                <span class="inline-flex rounded-md shadow-sm ">
                    <a href="{{route('user.create')}}"
                    class="inline-flex items-center px-2.5 py-2 w-30 text-base border border-transparent leading-4 font-medium rounded text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>Add
                    </a>
                </span>
            </div> 

            


            <div>
                <form action="{{route('user.list')}}" method="get" class="w-full">
                    <div class="flex items-center justify-center mb-10">
                        <div class="space-x-6 w-1/8">
                            <label for="email" class="ml-5 text-sm font-medium leading-5 text-gray-700 "></label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" name="search" type="text" placeholder="Search"
                                    class="w-full py-2 form-input" value="{{request()->query('search')}}">
                            </div>
                        </div>
                        <div class="mt-1.5">
                            <button type="submit"
                                class="px-4 py-2 mt-5 ml-5 space-x-6 text-white bg-indigo-600 rounded-md focus:outline-none">
                                Submit
                            </button>
                            @if (request()->query('search'))
                            <a href="{{route('user.list')}}"
                                class="focus:outline-none space-x-6 bg-black text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                                Reset
                            </a>
                            @endif
    
                        </div>
                    </div>
                </form>
            </div>




        </div>



        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if (request()->query('search'))
                <div class="flex mb-10  items-left">
                    <p>You searched for: {{request()->query('search')}}</p>
                </div>
            @endif
            <div class="shadow  border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Serial
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone
                        </th>

                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>

                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $key=>$user)
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
                                        <img width="150 px" src="{{$user->image}}" class="h-14 w-14 rounded-full object-contain" alt="">
                                    </div>
                                </div>
                            </td>

                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$user->name}}
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$user->role->name}}
                                    </div>
                                </div>
                            </td>
                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$user->email}}
                                    </div>
                                </div>
                            </td>

                            <td class="text-sm text-gray-900">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{$user->phone}}
                                    </div>
                                </div>
                            </td>

                            <td class=" space-x-2 py-8 px-8 whitespace-nowrap text-right text-sm font-medium flex">
                                @if ($user->role != 'super-admin')
                                    <a title="Edit" href="{{route('user.edit',$user->id)}}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        <svg class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                                            <path fill-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a title="profile" href="{{route('user.profile',$user->id)}}"
                                        class="text-indigo-600 hover:text-indigo-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
                                     </a>


                                    @if ($user->status == 'active')
                                       @if($user->role_id !== 1)
                                            <a title="block" href="{{route('user.block',$user->id)}}"
                                               onclick="return confirm('Are you sure you want to block it ?')"
                                               class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="h-5 w-5 fill-current text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M7 10h13a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 0 1 13.262-3.131l-1.789.894A5 5 0 0 0 7 9v1zm-2 2v8h14v-8H5zm5 3h4v2h-4v-2z"/></svg>
                                            </a>
                                       @endif
                                    @else
                                        <a title="unblock" href="{{route('user.unblock',$user->id)}}"
                                            onclick="return confirm('Are you sure you want to unblock it ?')"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="h-5 w-5 fill-current text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M19 10h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 1 1 14 0v1zM5 12v8h14v-8H5zm6 2h2v4h-2v-4zm6-4V9A5 5 0 0 0 7 9v1h10z"/></svg>
                                        </a>
                                    @endif

                                @else
                                <a title="Profile" href="{{route('user.profile',$user->id)}}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
                                 </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <!-- More people... -->
                    {{$users->links()}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
