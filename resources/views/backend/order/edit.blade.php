@extends('backend.layouts.app')
@section('title')
Product Edit
@endsection
@section('content')<form action="{{route('product.update',$product->slug)}}" method="post" class=" px-6 py-6 rounded-md space-y-7"
    enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input value="{{ $product->name }}" id="name" name="name" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter type name" />
            </div>
            @error('name')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Desc<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input value="{{ $product->desc }}" id="desc" name="desc" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter type desc" />
            </div>
            @error('desc')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Price<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input value="{{ $product->price }}" id="price" name="price" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter product price" />
            </div>
            @error('price')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Quantity<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input value="{{ $product->quantity }}" id="quantity" name="quantity" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter type quantity" />
            </div>
            @error('quantity')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Category<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="category_id" class="form-select appearance-none
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
                    <option selected>Select Category </option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == request()->category_id ? 'selected' :
                        ''}}>{{$category->name}}
                    </option>
                    @endforeach

                </select>
            </div>
            @error('category_id')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Brand<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="brand_id" class="form-select appearance-none
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
                    <option selected>Select Brand </option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}" {{$brand->id == request()->brand_id ? 'selected' :
                        ''}}>{{$brand->name}}
                    </option>
                    @endforeach

                </select>
            </div>
            @error('brand_id')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Type<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="type_id" class="form-select appearance-none
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
                    <option selected>Select Type </option>
                    @foreach ($types as $type)
                    <option value="{{$type->id}}" {{$type->id == request()->type_id ? 'selected' :
                        ''}}>{{$type->name}}
                    </option>
                    @endforeach

                </select>
            </div>
            @error('type_id')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Image<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="image" value="{{old('image')}}" name="image" type="file"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter category image" />
            </div>
            @error('image')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
    </div>
    <div class="mt-8 pt-5">
        <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <a href="{{route('category.index')}}"
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
@endsection
