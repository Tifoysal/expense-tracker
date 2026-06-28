@extends('backend.layouts.app')
@section('title')
    User Edit
@endsection
@section('content')
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col container px-8">
        <!-- Primary -->
        <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm pb-5">

            </span>
        </div>

        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow-md  border-b border-gray-200 sm:rounded-lg p-5 bg-white my-5">

                {{-- <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md"> --}}
                    <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group mb-6">
                          <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">First name
                            <span class="text-red-600">*</span>
                          </label>
                          <input required type="text" class="form-control
                            block
                            w-full
                            px-3
                            py-1.5
                            text-base
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
                            name="name"
                            aria-describedby="emailHelp" value="{{$user->name}}">
                            @error('name')<span class="text-red-600">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group mb-6">
                            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">User email
                                <span class="text-red-600">*</span>
                            </label>
                            <input required type="email" class="form-control
                              block
                              w-full
                              px-3
                              py-1.5
                              text-base
                              font-normal
                              text-gray-700
                              bg-white bg-clip-padding
                              border border-solid border-gray-300
                              rounded
                              transition
                              ease-in-out
                              m-0
                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
                              name="email"
                              aria-describedby="emailHelp" readonly value="{{$user->email}}">
                              @error('email')<span class="text-red-600">{{$message}}</span>@enderror
                        </div>

                        <div class="form-group mb-6">
                            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">
                                User phone<span class="text-red-600"> * </span></label>
                            <input required type="tel" class="form-control
                              block
                              w-full
                              px-3
                              py-1.5
                              text-base
                              font-normal
                              text-gray-700
                              bg-white bg-clip-padding
                              border border-solid border-gray-300
                              rounded
                              transition
                              ease-in-out
                              m-0
                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
                              name="phone"
                              aria-describedby="emailHelp" readonly value="{{$user->phone}}">
                              @error('phone')<span class="text-red-600">{{$message}}</span>@enderror
                        </div>


                        <div class="form-group mb-6">
                            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">User image</label>
                            <input type="file" class="form-control
                              block
                              w-full
                              px-3
                              py-1.5
                              text-base
                              font-normal
                              text-gray-700
                              bg-white bg-clip-padding
                              border border-solid border-gray-300
                              rounded
                              transition
                              ease-in-out
                              m-0
                              focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
                              name="image"
                              aria-describedby="emailHelp" readonly value="{{$user->image}}">
                        </div>

                        <div class="form-group mb-6">
                          <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">User Role
                            <span class="text-red-600">*</span>
                          </label>
                          <div class="mt-1 relative rounded-md shadow-sm">
                    <select required name="role_id"
                        class="form-select appearance-none
                            block
                            w-full
                            px-3
                            py-1.5
                            text-base
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="Default select example">
                        <option value="">-- Select Designation --</option>
                        @foreach ($roles as $role)
                            <option @if ($role->id == $user->role_id) selected @endif value="{{ $role->id }}">
                                {{ $role->name }}</option>
                        @endforeach

                    </select>
                </div>
                @error('role_id')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
                        </div>


                        <div class="mt-8 pt-5">
                            <div class="flex justify-end">
                                <span class="inline-flex rounded-md shadow-sm">
                                    <a href="{{route('user.list')}}"
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
                  {{-- </div> --}}

            </div>
        </div>
    </div>
@endsection
