<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Panel</title>
    @notifyCss
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@latest/dist/tailwind-ui.min.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-20 w-auto rounded-full" src="" alt="logo" />
            <h2 class="mt-6 text-center text-3xl leading-3 font-bold text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form action="{{route('customer.login.post')}}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            Email address <span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input placeholder="Enter your email" id="email" name="email" type="email"
                                value="{{ old('email') }}" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('email')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password<span class="text-red-800"> *</span>
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input value="12345" placeholder="Enter your password" id="password" name="password"
                                type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_token" value="true" type="checkbox" name="remember_me"
                                class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                            <label for="remember_token" class="ml-2 block text-sm leading-5 text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm leading-5">
                            <a href=""
                                class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Sign in
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('notify::components.notify')
    @notifyJs
</body>
