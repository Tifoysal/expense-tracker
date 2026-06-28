@extends('backend.layouts.app')

@section('content')
<div class=" space-y-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center border-b border-gray-200 pb-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                মামলার ব্যয়ের হিসাব
            </h1>
            <p class="text-sm text-slate-500">
                পারিবারিক সম্পত্তি মামলার ব্যয়ের সমান (১/৩) হিসাব।
            </p>
        </div>

        <span class="text-xs font-semibold uppercase bg-slate-200 text-slate-700 px-3 py-1.5 rounded-full tracking-wider">
            সিস্টেম চালু
        </span>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- TOP SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-6 gap-6">

        <!-- মোট তহবিল -->
        <div class="bg-green-100 text-green-600 p-6 rounded-2xl shadow-sm relative overflow-hidden">
            <h3 class="text-xs font-bold uppercase tracking-widest text-black">
                মোট তহবিল
            </h3>

            <p class="text-4xl font-extrabold mt-3">
                {{ number_format($totalPoolBalance,2) }}
                <span class="text-lg font-normal opacity-75">৳</span>
            </p>

            <div class="absolute right-4 bottom-4 opacity-10 text-6xl font-bold">
                ৳
            </div>
        </div>

        <!-- চলতি মাস -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">
                চলতি মাসের ব্যয়
            </h3>

            <p class="text-4xl font-extrabold mt-3 text-rose-600">
                {{ number_format($thisMonthTotalExpense,2) }}
                <span class="text-lg text-slate-400">৳</span>
            </p>

            <p class="text-xs text-slate-400 mt-2">
                জনপ্রতি:
                {{ number_format($thisMonthTotalExpense/3,2) }} ৳
            </p>

        </div>

        <!-- মোট ব্যয় -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">
                মোট মামলার ব্যয়
            </h3>

            <p class="text-4xl font-extrabold mt-3 text-slate-900">
                {{ number_format($historicalTotalExpense,2) }}
                <span class="text-lg text-slate-400">৳</span>
            </p>

            <p class="text-xs text-slate-400 mt-2">
                শুরু থেকে বর্তমান পর্যন্ত
            </p>

        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">
                মোট জন প্রতি ব্যয়
            </h3>

            <p class="text-4xl font-extrabold mt-3 text-slate-900">
                {{ number_format($historicalTotalExpense,2) }}
                <span class="text-lg text-slate-400">৳</span>
            </p>

            <p class="text-xs text-slate-400 mt-2">
                শুরু থেকে বর্তমান পর্যন্ত
            </p>

        </div>

        <!-- Remaining Balance Cards -->
       

    </div>

    <!-- FAMILY ACCOUNTS -->
    <div>

        <h2 class="text-xs font-bold uppercase text-slate-400 tracking-wider mb-3">
            পরিবারের সদস্যদের জমা
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach($accounts as $account)

            <div class="bg-white p-5 rounded-xl border border-gray-200 flex justify-between items-center">

                <div>

                    <h4 class="text-sm font-bold text-slate-700">
                        {{ $account->name }}
                    </h4>

                    <!-- <p class="text-xs text-slate-400 mt-1">
                        মোট ব্যয়ের ১/৩ অংশ
                    </p> -->

                </div>

                <div class="text-right">

                    <span class="text-xl font-bold text-slate-900">
                        {{ number_format($account->balance,2) }} ৳
                    </span>

                    <br>

                    <span class="inline-block mt-2 text-xs px-2 py-1 rounded
                        {{ $account->balance < 20000 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">

                        {{ $account->balance < 20000 ? 'টাকা যোগ করুন' : 'পর্যাপ্ত ব্যালেন্স' }}

                    </span>

                </div>

            </div>

            @endforeach

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

        <div class="px-6 py-4 border-b bg-slate-50 flex justify-between">

            <h3 class="font-bold text-slate-700">
                চলতি মাসের ব্যয়ের তালিকা
            </h3>

            <span class="text-xs text-slate-500">
                চলতি মাস
            </span>

        </div>

        <table class="w-full">

            <thead>

                <tr class="bg-slate-50 text-xs uppercase text-slate-500">

                    <th class="p-4 text-left">তারিখ</th>
                    <th class="p-4 text-left">বিবরণ</th>
                    <th class="p-4 text-left">ধরণ</th>
                    <th class="p-4 text-left">দায়িত্বপ্রাপ্ত</th>
                    <th class="p-4 text-right">মোট ব্যয়</th>
                    <th class="p-4 text-right">প্রতি সদস্য (১/৩)</th>

                </tr>

            </thead>

            <tbody class="divide-y">

                @forelse($thisMonthExpenses as $item)

                <tr>

                    <td class="p-4">
                        {{ $item->expense->mamla_date }}
                    </td>

                    <td class="p-4">
                        {{ $item->title }}
                    </td>

                    <td class="p-4">

                        <span class="bg-slate-100 px-2 py-1 rounded text-xs">
                            {{ $item->type }}
                        </span>

                    </td>

                    <td class="p-4">
                        {{ $item->representative }}
                    </td>

                    <td class="p-4 text-right font-semibold">
                        {{ number_format($item->total_amount,2) }} ৳
                    </td>

                    <td class="p-4 text-right font-bold text-rose-600">
                        {{ number_format($item->split_amount,2) }} ৳
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="p-10 text-center text-slate-500">
                        এই মাসে কোনো ব্যয়ের তথ্য পাওয়া যায়নি।
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection