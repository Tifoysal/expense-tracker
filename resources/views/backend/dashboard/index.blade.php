@extends('backend.layouts.app')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 border-b border-gray-200 pb-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">
                মামলার ব্যয়ের হিসাব
            </h1>
            <p class="text-xs sm:text-sm text-slate-500">
                পারিবারিক সম্পত্তি মামলার ব্যয়ের সমান (১/৩) হিসাব।
            </p>
        </div>

        <span class="text-xs font-semibold uppercase bg-slate-200 text-slate-700 px-3 py-1.5 rounded-full tracking-wider self-start sm:self-auto">
            সিস্টেম চালু
        </span>
    </div>

    @if(session('success'))
        <div class="p-3 sm:p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- TOP SUMMARY -->
    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-6">

        <!-- মোট তহবিল -->
        <div class="bg-green-100 text-green-600 p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-sm relative overflow-hidden">
            <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-black">
                মোট তহবিল
            </h3>

            <p class="text-2xl sm:text-4xl font-extrabold mt-2 sm:mt-3">
                {{ number_format($totalPoolBalance,2) }}
                <span class="text-sm sm:text-lg font-normal opacity-75">৳</span>
            </p>

            <div class="absolute right-4 bottom-4 opacity-10 text-5xl sm:text-6xl font-bold">
                ৳
            </div>
        </div>

        <!-- চলতি মাস -->
        <div class="bg-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-slate-400">
                চলতি মাসের ব্যয়
            </h3>

            <p class="text-2xl sm:text-4xl font-extrabold mt-2 sm:mt-3 text-rose-600">
                {{ number_format($thisMonthTotalExpense,2) }}
                <span class="text-sm sm:text-lg text-slate-400">৳</span>
            </p>

            <p class="text-[11px] sm:text-xs text-slate-400 mt-1 sm:mt-2">
                জনপ্রতি:
                {{ number_format($thisMonthTotalExpense/3,2) }} ৳
            </p>

        </div>

        <!-- মোট ব্যয় -->
        <div class="bg-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-slate-400">
                মোট মামলার ব্যয়
            </h3>

            <p class="text-2xl sm:text-4xl font-extrabold mt-2 sm:mt-3 text-slate-900">
                {{ number_format($historicalTotalExpense,2) }}
                <span class="text-sm sm:text-lg text-slate-400">৳</span>
            </p>

            <p class="text-[11px] sm:text-xs text-slate-400 mt-1 sm:mt-2">
                শুরু থেকে বর্তমান পর্যন্ত
            </p>

        </div>

        <div class="bg-white p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-slate-400">
                মোট জন প্রতি ব্যয়
            </h3>

            <p class="text-2xl sm:text-4xl font-extrabold mt-2 sm:mt-3 text-slate-900">
                {{ number_format($historicalTotalExpense/3,2) }}
                <span class="text-sm sm:text-lg text-slate-400">৳</span>
            </p>

            <p class="text-[11px] sm:text-xs text-slate-400 mt-1 sm:mt-2">
                শুরু থেকে বর্তমান পর্যন্ত
            </p>

        </div>

    </div>

    <!-- FAMILY ACCOUNTS -->
    <div>

        <h2 class="text-xs font-bold uppercase text-slate-400 tracking-wider mb-3">
            পরিবারের সদস্যদের জমা
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">

            @foreach($accounts as $account)

            <div class="bg-white p-4 sm:p-5 rounded-xl border border-gray-200 flex justify-between items-center">

                <div>

                    <h4 class="text-sm font-bold text-slate-700">
                        {{ $account->name }}
                    </h4>

                </div>

                <div class="text-right">

                    <span class="text-lg sm:text-xl font-bold text-slate-900">
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

    <!-- EXPENSE HISTORY (filter + table) -->
    <div>

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 sm:gap-4 mb-3">
            <h2 class="text-xs font-bold uppercase text-slate-400 tracking-wider">
                ব্যয়ের ইতিহাস
            </h2>

            <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-2 sm:flex sm:flex-wrap items-end gap-2 sm:gap-3">
                <div>
                    <label class="block text-[10px] font-semibold uppercase text-slate-400 mb-1">Month</label>
                    <select name="month" class="w-full p-2 border border-gray-300 rounded text-sm bg-white">
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ (int) $filterMonth === $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-semibold uppercase text-slate-400 mb-1">Year</label>
                    <select name="year" class="w-full p-2 border border-gray-300 rounded text-sm bg-white">
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}" {{ (int) $filterYear === (int) $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded text-sm font-medium hover:bg-slate-900 shadow">
                    Filter
                </button>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm text-center hover:bg-gray-300">
                    Reset
                </a>
            </form>
        </div>

        {{-- Desktop / tablet: table view --}}
        <div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold border-b border-gray-200">
                            <th class="px-4 sm:px-6 py-3">Mamla Date</th>
                            <th class="px-4 sm:px-6 py-3">Title</th>
                            <th class="px-4 sm:px-6 py-3">Category</th>
                            <th class="px-4 sm:px-6 py-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                        @forelse($expenseHistory as $detail)
                            <tr>
                                <td class="px-4 sm:px-6 py-4 font-semibold whitespace-nowrap">
                                    @if(optional($detail->expense)->mamla_date)
                                        {{ \Carbon\Carbon::parse($detail->expense->mamla_date)->format('d M Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-4 sm:px-6 py-4">{{ $detail->title }}</td>
                                <td class="px-4 sm:px-6 py-4">
                                    @if($detail->expenseCategory)
                                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs">{{ $detail->expenseCategory->name }}</span>
                                    @else
                                        <span class="text-slate-400 text-xs">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-right font-bold text-rose-600 whitespace-nowrap">
                                    {{ number_format($detail->amount, 2) }} ৳
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 sm:px-6 py-8 text-center text-slate-400">
                                    No expenses found for {{ $months[$filterMonth] ?? '' }} {{ $filterYear }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($expenseHistory->isNotEmpty())
                        <tfoot>
                            <tr class="bg-slate-50 border-t border-gray-200">
                                <td colspan="3" class="px-4 sm:px-6 py-3 text-right text-xs font-bold uppercase text-slate-500">
                                    Total ({{ $months[$filterMonth] ?? '' }} {{ $filterYear }})
                                </td>
                                <td class="px-4 sm:px-6 py-3 text-right font-bold text-rose-600">
                                    {{ number_format($thisMonthTotalExpense, 2) }} ৳
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

        {{-- Mobile: card list view --}}
        <div class="sm:hidden space-y-3">
            @forelse($expenseHistory as $detail)
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex justify-between items-start gap-2">
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $detail->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">
                                @if(optional($detail->expense)->mamla_date)
                                    {{ \Carbon\Carbon::parse($detail->expense->mamla_date)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <p class="text-sm font-bold text-rose-600 whitespace-nowrap">
                            {{ number_format($detail->amount, 2) }} ৳
                        </p>
                    </div>
                    <div class="mt-2">
                        @if($detail->expenseCategory)
                            <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-xs">{{ $detail->expenseCategory->name }}</span>
                        @else
                            <span class="text-slate-400 text-xs">N/A</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl border border-gray-200 p-6 text-center text-slate-400 text-sm shadow-sm">
                    No expenses found for {{ $months[$filterMonth] ?? '' }} {{ $filterYear }}.
                </div>
            @endforelse

            @if($expenseHistory->isNotEmpty())
                <div class="bg-slate-50 rounded-xl border border-gray-200 p-4 flex justify-between items-center">
                    <span class="text-xs font-bold uppercase text-slate-500">
                        Total ({{ $months[$filterMonth] ?? '' }} {{ $filterYear }})
                    </span>
                    <span class="font-bold text-rose-600 text-sm">
                        {{ number_format($thisMonthTotalExpense, 2) }} ৳
                    </span>
                </div>
            @endif
        </div>
    </div>

</div>

@endsection