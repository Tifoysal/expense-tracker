@extends('backend.layouts.app')
@section('title')
    User Profile
@endsection
@section('content')    <div class="bg-white rounded-lg shadow-md mt-10 mb-10 pb-7 mx-10">

        <div class="flex justify-between items-center px-8 py-5 border-b-2 border-gray-200">
            <div class="flex justify-start items-center">
                <img src="{{ $user->image }}" class="block border-4 border-white h-36 mt-10 object-cover rounded-full w-36"
                    alt="" />
                <div class="pl-5">
                    <h3 class="text-3xl font-medium text-gray-700">Profile</h3>
                    <p class="text-md text-gray-500"> Account Information</p>
                </div>
            </div>
        </div>

        <div x-data="{ tab: '#tab1' }" x-init="$refs[tab].focus()" class="pl-8">

            <!-- Links here -->
            <div class="flex flex-row justify-between mx-4 ">
                <div>
                    <div class="space-x-10 py-4">
                        <a x-ref="#tab1"
                            class="px-4 py-2 text-xl font-bold  outline-none border-b-2 hover:border-green-400 focus:border-green-500 active:border-indigo-500 visited:border-indigo-500"
                            href="#" x-on:click.prevent="tab = '#tab1'">General Information</a>
                    </div>
                </div>
                <div class="space-x-10 py-4 "><a class="hover:text-gray-500" href="{{ route('user.edit', $user->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a></div>
            </div>

            <!-- Tab Content here -->
            <div class="flex flex-row justify-start mx-4 space-x-4">
                <div>
                    <div x-show="tab == '#tab1'" x-cloak>
                        <div class="py-5 ">
                            <div class="space-y-8">
                                <div class="grid grid-cols-2 gap-32">
                                    <div>
                                        <p class="font-medium text-lg">Name</p>
                                        <p class="font-normal text-sm">{{ $user->name }} </p>

                                    </div>

                                    <!-- <div>
                                            <p class="font-medium text-lg">Gender</p>
                                            <p class="font-normal text-sm">{{ $user->gender }}</p>
                                        </div> -->
                                </div>


                                <div class="grid grid-cols-2 gap-32">
                                    <div>
                                        <p class="font-medium text-lg">Email</p>
                                        <p class="font-normal text-sm">{{ $user->email }}</p>
                                    </div>

                                    <div>
                                        <p class="font-medium text-lg">Address</p>
                                        <p class="font-normal text-sm">{{ $user->address }} </p>
                                    </div>
                                    
                                </div>

                                <div class="grid grid-cols-2 gap-32">
                                    <div>
                                        <p class="font-medium text-lg">Phone</p>
                                        <p class="font-normal text-sm">{{ $user->phone }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
