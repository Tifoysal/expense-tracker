<div class="no-print">
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white">
        <div class="flex flex-col flex-1 h-0 pt-5 pb-4 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="w-auto rounded-full h-15" src="{{ $settings->logo }}" alt="logo" />

                    {{-- <span class="inline-block ml-3 font-semibold text-black">{{$settings->company_name}}</span>
                    --}}
                </div>
            </a>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <nav class="flex-1 px-2 mt-5 bg-white">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ isRouteActive('admin.dashboard*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    Dashboard
                </a>


                @permission('banking.account.index')

                    <div class="relative">
                        <a href="{{ route('banking.account.index') }}"
                            class="{{ isRouteActive('banking.account.index') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Bank Accounts
                        </a>
                    </div>
                @endpermission

                @permission('expense.index')
                    <div class="relative">
                        <li
                            class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                            <div class="flex items-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Expense
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>
                        <div class="child-menu-div ml-5">
                            @permission('expense.index')
                                <a href="{{ route('expense.index') }}"
                                    class=" mt-1 {{ isRouteActive('expense.index') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    List
                                </a>
                            @endpermission
                            @permission('expenses.category.list')
                                <a href="{{ route('expenses.category.list') }}"
                                    class=" mt-1 {{ isRouteActive('expenses.category.list') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    Expense Category
                                </a>
                            @endpermission
                        </div>
                    </div>
                @endpermission

                @permission('transaction.statement')
                    <div class="relative">
                        <li
                            class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                            <div class="flex items-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Transaction
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>
                        <div class="child-menu-div ml-5">
                            @permission('transaction.statement')
                                <a href="{{ route('transaction.statement') }}"
                                    class=" mt-1 {{ isRouteActive('transaction.statement') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    List
                                </a>
                            @endpermission
                            @permission('transaction.index')
                                <a href="{{ route('transaction.index') }}"
                                    class=" mt-1 {{ isRouteActive('transaction.index') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    Index
                                </a>
                            @endpermission
                        </div>
                    </div>
                @endpermission

                @permission('tax.list')
                    <div class="relative">
                        <a href="{{ route('tax.list') }}"
                            class="{{ isRouteActive('tax.list') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Tax
                        </a>
                    </div>
                @endpermission

                @permission('attendance.list')
                    <div class="relative">
                        <li
                            class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                            <div class="flex items-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Attendance
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>
                        <div class="child-menu-div ml-5">
                            @permission('attendance.list')
                                <a href="{{ route('attendance.list') }}"
                                    class=" mt-1 {{ isRouteActive('attendance.list') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    List
                                </a>
                            @endpermission
                            @permission('attendance.report')


                            <a href="{{ route('attendance.report') }}"
                                active_page="" active_secondary=""
                                class=" mt-1 {{ isRouteActive('attendance.report') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Attendence Report
                            </a>
                            @endpermission

                        </div>
                    </div>
                @endpermission

                @permission('leaves.list')
                    <div class="relative">
                        <li
                            class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                            <div class="flex items-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Leave
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>
                        <div class="child-menu-div ml-5">
                            @permission('leaves.list')
                                <a href="{{ route('leaves.list') }}"
                                    class=" mt-1 {{ isRouteActive('leaves.list') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    List
                                </a>
                            @endpermission
                            @permission('leaveTypes.index')
                                <a href="{{ route('leaveTypes.index') }}"
                                    class=" mt-1 {{ isRouteActive('leaveTypes.index') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                    </svg>
                                    Leave Type
                                </a>
                            @endpermission

                        </div>
                    </div>
                @endpermission

                @permission('employee.list')
                    <div class="relative">
                        <li
                            class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                            <div class="flex items-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                </svg>
                                Employee
                            </div>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </li>
                        <div class="child-menu-div ml-5">
                            @permission('employee.list')
                                <a href="{{ route('employee.list') }}"
                                    class="{{ isRouteActive('employee*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                                    <svg class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"
                                            fill="currentColor" />
                                    </svg>

                                    Employee List
                                </a>
                            @endpermission

                            @permission('designation.index')
                                <a href="{{ route('designation.index') }}"
                                    class="{{ isRouteActive('designation*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                                    <svg class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"
                                            fill="currentColor" />
                                    </svg>

                                    Employee Designation
                                </a>
                            @endpermission

                        </div>
                    </div>
                @endpermission

                <div class="relative">
                    <li
                        class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Customers
                        </div>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </li>
                    <div class="child-menu-div ml-5">
                        @permission('dealer.list')
                            <a href="{{ route('dealer.list') }}"
                                class=" mt-1 {{ isRouteActive('dealer.list*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Dealers
                            </a>
                        @endpermission
                        {{-- @permission('corporate.list')
                            <a href="{{ route('corporate.list') }}"
                                class=" mt-1  {{ isRouteActive('corporate.list*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Corporates
                            </a>
                        @endpermission --}}
                        {{-- @permission('retailer.list')
                            <a href="{{ route('retailer.list') }}"
                                class=" mt-1  {{ isRouteActive('retailer.list*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                                    height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Retailers
                            </a>
                        @endpermission --}}

                        {{-- @permission('')
                            <a href="{{ route('enduser.list') }}"
                                class=" mt-1  {{ isRouteActive('enduser.list*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                </svg>
                                Endusers
                            </a>
                        @endpermission --}}
                    </div>
                </div>


                <a href="{{ route('employee.checking') }}"
                    class="{{ isRouteActive('') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                    </svg>
                    Employee Checking
                </a>

                <div class="relative">
                    <li
                        class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">
                            <svg viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"
                                class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>product-management</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="icon" fill="#000000" transform="translate(42.666667, 34.346667)">
                                            <path
                                                d="M426.247658,366.986259 C426.477599,368.072636 426.613335,369.17172 426.653805,370.281095 L426.666667,370.986667 L426.666667,392.32 C426.666667,415.884149 383.686003,434.986667 330.666667,434.986667 C278.177524,434.986667 235.527284,416.264289 234.679528,393.025571 L234.666667,392.32 L234.666667,370.986667 L234.679528,370.281095 C234.719905,369.174279 234.855108,368.077708 235.081684,366.992917 C240.961696,371.41162 248.119437,375.487081 256.413327,378.976167 C275.772109,387.120048 301.875889,392.32 330.666667,392.32 C360.599038,392.32 387.623237,386.691188 407.213205,377.984536 C414.535528,374.73017 420.909655,371.002541 426.247658,366.986259 Z M192,7.10542736e-15 L384,106.666667 L384.001134,185.388691 C368.274441,181.351277 350.081492,178.986667 330.666667,178.986667 C301.427978,178.986667 274.9627,184.361969 255.43909,193.039129 C228.705759,204.92061 215.096345,223.091357 213.375754,241.480019 L213.327253,242.037312 L213.449,414.75 L192,426.666667 L-2.13162821e-14,320 L-2.13162821e-14,106.666667 L192,7.10542736e-15 Z M426.247658,302.986259 C426.477599,304.072636 426.613335,305.17172 426.653805,306.281095 L426.666667,306.986667 L426.666667,328.32 C426.666667,351.884149 383.686003,370.986667 330.666667,370.986667 C278.177524,370.986667 235.527284,352.264289 234.679528,329.025571 L234.666667,328.32 L234.666667,306.986667 L234.679528,306.281095 C234.719905,305.174279 234.855108,304.077708 235.081684,302.992917 C240.961696,307.41162 248.119437,311.487081 256.413327,314.976167 C275.772109,323.120048 301.875889,328.32 330.666667,328.32 C360.599038,328.32 387.623237,322.691188 407.213205,313.984536 C414.535528,310.73017 420.909655,307.002541 426.247658,302.986259 Z M127.999,199.108 L128,343.706 L170.666667,367.410315 L170.666667,222.811016 L127.999,199.108 Z M42.6666667,151.701991 L42.6666667,296.296296 L85.333,320.001 L85.333,175.405 L42.6666667,151.701991 Z M330.666667,200.32 C383.155809,200.32 425.80605,219.042377 426.653805,242.281095 L426.666667,242.986667 L426.666667,264.32 C426.666667,287.884149 383.686003,306.986667 330.666667,306.986667 C278.177524,306.986667 235.527284,288.264289 234.679528,265.025571 L234.666667,264.32 L234.666667,242.986667 L234.808715,240.645666 C237.543198,218.170241 279.414642,200.32 330.666667,200.32 Z M275.991,94.069 L150.412,164.155 L192,187.259259 L317.866667,117.333333 L275.991,94.069 Z M192,47.4074074 L66.1333333,117.333333 L107.795,140.479 L233.373,70.393 L192,47.4074074 Z"
                                                id="Combined-Shape"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Product Management
                        </div>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </li>
                    <div class="child-menu-div ml-5">


                        @permission('category.index')
                            <a href="{{ route('category.index') }}"
                                class="{{ isRouteActive('category*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>

                                Category
                            </a>
                        @endpermission
                        @permission('brand.index')
                            <a href="{{ route('brand.index') }}"
                                class="{{ isRouteActive('brand*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                Brand
                            </a>
                        @endpermission
                        @permission('generic.index')
                            <a href="{{ route('generic.index') }}"
                                class="{{ isRouteActive('generic*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.341A8 8 0 118.659 4.572m12.769 10.769L12 12m0 0l-4.243 4.243m4.243-4.243l4.243-4.243" />
                                </svg>
                                Generics
                            </a>
                        @endpermission
                        @permission('admin.product.attribute.list')
                            <a href="{{ route('admin.product.attribute.list') }}"
                                class="{{ isRouteActive('attribute*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7V5a2 2 0 012-2h2m8 0h2a2 2 0 012 2v2m0 8v2a2 2 0 01-2 2h-2m-8 0H6a2 2 0 01-2-2v-2m2-7h.01M12 12h.01M17 17h.01" />
                                </svg>
                                Attributes
                            </a>
                        @endpermission
                        @permission('product.index')
                            <a href="{{ route('product.index') }}"
                                class="{{ isRouteActive('product*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800 ">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M11.0287 2.53961C11.6327 2.20402 12.3672 2.20402 12.9713 2.5396L20.4856 6.71425C20.8031 6.89062 21 7.22524 21 7.5884V15.8232C21 16.5495 20.6062 17.2188 19.9713 17.5715L12.9713 21.4604C12.3672 21.796 11.6327 21.796 11.0287 21.4604L4.02871 17.5715C3.39378 17.2188 3 16.5495 3 15.8232V7.5884C3 7.22524 3.19689 6.89062 3.51436 6.71425L11.0287 2.53961Z"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M7.5 4.5L16.5 9.5V13" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6 12.3281L9 14" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3 7L12 12M12 12L21 7M12 12V21.5" stroke="#000000" stroke-width="2"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                Products
                            </a>
                        @endpermission
                    </div>
                </div>

                <div class="relative">


                    <li
                        class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Enduser Orders Status
                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                    </li>

                    <div class="child-menu-div ml-5">
                        @permission('general.order.list')
                            <a href="{{ route('general.order.list') }}"
                                class=" mt-1 {{ request()->routeIs('general.order.list') && !request()->has('status') ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
                                </svg>
                                All Orders
                            </a>
                        @endpermission

                        @permission('general.order.list')
                            <a href="{{ route('general.order.list', ['status' => 'pending']) }}"
                                class=" mt-1 {{ request()->query('status') === 'pending' ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
                                </svg>
                                Pending Orders
                            </a>
                        @endpermission

                        @permission('general.order.list')
                            <a href="{{ route('general.order.list', ['status' => 'process']) }}"
                                class=" mt-1  {{ request()->query('status') === 'process' ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                </svg>
                                Process Orders
                            </a>
                        @endpermission
                        @permission('general.order.list')
                            <a href="{{ route('general.order.list', ['status' => 'confirm']) }}"
                                class=" mt-1  {{ request()->query('status') === 'confirm' ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Confirmed Orders
                            </a>
                        @endpermission
                        @permission('general.order.list')
                            <a href="{{ route('general.order.list', ['status' => 'delivered']) }}"
                                class=" mt-1  {{ request()->query('status') === 'delivered' ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                                Delivered Orders
                            </a>
                        @endpermission
                        @permission('general.order.list')
                            <a href="{{ route('general.order.list', ['status' => 'cancel']) }}"
                                class=" mt-1 {{ request()->query('status') === 'cancel' ? 'bg-gray-200 active' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Cancel Orders
                            </a>
                        @endpermission
                    </div>
                </div>
                {{-- @permission('dealer.purchaseList')
                    <a href="{{ route('dealer.purchaseList') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="mr-3 text-gray-900">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                                fill="rgba(79,78,78,1)" />
                        </svg>
                        Dealer Purchase
                    </a>
                @endpermission --}}
                {{-- @permission('corporate.purchaseList')
                    <a href="{{ route('corporate.purchaseList') }}"
                        class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="mr-3 text-gray-900">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                                fill="rgba(79,78,78,1)" />
                        </svg>
                        Corporate Purchase
                    </a>
                @endpermission --}}

                @permission('dealer.purchase.index')
                    <a href="{{ route('dealer.purchase.index') }}"
                        class="{{ isRouteActive('dealer.purchase.index*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="mr-3 text-gray-900">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                                fill="rgba(79,78,78,1)" />
                        </svg>


                        Dealer Purchase
                    </a>
                @endpermission


                {{-- @permission('retailer.purchaseList')
                    <a href="{{ route('retailer.purchaseList') }}"
                        class="{{ isRouteActive('retailer.purchaseList*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="mr-3 text-gray-900">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                                fill="rgba(79,78,78,1)" />
                        </svg>
                        Retailers Purchase
                    </a>
                @endpermission --}}
                {{-- @permission('order.index')
                    <a href="{{ route('order.index') }}"
                        class="{{ isRouteActive('order.index*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>  

                        Endusers Order List
                    </a>
                @endpermission --}}

                @permission('dealer.stock.index')
                    <a href="{{ route('dealer.stock.index') }}"
                        class="{{ isRouteActive('dealer.stock.index*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24"
                            stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>

                        Dealer Stock
                    </a>
                @endpermission
                {{-- @permission('retailer.purchase.index')
                    <a href="{{ route('retailer.purchase.index') }}"
                        class="{{ isRouteActive('retailer.purchase.index*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>

                        Retailer Order
                    </a>
                @endpermission --}}
                @permission('purchase.index')
                    <a href="{{ route('purchase.index') }}"
                        class="{{ isRouteActive('purchase.index*') }}  flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        Purchase
                    </a>
                @endpermission
                @permission('stock.index')
                    <a href="{{ route('stock.index') }}"
                        class="{{ isRouteActive('stock.index*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>

                        Stock Management
                    </a>
                @endpermission
                @permission('vendor')
                    <a href="{{ route('vendor') }}"
                        class="{{ isRouteActive('vendor*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                        </svg>


                        Vendor

                    </a>
                @endpermission
                @permission('location.division')
                    <a href="{{ route('location.division') }}"
                        class="{{ isRouteActive('location.division*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>

                        Division
                    </a>
                @endpermission
                @permission('campaign.list')
                    <a href="{{ route('campaign.list') }}"
                        class="{{ isRouteActive('campaign.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="mr-3 text-gray-600">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M21 13.242V20h1v2H2v-2h1v-6.758A4.496 4.496 0 0 1 1 9.5c0-.827.224-1.624.633-2.303L4.345 2.5a1 1 0 0 1 .866-.5H18.79a1 1 0 0 1 .866.5l2.702 4.682A4.496 4.496 0 0 1 21 13.242zm-2 .73a4.496 4.496 0 0 1-3.75-1.36A4.496 4.496 0 0 1 12 14.001a4.496 4.496 0 0 1-3.25-1.387A4.496 4.496 0 0 1 5 13.973V20h14v-6.027zM5.789 4L3.356 8.213a2.5 2.5 0 0 0 4.466 2.216c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 0 0 4.644 0c.335-.837 1.52-.837 1.856 0a2.5 2.5 0 1 0 4.457-2.232L18.21 4H5.79z"
                                fill="rgba(79,78,78,1)" />
                        </svg>
                        Campaign
                    </a>
                @endpermission
                @permission('cupon.list')
                    <a href="{{ route('cupon.list') }}"
                        class="{{ isRouteActive('cupon.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.848 8.25l1.536.887M7.848 8.25a3 3 0 11-5.196-3 3 3 0 015.196 3zm1.536.887a2.165 2.165 0 011.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 11-5.196 3 3 3 0 015.196-3zm1.536-.887a2.165 2.165 0 001.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863l2.077-1.199m0-3.328a4.323 4.323 0 012.068-1.379l5.325-1.628a4.5 4.5 0 012.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.331 4.331 0 0010.607 12m3.736 0l7.794 4.5-.802.215a4.5 4.5 0 01-2.48-.043l-5.326-1.629a4.324 4.324 0 01-2.068-1.379M14.343 12l-2.882 1.664" />
                        </svg>
                        Cupon
                    </a>
                @endpermission


                {{-- -------------------------------- --}}
                <div class="relative">
                    <li
                        class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">
                            <svg cla xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Accounts
                        </div>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </li>
                    <div class="child-menu-div mt-1 ml-5">
                        @if (hasAnyPermissions('bill.list'))
                            <a href="{{ route('bill.list') }}"
                                class="{{ isRouteActive('bill.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                                Payment
                            </a>
                        @endif

                        @if (hasAnyPermissions('online.payment.list'))
                            <a href="{{ route('online.payment.list') }}"
                                class="{{ isRouteActive('online.payment.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                    <path
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                                Online Payment
                            </a>
                        @endif







                    </div>

                </div>
                {{-- --------------------------- --}}


                {{-- @permission('payment.list')
                    <a href="{{ route('payment.list') }}"
                        class="{{ isRouteActive('payment.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                            height="24" stroke="currentColor" class="mr-3 text-gray-900">
                            <path
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                        Payment
                    </a>
                @endpermission

                <a href="{{ route('online.payment.list') }}"
                    class="{{ isRouteActive('online.payment.list*') }} flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:bg-gray-100 focus:outline-none">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24"
                        height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    Online Payment
                </a> --}}


                <div class="relative">
                    <li
                        class="sidebar-parent-menu flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">
                            <svg cla xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </div>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-300 arrow-icon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </li>
                    <div class="child-menu-div ml-5">
                        {{-- @if (hasAnyPermissions('role.list')) --}}
                        <a href="{{ route('role.list') }}"
                            class=" mt-1 {{ isRouteActive('role*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                            </svg>
                            Role
                        </a>
                        {{-- @endif --}}
                        {{-- @if (hasAnyPermissions('user.list')) --}}
                        <a href="{{ route('user.list') }}"
                            class=" mt-1  {{ isRouteActive('user*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36"
                                height="36">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"
                                    fill="currentColor" />
                            </svg>
                            User
                        </a>
                        {{-- @endif --}}



                        {{-- @if (hasAnyPermissions('settings')) --}}
                        <a href="{{ route('settings') }}"
                            class=" mt-1 {{ isRouteActive('settings*') }}   group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M3.34 17a10.018 10.018 0 0 1-.978-2.326 3 3 0 0 0 .002-5.347A9.99 9.99 0 0 1 4.865 4.99a3 3 0 0 0 4.631-2.674 9.99 9.99 0 0 1 5.007.002 3 3 0 0 0 4.632 2.672c.579.59 1.093 1.261 1.525 2.01.433.749.757 1.53.978 2.326a3 3 0 0 0-.002 5.347 9.99 9.99 0 0 1-2.501 4.337 3 3 0 0 0-4.631 2.674 9.99 9.99 0 0 1-5.007-.002 3 3 0 0 0-4.632-2.672A10.018 10.018 0 0 1 3.34 17zm5.66.196a4.993 4.993 0 0 1 2.25 2.77c.499.047 1 .048 1.499.001A4.993 4.993 0 0 1 15 17.197a4.993 4.993 0 0 1 3.525-.565c.29-.408.54-.843.748-1.298A4.993 4.993 0 0 1 18 12c0-1.26.47-2.437 1.273-3.334a8.126 8.126 0 0 0-.75-1.298A4.993 4.993 0 0 1 15 6.804a4.993 4.993 0 0 1-2.25-2.77c-.499-.047-1-.048-1.499-.001A4.993 4.993 0 0 1 9 6.803a4.993 4.993 0 0 1-3.525.565 7.99 7.99 0 0 0-.748 1.298A4.993 4.993 0 0 1 6 12c0 1.26-.47 2.437-1.273 3.334a8.126 8.126 0 0 0 .75 1.298A4.993 4.993 0 0 1 9 17.196zM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"
                                    fill="rgba(79,78,78,1)" />
                            </svg>

                            Business Settings
                        </a>
                        {{-- @endif --}}



                        {{-- @permission('banner.index') --}}
                        <a href="{{ route('slider.list') }}"
                            class="mt-1 {{ isRouteActive('slider.list*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-900 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                            </svg>
                            Slider
                        </a>
                        {{-- @endpermission --}}
                        @if (hasAnyPermissions('changePassword'))
                            <a href="{{ route('changePassword') }}"
                                class="mt-1 {{ isRouteActive('changePassword*') }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Change Password
                            </a>
                        @endif
                    </div>

                </div>
            </nav>
        </div>

        <div class="flex flex-shrink-0 p-4 bg-gray-100">
            <a href="{{ route('logout') }}" class="flex-shrink-0 block w-full group" title="logout">
                <div class="flex items-center space-x-2">
                    <div class="ml-3 ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="22" height="22">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                d="M6.265 3.807l1.147 1.639a8 8 0 1 0 9.176 0l1.147-1.639A9.988 9.988 0 0 1 22 12c0 5.523-4.477 10-10 10S2 17.523 2 12a9.988 9.988 0 0 1 4.265-8.193zM11 12V2h2v10h-2z" />
                        </svg>

                    </div>
                    <div class="mb-1">
                        <p
                            class="text-lg font-medium leading-4 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800">
                            Logout
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div>
