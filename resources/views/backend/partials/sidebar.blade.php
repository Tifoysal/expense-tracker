<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white border-r border-gray-200">
        <div id="sidebar_main_content" class="flex flex-col flex-1 h-0 pt-5 pb-4 overflow-y-auto">

            <!-- Logo Section -->
            <a href="{{ route('admin.dashboard') }}">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="w-auto rounded-full h-15" src="{{ $settings->logo }}" alt="logo" />
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="flex-1 px-2 mt-5 bg-white">

                <!-- Dashboard Link -->
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ isRouteActive('admin.dashboard*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 hover:text-gray-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Dashboard
                </a>

                {{-- ==========================================
                     ACCOUNTS SECTION
                     ========================================== --}}
                @php
                $canViewAccounts =
                    hasAnyPermissions([
                        'banking.account.index', 'expense.index', 'expenses.category.list', 
                        'transfer.index', 'transaction.statement', 'transaction.index', 
                        'reports.sale.profit-loss', 'reports.yearly.summary.index', 'tax.list'
                    ]);
                @endphp

                @if($canViewAccounts)
                <div class="border-t border-b border-gray-200 relative py-2 my-4 shadow-sm">
                    <h3 class="px-2 text-xs font-semibold text-gray-400 absolute top-[-10px] w-full text-center">
                        <span class="bg-white px-2">Accounts</span>
                    </h3>

                    {{-- Head Of Accounts --}}
                    @permission('banking.account.index')
                    <div class="relative">
                        <a href="{{ route('banking.account.index') }}"
                            class="{{ isRouteActive('banking.account.index*') }} flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 hover:text-gray-900 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="h-6 w-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V13.5Zm0 2.25h.008v.008H8.25v-.008Zm0 2.25h.008v.008H8.25V18Zm2.498-6.75h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V13.5Zm0 2.25h.007v.008h-.007v-.008Zm0 2.25h.007v.008h-.007V18Zm2.504-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V18Zm2.498-6.75h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V13.5ZM8.25 6h7.5v2.25h-7.5V6ZM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 0 0 2.25 2.25h10.5a2.25 2.25 0 0 0 2.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0 0 12 2.25Z" />
                            </svg>
                            Head of Accounts
                        </a>
                    </div>
                    @endpermission

                    {{-- Expense Menu --}}
                    @if(hasAnyPermissions(['expenses.index', 'expenses.category.list']))
                    <div class="relative">
                        <li class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-100 cursor-pointer focus:outline-none">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="h-6 w-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 7.5.415-.207a.75.75 0 0 1 1.085.67V10.5m0 0h6m-6 0h-1.5m1.5 0v5.438c0 .354.161.697.473.865a3.751 3.751 0 0 0 5.452-2.553c.083-.409-.263-.75-.68-.75h-.745M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Expense
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>

                        <div class="child-menu-div ml-5 {{ isRouteActive('expenses*') ? '' : 'hidden' }}">
                            @permission('expenses.category.list')
                            <a href="{{ route('expenses.category.list') }}"
                                class="mt-1 {{ isRouteActive('expenses.category.list') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                Expense Category
                            </a>
                            @endpermission

                            @permission('expenses.index')
                            <a href="{{ route('expenses.index') }}"
                                class="mt-1 {{ isRouteActive('expenses.index') }} {{ isRouteActive('expenses.create') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                List
                            </a>
                            @endpermission
                        </div>
                    </div>
                    @endif

                    {{-- Transfer Menu --}}
                    @permission('transfer.index')
                    <div class="relative">
                        <li class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-100 cursor-pointer focus:outline-none">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="h-6 w-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                                Transfer
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>

                        <div class="child-menu-div ml-5 {{ isRouteActive('transfer*') ? '' : 'hidden' }}">
                            <a href="{{ route('transfer.index') }}"
                                class="mt-1 {{ isRouteActive('transfer.index') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                List
                            </a>
                        </div>
                    </div>
                    @endpermission

                    {{-- Transaction Menu --}}
                    @if(hasAnyPermissions(['transaction.statement', 'transaction.index']))
                    <div class="relative">
                        <li class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-100 cursor-pointer focus:outline-none">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="h-6 w-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                </svg>
                                Transaction
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>

                        <div class="child-menu-div ml-5 {{ isRouteActive('transaction*') ? '' : 'hidden' }}">
                            @permission('transaction.statement')
                            <a href="{{ route('transaction.statement') }}"
                                class="mt-1 {{ isRouteActive('transaction.statement') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                Statement
                            </a>
                            @endpermission

                            @permission('transaction.index')
                            <a href="{{ route('transaction.index') }}"
                                class="mt-1 {{ isRouteActive('transaction.index') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                Transactions
                            </a>
                            @endpermission
                        </div>
                    </div>
                    @endif

                    {{-- Reports Menu --}}
                    @if(hasAnyPermissions(['reports.sale.profit-loss', 'reports.yearly.summary.index']))
                    <div class="relative">
                        <li class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-100 cursor-pointer focus:outline-none">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="h-6 w-6 mr-3 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-700">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                </svg>
                                Reports
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>

                        <div class="child-menu-div ml-5 {{ isRouteActive('reports*') ? '' : 'hidden' }}">
                            @permission('reports.sale.profit-loss')
                            <a href="{{ route('reports.sale.profit-loss') }}"
                                class="mt-1 {{ isRouteActive('reports.sale.profit-loss') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                Sale Report
                            </a>
                            @endpermission

                            @permission('reports.yearly.summary.index')
                            <a href="{{ route('reports.yearly.summary.index') }}"
                                class="mt-1 {{ isRouteActive('reports.yearly.summary*') }} group flex items-center px-3 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 transition ease-in-out duration-150">
                                Yearly Summary
                            </a>
                            @endpermission
                        </div>
                    </div>
                    @endif

                    {{-- Tax Menu --}}
                    
                </div>
                @endif

               

            </nav>
        </div>

        <!-- Footer / Logout Section -->
        <div class="flex flex-shrink-0 p-4 bg-gray-50 border-t border-gray-200">
            <a href="{{ route('logout') }}" class="flex-shrink-0 block w-full group" title="logout">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500 group-hover:text-gray-700 transition duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <p class="text-sm font-medium text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-900">
                        Logout
                    </p>
                </div>
            </a>
        </div>

    </div>
</div>