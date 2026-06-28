{{-- <li>{{ $child_category->name }}</li> --}}

<option @if($child_category->id==$category->parent_id) selected @endif value="{{$child_category->id}}">-@if(isset($hi_pen)){{$hi_pen}}@endif{{$child_category->name}}</option>
@if ($child_category->categories)

@if(isset($hi_pen))
@php 
$hi_pen.= '-';
@endphp
@endif

        @foreach ($child_category->categories as $childCategory)
            @include('expenses.child_category_edit', ['child_category' => $childCategory, 'hi_pen' => $hi_pen])
        @endforeach

@endif